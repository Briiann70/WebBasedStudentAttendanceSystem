<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Ruangan</h4>
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
                                <h4 class="card-title">Ruangan</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddRoom">
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
                                            <th>No</th>
                                            <th>Nama Ruangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($conn, 'SELECT * FROM ruangan');
                                            while ($room = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $room['id_ruangan'] ?></td>
                                            <td><?php echo $room['nama_ruangan'] ?></td>
                                            <td>
                                                <a href="#modalEditRoom<?php echo $room['id_ruangan'] ?>" data-toggle="modal" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="#modalDeleteRoom<?php echo $room['id_ruangan'] ?>" data-toggle="modal" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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

    <!-- Modal Tambah Ruangan -->
    <div class="modal fade" id="modalAddRoom" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Create New Room</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No</label>
                            <input type="text" name="id_ruangan" class="form-control" placeholder="ID Ruangan" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ruangan</label>
                            <input type="text" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan" required>
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

    <!-- Modal Edit Ruangan -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM ruangan');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalEditRoom<?php echo $d['id_ruangan'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Edit</span>
                        <span class="fw-light">Room</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id_ruangan" value="<?php echo $d['id_ruangan'] ?>">
                        <div class="form-group">
                            <label>No</label>
                            <input value="<?php echo $d['id_ruangan'] ?>" type="text" name="id_ruangan" class="form-control" placeholder="ID Ruangan" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ruangan</label>
                            <input value="<?php echo $d['nama_ruangan'] ?>" type="text" name="nama_ruangan" class="form-control" placeholder="Nama Ruangan" required>
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

    <!-- Modal Detail Ruangan -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM ruangan');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalDetailRoom<?php echo $d['id_ruangan'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Detail</span>
                        <span class="fw-light">Room</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Ruangan</label>
                        <input value="<?php echo $d['id_ruangan'] ?>" type="text" class="form-control" placeholder="ID Ruangan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input value="<?php echo $d['nama_ruangan'] ?>" type="text" class="form-control" placeholder="Nama Ruangan" readonly>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Hapus Ruangan -->
    <?php 
        $p = mysqli_query($conn, 'SELECT * FROM ruangan');
        while ($d = mysqli_fetch_array($p)) {
    ?>
    <div class="modal fade" id="modalDeleteRoom<?php echo $d['id_ruangan'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Hapus</span>
                        <span class="fw-light">Room</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id_ruangan" value="<?php echo $d['id_ruangan'] ?>">
                        <p>Apakah Anda yakin ingin menghapus data <b><?php echo $d['nama_ruangan'] ?></b>?</p>
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
        $id_ruangan = $_POST['id_ruangan'];
        $nama_ruangan = $_POST['nama_ruangan'];

        $query = "INSERT INTO ruangan (id_ruangan, nama_ruangan) VALUES ('$id_ruangan', '$nama_ruangan')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil disimpan'); window.location='createroom.php';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan'); window.location='createroom.php';</script>";
        }
    }

    if (isset($_POST['ubah'])) {
        $id_ruangan = $_POST['id_ruangan'];
        $nama_ruangan = $_POST['nama_ruangan'];

        $query = "UPDATE ruangan SET nama_ruangan='$nama_ruangan' WHERE id_ruangan='$id_ruangan'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diubah'); window.location='createroom.php';</script>";
        } else {
            echo "<script>alert('Data gagal diubah'); window.location='createroom.php';</script>";
        }
    }

    if (isset($_POST['hapus'])) {
        $id_ruangan = $_POST['id_ruangan'];
        $query = "DELETE FROM ruangan WHERE id_ruangan='$id_ruangan'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil dihapus'); window.location='createroom.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus'); window.location='createroom.php';</script>";
        }
    }
?>
