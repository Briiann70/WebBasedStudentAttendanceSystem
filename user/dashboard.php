<?php
include '../koneksi.php';
session_start();
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
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Data Waktu Absen</h4>
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
                <div class="row">
                    <?php
                        // Query untuk mendapatkan mata kuliah unik dari waktu_absen
                        $queryMk = mysqli_query($conn, "
                            SELECT DISTINCT c.nama_mk AS nama_matakuliah, c.kode_mk
                            FROM waktu_absen wa
                            LEFT JOIN course c ON wa.kode_mk = c.kode_mk
                        ");

                        // Looping setiap mata kuliah untuk membuat card
                        while ($mk = mysqli_fetch_array($queryMk)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card card-mk" data-kode-mk="<?php echo $mk['kode_mk']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $mk['nama_matakuliah']; ?></h5>
                                <a href="#" class="btn btn-primary btn-view-absen">Lihat Absensi</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="absen-card" style="display: none;">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Waktu Absen</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Waktu Mulai</th>
                                                <th>Waktu Selesai</th>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th>Status</th>
                                                <th>Matakuliah</th>
                                                <th>Ruangan</th>
                                                <th>Angkatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="absen-tbody">
                                            <!-- Data Absensi akan dimuat disini -->
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
    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Bootstrap Toggle -->
    <script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Azzara JS -->
    <script src="../assets/js/ready.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable();

            // Event listener untuk menampilkan absensi saat card diklik
            $('.btn-view-absen').on('click', function() {
                var kodeMk = $(this).closest('.card-mk').data('kode-mk');

                $.ajax({
                    url: 'get_absen.php',
                    type: 'POST',
                    data: {kode_mk: kodeMk},
                    success: function(response) {
                        $('#absen-tbody').html(response);
                        $('#absen-card').show();
                    }
                });
            });
        });
    </script>
</body>
</html>
