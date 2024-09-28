<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Dosen</h4>
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
                                <h4 class="card-title">Dosen</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddDosen">
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
                                            <th>ID Dosen</th>
                                            <th>Nama Dosen</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($conn,'SELECT * from dosen');
                                            while ($dosen = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $dosen['id_dosen'] ?></td>
                                            <td><?php echo $dosen['nama_dosen'] ?></td>
                                            <td><?php echo $dosen['kode_mk'] ?></td>
                                            <td><?php echo $dosen['username'] ?></td>
                                            <td>
                                                <a href="#modalEditDosen<?php echo $dosen['id_dosen'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="#modalHapusDosen<?php echo $dosen['id_dosen'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center><h6><b>&copy; Copyright@2021| WPPL ITDEL</b></h6></center>
    </div>

    <!-- Modal Tambah Dosen -->
<div class="modal fade" id="modalAddDosen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Create New Dosen</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Dosen</label>
                        <input type="number" name="id_dosen" class="form-control" placeholder="ID Dosen" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control" placeholder="Nama Dosen" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Mata Kuliah</label>
                        <select name="kode_mk" class="form-control" required>
                            <option value="">Pilih Mata Kuliah</option>
                            <?php
                            // Ambil data mata kuliah dari tabel course
                            $result = mysqli_query($conn, "SELECT kode_mk, nama_mk FROM course");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"" . $row['kode_mk'] . "\">" . $row['nama_mk'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" name="simpan_dosen" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal Edit Dosen -->
<?php 
$p = mysqli_query($conn,'SELECT * from dosen');
while($d = mysqli_fetch_array($p)) {
?>
<div class="modal fade" id="modalEditDosen<?php echo $d['id_dosen'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Edit</span>
                    <span class="fw-light">Dosen</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id_dosen" value="<?php echo $d['id_dosen'] ?>">
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input value="<?php echo $d['nama_dosen'] ?>" type="text" name="nama_dosen" class="form-control" placeholder="Nama Dosen" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Mata Kuliah</label>
                        <select name="kode_mk" class="form-control" required>
                            <?php
                            // Ambil data mata kuliah dari tabel course
                            $courseResult = mysqli_query($conn, "SELECT kode_mk, nama_mk FROM course");
                            while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                $selected = ($d['kode_mk'] == $courseRow['kode_mk']) ? 'selected' : '';
                                echo "<option value=\"" . $courseRow['kode_mk'] . "\" $selected>" . $courseRow['nama_mk'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="<?php echo $d['username'] ?>" type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" name="ubah_dosen" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>


    <!-- Modal Detail Dosen -->
    <?php 
        $p = mysqli_query($conn,'SELECT * from dosen');
        while($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalDetailDosen<?php echo $d['id_dosen'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Detail</span>
                        <span class="fw-light">Dosen</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input value="<?php echo $d['nama_dosen'] ?>" type="text" class="form-control" placeholder="Nama Dosen" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Mata Kuliah</label>
                        <input value="<?php echo $d['kode_mk'] ?>" type="text" class="form-control" placeholder="Kode Mata Kuliah" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="<?php echo $d['username'] ?>" type="text" class="form-control" placeholder="Username" readonly>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Hapus Dosen -->
    <?php 
        $p = mysqli_query($conn,'SELECT * from dosen');
        while($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalHapusDosen<?php echo $d['id_dosen'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Hapus</span>
                        <span class="fw-light">Dosen</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id_dosen" value="<?php echo $d['id_dosen'] ?>">
                        <h4>Apakah Anda Ingin Menghapus Data Ini?</h4>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="hapus_dosen" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
    if (isset($_POST['simpan_dosen'])) {
        $id_dosen = $_POST['id_dosen'];
        $nama_dosen = $_POST['nama_dosen'];
        $kode_mk = $_POST['kode_mk'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = "INSERT INTO dosen (id_dosen, nama_dosen, kode_mk, username, password) VALUES ('$id_dosen', '$nama_dosen', '$kode_mk', '$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Data berhasil disimpan!');window.location.href='dosen.php';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!');</script>";
        }
    }

    if (isset($_POST['ubah_dosen'])) {
        $id_dosen = $_POST['id_dosen'];
        $nama_dosen = $_POST['nama_dosen'];
        $kode_mk = $_POST['kode_mk'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "UPDATE dosen SET nama_dosen='$nama_dosen', kode_mk='$kode_mk', username='$username', password='$password' WHERE id_dosen='$id_dosen'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Data berhasil diubah!');window.location.href='dosen.php';</script>";
        } else {
            echo "<script>alert('Data gagal diubah!');</script>";
        }
    }

    if (isset($_POST['hapus_dosen'])) {
        $id_dosen = $_POST['id_dosen'];

        $query = "DELETE FROM dosen WHERE id_dosen='$id_dosen'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Data berhasil dihapus!');window.location.href='dosen.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus!');</script>";
        }
    }
    ?>
