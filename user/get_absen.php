<?php
session_start();
include '../koneksi.php';

// Get the logged-in user's full name and angkatan from the session
$nama_lengkap = $_SESSION['nama_lengkap'];
$userId = $_SESSION['id']; // Assuming ID is stored in session for reference

// Fetch angkatan of the logged-in user
$userQuery = mysqli_query($conn, "SELECT angkatan FROM user WHERE id = '$userId'");
$userData = mysqli_fetch_array($userQuery);
$angkatan_user = $userData['angkatan'];

if (isset($_POST['kode_mk'])) {
    $kode_mk = $_POST['kode_mk'];

    $query = mysqli_query($conn, "
        SELECT 
            wa.waktu_mulai, 
            wa.waktu_selesai, 
            COALESCE(a.check_in, '-') AS check_in, 
            COALESCE(a.check_out, '-') AS check_out, 
            COALESCE(a.status, '-') AS status, 
            c.nama_mk AS nama_matakuliah, 
            r.nama_ruangan, 
            wa.angkatan 
        FROM waktu_absen wa
        LEFT JOIN absen a ON wa.id_waktu_absen = a.id_waktu_absen AND a.id = '$userId'
        LEFT JOIN course c ON wa.kode_mk = c.kode_mk
        LEFT JOIN ruangan r ON wa.id_ruangan = r.id_ruangan
        WHERE wa.kode_mk = '$kode_mk'
        AND wa.angkatan = '$angkatan_user'
    ");

    while ($data = mysqli_fetch_array($query)) {
        echo '
        <tr>
            <td>'.$data['waktu_mulai'].'</td>
            <td>'.$data['waktu_selesai'].'</td>
            <td>'.$data['check_in'].'</td>
            <td>'.$data['check_out'].'</td>
            <td>'.$data['status'].'</td>
            <td>'.$data['nama_matakuliah'].'</td>
            <td>'.$data['nama_ruangan'].'</td>
            <td>'.$data['angkatan'].'</td>
        </tr>';
    }
}
?>
