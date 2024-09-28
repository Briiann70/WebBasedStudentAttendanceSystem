<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Mata Kuliah</h4>
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
                                <h4 class="card-title">Mata Kuliah</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddCourse">
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
                                            <th>Kode Matakuliah</th>
                                            <th>Nama Matakuliah</th>
                                            <th>Semester</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($conn, 'SELECT * FROM course');
                                            while ($course = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $course['kode_mk'] ?></td>
                                            <td><?php echo $course['nama_mk'] ?></td>
                                            <td><?php echo $course['semester'] ?></td>
                                            <td>
                                                <a href="#modalEditCourse<?php echo $course['kode_mk'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="#modalDeleteCourse<?php echo $course['kode_mk'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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

    <!-- Modal Tambah Mata Kuliah -->
    <div class="modal fade" id="modalAddCourse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Create New Course</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Matakuliah</label>
                            <input type="text" name="kode_mk" class="form-control" placeholder="Kode Matakuliah" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Matakuliah</label>
                            <input type="text" name="nama_mk" class="form-control" placeholder="Nama Matakuliah" required>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="number" name="semester" class="form-control" placeholder="Semester" required>
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

    <!-- Modal Edit Mata Kuliah -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM course');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalEditCourse<?php echo $d['kode_mk'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Edit</span>
                        <span class="fw-light">Course</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="kode_mk" value="<?php echo $d['kode_mk'] ?>">
                        <div class="form-group">
                            <label>Kode Matakuliah</label>
                            <input value="<?php echo $d['kode_mk'] ?>" type="text" name="kode_mk" class="form-control" placeholder="Kode MK" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Matakuliah</label>
                            <input value="<?php echo $d['nama_mk'] ?>" type="text" name="nama_mk" class="form-control" placeholder="Nama MK" required>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input value="<?php echo $d['semester'] ?>" type="number" name="semester" class="form-control" placeholder="Semester" required>
                        </div>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="ubah" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Detail Mata Kuliah -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM course');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalDetailCourse<?php echo $d['kode_mk'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Detail</span>
                        <span class="fw-light">Course</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Matakuliah</label>
                        <input value="<?php echo $d['kode_mk'] ?>" type="text" class="form-control" placeholder="Kode Matakuliah" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Matakuliah</label>
                        <input value="<?php echo $d['nama_mk'] ?>" type="text" class="form-control" placeholder="Nama Matakuliah" readonly>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input value="<?php echo $d['semester'] ?>" type="number" class="form-control" placeholder="Semester" readonly>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <!-- Modal Hapus Mata Kuliah -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM course');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalDeleteCourse<?php echo $d['kode_mk'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Hapus</span>
                        <span class="fw-light">Course</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="kode_mk" value="<?php echo $d['kode_mk'] ?>">
                        <p>Apakah Anda yakin ingin menghapus data <b><?php echo $d['nama_mk'] ?></b>?</p>
                    </div>
                    <div class="modal-footer no-bd">
                        <button type="submit" name="hapus" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    if (isset($_POST['simpan'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $semester = $_POST['semester'];

        $query = "INSERT INTO course (kode_mk, nama_mk, semester) VALUES ('$kode_mk', '$nama_mk', '$semester')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil disimpan'); window.location='createcourse.php';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan'); window.location='createcourse.php';</script>";
        }
    }

    if (isset($_POST['ubah'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $semester = $_POST['semester'];

        $query = "UPDATE course SET nama_mk='$nama_mk', semester='$semester' WHERE kode_mk='$kode_mk'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diubah'); window.location='createcourse.php';</script>";
        } else {
            echo "<script>alert('Data gagal diubah'); window.location='createcourse.php';</script>";
        }
    }

    if (isset($_POST['hapus'])) {
        $kode_mk = $_POST['kode_mk'];
        $query = "DELETE FROM course WHERE kode_mk='$kode_mk'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil dihapus'); window.location='createcourse.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus'); window.location='createcourse.php';</script>";
        }
    }
?>
