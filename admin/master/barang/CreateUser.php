<?php
include '../koneksi.php';
session_start();

// Fungsi untuk menghindari SQL Injection
function escape_string($conn, $value) {
    return mysqli_real_escape_string($conn, $value);
}

if (isset($_POST['simpan'])) {
    $norfid = isset($_POST['norfid']) ? escape_string($conn, $_POST['norfid']) : '';
    $nama_lengkap = escape_string($conn, $_POST['nama_lengkap']);
    $username = escape_string($conn, $_POST['username']);
    $password = escape_string($conn, $_POST['password']);
    $angkatan = escape_string($conn, $_POST['angkatan']);
    $level = escape_string($conn, $_POST['level']);
    $nim = isset($_POST['nim']) ? escape_string($conn, $_POST['nim']) : '';

    $query = "INSERT INTO user (norfid, nama_lengkap, username, password, angkatan, level, nim) 
              VALUES ('$norfid', '$nama_lengkap', '$username', '$password', '$angkatan', '$level', '$nim')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil disimpan'); window.location='createuser.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.location='createuser.php';</script>";
    }
}

// Edit data
if (isset($_POST['ubah'])) {
    $id = escape_string($conn, $_POST['id']);
    $norfid = isset($_POST['norfid']) ? escape_string($conn, $_POST['norfid']) : '';
    $nama_lengkap = escape_string($conn, $_POST['nama_lengkap']);
    $username = escape_string($conn, $_POST['username']);
    $angkatan = escape_string($conn, $_POST['angkatan']);
    $level = escape_string($conn, $_POST['level']);
    $nim = isset($_POST['nim']) ? escape_string($conn, $_POST['nim']) : '';

    if (!empty($_POST['password'])) {
        $password = escape_string($conn, $_POST['password']);
        $query = "UPDATE user SET norfid='$norfid', nama_lengkap='$nama_lengkap', username='$username', 
                  password='$password', angkatan='$angkatan', level='$level', nim='$nim' WHERE id='$id'";
    } else {
        $query = "UPDATE user SET norfid='$norfid', nama_lengkap='$nama_lengkap', username='$username', 
                  angkatan='$angkatan', level='$level', nim='$nim' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location='createuser.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah'); window.location='createuser.php';</script>";
    }
}

// Hapus data
if (isset($_POST['hapus'])) {
    $id = escape_string($conn, $_POST['id']);
    $query = "DELETE FROM user WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='createuser.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus'); window.location='createuser.php';</script>";
    }
}

// Query untuk mengambil semua tahun angkatan yang ada di database
$angkatan_query = mysqli_query($conn, "SELECT DISTINCT angkatan FROM user ORDER BY angkatan ASC");
$angkatan_options = '';
while ($row = mysqli_fetch_assoc($angkatan_query)) {
    $angkatan_options .= "<option value='" . htmlspecialchars($row['angkatan']) . "'>" . htmlspecialchars($row['angkatan']) . "</option>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Data User</h4>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">User</h4>
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddUser">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>No RFID</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Angkatan</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysqli_query($conn, 'SELECT * FROM user');
                                                while ($user = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['nim']); ?></td>
                                                <td><?php echo htmlspecialchars($user['norfid']); ?></td>
                                                <td><?php echo htmlspecialchars($user['nama_lengkap']); ?></td>
                                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                <td><?php echo htmlspecialchars($user['angkatan']); ?></td>
                                                <td><?php echo htmlspecialchars($user['level']); ?></td>
                                                <td>
                                                    <a href="#modalEditUser<?php echo $user['id']; ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#modalHapusUser<?php echo $user['id']; ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit User -->
                                            <div class="modal fade" id="modalEditUser<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">Edit User</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                                <div class="form-group">
                                                                    <label>NIM</label>
                                                                    <input type="text" name="nim" class="form-control" value="<?php echo htmlspecialchars($user['nim']); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>No RFID</label>
                                                                    <input type="text" name="norfid" class="form-control" value="<?php echo htmlspecialchars($user['norfid']); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Angkatan</label>
                                                                    <select name="angkatan" class="form-control" required>
                                                                        <option value="" disabled>Pilih Angkatan</option>
                                                                        <?php echo $angkatan_options; ?>
                                                                        <option value="<?php echo htmlspecialchars($user['angkatan']); ?>" selected><?php echo htmlspecialchars($user['angkatan']); ?></option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Level</label>
                                                                    <select name="level" class="form-control" required>
                                                                        <option value="admin" <?php if ($user['level'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                                        <option value="user" <?php if ($user['level'] == 'user') echo 'selected'; ?>>User</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus User -->
                                            <div class="modal fade" id="modalHapusUser<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">Hapus User</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                                <div class="form-group">
                                                                    <p>Apakah Anda yakin ingin menghapus user dengan nama <strong><?php echo htmlspecialchars($user['nama_lengkap']); ?></strong>?</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah User -->
                <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">Tambah User</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text" name="nim" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama_lengkap" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No RFID</label>
                                        <input type="text" name="norfid" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select name="angkatan" class="form-control" required>
                                            <option value="" disabled selected>Pilih Angkatan</option>
                                            <?php echo $angkatan_options; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="level" class="form-control" required>
                                            <option value="" disabled selected>Pilih Level</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Include the modals for edit and delete user here -->
            </div>
        </div>
    </div>
</body>
</html>
