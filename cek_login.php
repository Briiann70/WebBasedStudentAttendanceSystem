<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Pertama, periksa login untuk user dan admin
$filter_user = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
$data_user = mysqli_fetch_array($filter_user);

if ($data_user && $password === $data_user['password']) {
    // Jika login berhasil sebagai user atau admin
    if ($data_user['level'] == 'admin') {
        $_SESSION['username'] = $data_user['username'];
        $_SESSION['level'] = 'admin';
        $_SESSION['id'] = $data_user['id'];
        $_SESSION['nama_lengkap'] = $data_user['nama_lengkap'];
        header("Location: admin/");
    } else if ($data_user['level'] == 'user') {
        $_SESSION['username'] = $data_user['username'];
        $_SESSION['level'] = 'user';
        $_SESSION['id'] = $data_user['id'];
        $_SESSION['nama_lengkap'] = $data_user['nama_lengkap'];
        header("Location: user/");
    } else {
        // Jika level tidak sesuai
        header("Location: index.php?alert=gagal");
    }
} else {
    // Cek login untuk dosen jika tidak sebagai user atau admin
    $filter_dosen = mysqli_query($conn, "SELECT * FROM dosen WHERE username='$username'");
    $data_dosen = mysqli_fetch_array($filter_dosen);

    if ($data_dosen && $password === $data_dosen['password']) {
        $_SESSION['username'] = $data_dosen['username'];
        $_SESSION['level'] = 'dosen';
        $_SESSION['id'] = $data_dosen['id'];
        $_SESSION['nama_lengkap'] = $data_dosen['nama_dosen'];
        header("Location: dosen/");
    } else {
        header("Location: index.php?alert=gagal");
    }
}
?>
