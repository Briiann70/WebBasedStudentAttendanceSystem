<?php
include '../koneksi.php';
session_start();

// Mengecek apakah kode_mk ada dalam URL
if (!isset($_GET['kode_mk']) || empty($_GET['kode_mk'])) {
    die("Kode mata kuliah tidak tersedia.");
}

$kode_mk = $_GET['kode_mk'];

// Koneksi ke database menggunakan MySQLi
$mysqli = new mysqli("localhost", "root", "Aska2908_03", "peminjaman_db");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fetch the relevant angkatan for the selected course
$angkatanQuery = "
    SELECT DISTINCT angkatan 
    FROM waktu_absen 
    WHERE kode_mk = ?
";
$stmt = $mysqli->prepare($angkatanQuery);
$stmt->bind_param('s', $kode_mk);
$stmt->execute();
$angkatanResult = $stmt->get_result();
$angkatanArray = $angkatanResult->fetch_all(MYSQLI_ASSOC);

if (empty($angkatanArray)) {
    die("Tidak ada data untuk mata kuliah ini.");
}

// Initialize array to store attendance data
$attendanceData = [];

// Fetch attendance data for each angkatan
foreach ($angkatanArray as $angkatanRow) {
    $angkatan = $angkatanRow['angkatan'];

    // Query to get students and their attendance data for the selected course and angkatan
    $query = "
        SELECT u.nama_lengkap, 
               u.angkatan,
               COALESCE(a.status, '-') AS status, 
               wa.id_waktu_absen,
               TIMESTAMPDIFF(WEEK, wa.waktu_mulai, a.check_in) + 1 AS week_number
        FROM user u
        LEFT JOIN absen a ON u.id = a.id
        LEFT JOIN waktu_absen wa ON a.id_waktu_absen = wa.id_waktu_absen
        WHERE wa.kode_mk = ? AND wa.angkatan = ?
        ORDER BY u.nama_lengkap, week_number
    ";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $kode_mk, $angkatan);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $attendanceData[$row['nama_lengkap']]['angkatan'] = $row['angkatan'];
        $attendanceData[$row['nama_lengkap']]['weeks'][$row['week_number']] = $row['status'];
    }
}

// Get all students enrolled in the selected course
$studentsQuery = "
    SELECT DISTINCT u.nama_lengkap, u.angkatan 
    FROM user u
    JOIN waktu_absen wa ON u.angkatan = wa.angkatan
    WHERE wa.kode_mk = ?
";
$stmt = $mysqli->prepare($studentsQuery);
$stmt->bind_param('s', $kode_mk);
$stmt->execute();
$studentsResult = $stmt->get_result();

while ($row = $studentsResult->fetch_assoc()) {
    if (!isset($attendanceData[$row['nama_lengkap']])) {
        $attendanceData[$row['nama_lengkap']] = [
            'angkatan' => $row['angkatan'],
            'weeks' => array_fill(1, 16, '-') // Initialize all weeks as '-'
        ];
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>D3 Teknologi Komputer</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/iconWPPL.png" type="image/x-icon"/>
    
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/azzara.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
    <div class="wrapper">
        <div class="main-header" data-background-color="blue">
            <div class="logo-header">
                <a href="#" style="color : white" class="">Teknologi Komputer</a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search mr-md-3"></form>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../logout.php">
                                <i class="fas fa-lock"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Data Absen</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Data</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Data Absensi -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" id="absen-card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Data Absen untuk Mata Kuliah</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Angkatan</th>
                                                    <?php for ($week = 1; $week <= 16; $week++): ?>
                                                    <th>Week <?php echo $week; ?></th>
                                                    <?php endfor; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($attendanceData as $name => $data): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($name); ?></td>
                                                    <td><?php echo htmlspecialchars($data['angkatan']); ?></td>
                                                    <?php for ($week = 1; $week <= 16; $week++): ?>
                                                    <td>
                                                        <?php echo htmlspecialchars($data['weeks'][$week] ?? '-'); ?>
                                                    </td>
                                                    <?php endfor; ?>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center><h6><b>&copy; Copyright@2024| Teknologi Komputer </b></h6></center>
            </div>
        </div>

        <!-- Core JS Files -->
        <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <!-- jQuery UI -->
        <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                <!-- jQuery UI Touch Punch -->
                <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
        <!-- Bootstrap Toggle -->
        <script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
        <!-- jQuery Scrollbar -->
        <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <!-- Datatables -->
        <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
        <!-- Azzara JS -->
        <script src="../assets/js/ready.min.js"></script>
    </div>
</body>
</html>
