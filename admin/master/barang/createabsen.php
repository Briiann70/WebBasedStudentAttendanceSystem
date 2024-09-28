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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Waktu Absen</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddWaktuAbsen">
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
                                            <th>ID</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Matakuliah</th>
                                            <th>Ruangan</th>
                                            <th>Angkatan</th>
                                            <th>Nama Dosen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($conn, 'SELECT wa.id_waktu_absen, wa.waktu_mulai, wa.waktu_selesai, c.nama_mk AS nama_matakuliah, r.nama_ruangan, wa.angkatan, d.nama_dosen
                                                                         FROM waktu_absen wa
                                                                         JOIN course c ON wa.kode_mk = c.kode_mk
                                                                         JOIN ruangan r ON wa.id_ruangan = r.id_ruangan
                                                                         JOIN dosen d ON wa.id_dosen = d.id_dosen');
                                            while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data['id_waktu_absen'] ?></td>
                                            <td><?php echo $data['waktu_mulai'] ?></td>
                                            <td><?php echo $data['waktu_selesai'] ?></td>
                                            <td><?php echo $data['nama_matakuliah'] ?></td>
                                            <td><?php echo $data['nama_ruangan'] ?></td>
                                            <td><?php echo $data['angkatan'] ?></td>
                                            <td><?php echo $data['nama_dosen'] ?></td>
                                            <td>
                                                <a href="#modalEditWaktuAbsen<?php echo $data['id_waktu_absen'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="#modalHapusWaktuAbsen<?php echo $data['id_waktu_absen'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <center><h6><b>&copy; Copyright@2024| WPPL ITDEL</b></h6></center>
    </div>

    <!-- Modal Tambah Waktu Absen -->
    <div class="modal fade" id="modalAddWaktuAbsen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Create New Waktu Absen</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <input type="datetime-local" name="waktu_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <input type="datetime-local" name="waktu_selesai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Matakuliah</label>
                            <select name="kode_mk" class="form-control" required>
                                <?php
                                    $mk_query = mysqli_query($conn, 'SELECT * FROM course');
                                    while ($mk = mysqli_fetch_array($mk_query)) {
                                        echo "<option value='".$mk['kode_mk']."'>".$mk['nama_mk']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <select name="id_ruangan" class="form-control" required>
                                <?php
                                    $ruangan_query = mysqli_query($conn, 'SELECT * FROM ruangan');
                                    while ($ruangan = mysqli_fetch_array($ruangan_query)) {
                                        echo "<option value='".$ruangan['id_ruangan']."'>".$ruangan['nama_ruangan']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Angkatan</label>
                            <select name="angkatan" class="form-control" required>
                                <?php
                                    $angkatan_query = mysqli_query($conn, 'SELECT DISTINCT angkatan FROM user ORDER BY angkatan');
                                    while ($angkatan = mysqli_fetch_array($angkatan_query)) {
                                        echo "<option value='".$angkatan['angkatan']."'>".$angkatan['angkatan']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <select name="id_dosen" class="form-control" required>
                                <?php
                                    $dosen_query = mysqli_query($conn, 'SELECT * FROM dosen');
                                    while ($dosen = mysqli_fetch_array($dosen_query)) {
                                        echo "<option value='".$dosen['id_dosen']."'>".$dosen['nama_dosen']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Week</label>
                            <input type="number" name="jumlah_pengulangan" class="form-control" min="1" max="16" value="1" required>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Waktu Absen -->
    <?php 
        $e = mysqli_query($conn, 'SELECT * FROM waktu_absen');
        while($d = mysqli_fetch_array($e)) {
    ?>
    <div class="modal fade" id="modalEditWaktuAbsen<?php echo $d['id_waktu_absen'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Edit</span>
                        <span class="fw-light">Waktu Absen</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id_waktu_absen" value="<?php echo $d['id_waktu_absen'] ?>">
                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <input value="<?php echo $d['waktu_mulai'] ?>" type="datetime-local" name="waktu_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <input value="<?php echo $d['waktu_selesai'] ?>" type="datetime-local" name="waktu_selesai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Matakuliah</label>
                            <select name="kode_mk" class="form-control" required>
                                <?php
                                    $mk_query = mysqli_query($conn, 'SELECT * FROM course');
                                    while ($mk = mysqli_fetch_array($mk_query)) {
                                        $selected = $mk['kode_mk'] == $d['kode_mk'] ? 'selected' : '';
                                        echo "<option value='".$mk['kode_mk']."' $selected>".$mk['nama_mk']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <select name="id_ruangan" class="form-control" required>
                                <?php
                                    $ruangan_query = mysqli_query($conn, 'SELECT * FROM ruangan');
                                    while ($ruangan = mysqli_fetch_array($ruangan_query)) {
                                        $selected = $ruangan['id_ruangan'] == $d['id_ruangan'] ? 'selected' : '';
                                        echo "<option value='".$ruangan['id_ruangan']."' $selected>".$ruangan['nama_ruangan']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Angkatan</label>
                            <select name="angkatan" class="form-control" required>
                                <?php
                                    $angkatan_query = mysqli_query($conn, 'SELECT DISTINCT angkatan FROM user ORDER BY angkatan');
                                    while ($angkatan = mysqli_fetch_array($angkatan_query)) {
                                        $selected = $angkatan['angkatan'] == $d['angkatan'] ? 'selected' : '';
                                        echo "<option value='".$angkatan['angkatan']."' $selected>".$angkatan['angkatan']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <select name="id_dosen" class="form-control" required>
                                <?php
                                    $dosen_query = mysqli_query($conn, 'SELECT * FROM dosen');
                                    while ($dosen = mysqli_fetch_array($dosen_query)) {
                                        $selected = $dosen['id_dosen'] == $d['id_dosen'] ? 'selected' : '';
                                        echo "<option value='".$dosen['id_dosen']."' $selected>".$dosen['nama_dosen']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Week</label>
                            <input type="number" name="jumlah_pengulangan" class="form-control" min="1" max="16" value="1" required>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Hapus Waktu Absen -->
    <?php 
        $e = mysqli_query($conn, 'SELECT * FROM waktu_absen');
        while($d = mysqli_fetch_array($e)) {
    ?>
    <div class="modal fade" id="modalHapusWaktuAbsen<?php echo $d['id_waktu_absen'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Hapus</span>
                        <span class="fw-light">Waktu Absen</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="id_waktu_absen" value="<?php echo $d['id_waktu_absen'] ?>">
                    <div class="modal-body">
                        <p>Apakah anda yakin untuk menghapus data ini?</p>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="hapus" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php
// Proses Insert Data
if (isset($_POST['simpan'])) {
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $kode_mk = $_POST['kode_mk'];
    $id_ruangan = $_POST['id_ruangan'];
    $angkatan = $_POST['angkatan'];
    $id_dosen = $_POST['id_dosen'];
    $jumlah_pengulangan = $_POST['jumlah_pengulangan'];

    for ($i = 0; $i < $jumlah_pengulangan; $i++) {
        mysqli_query($conn, "INSERT INTO waktu_absen (waktu_mulai, waktu_selesai, kode_mk, id_ruangan, angkatan, id_dosen) 
                             VALUES ('$waktu_mulai', '$waktu_selesai', '$kode_mk', '$id_ruangan', '$angkatan', '$id_dosen')");
        // Tambahkan satu minggu untuk iterasi berikutnya
        $waktu_mulai = date('Y-m-d H:i:s', strtotime($waktu_mulai . ' +1 week'));
        $waktu_selesai = date('Y-m-d H:i:s', strtotime($waktu_selesai . ' +1 week'));
    }

    echo "<script>alert('Data berhasil disimpan');window.location='index.php';</script>";
}

// Proses Update Data
if (isset($_POST['update'])) {
    $id_waktu_absen = $_POST['id_waktu_absen'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $kode_mk = $_POST['kode_mk'];
    $id_ruangan = $_POST['id_ruangan'];
    $angkatan = $_POST['angkatan'];
    $id_dosen = $_POST['id_dosen'];

    mysqli_query($conn, "UPDATE waktu_absen 
                         SET waktu_mulai='$waktu_mulai', waktu_selesai='$waktu_selesai', kode_mk='$kode_mk', id_ruangan='$id_ruangan', angkatan='$angkatan', id_dosen='$id_dosen' 
                         WHERE id_waktu_absen='$id_waktu_absen'");

    echo "<script>alert('Data berhasil diupdate');window.location='index.php';</script>";
}

// Proses Delete Data
if (isset($_POST['hapus'])) {
    $id_waktu_absen = $_POST['id_waktu_absen'];

    mysqli_query($conn, "DELETE FROM waktu_absen WHERE id_waktu_absen='$id_waktu_absen'");

    echo "<script>alert('Data berhasil dihapus');window.location='index.php';</script>";
}
?>
