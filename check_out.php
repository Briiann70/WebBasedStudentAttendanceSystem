<?php
include 'koneksi.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['rfid'])) {
    $rfid = mysqli_real_escape_string($conn, $_GET['rfid']);

    // Fetch student details using RFID
    $sql = "SELECT id FROM user WHERE norfid = '$rfid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_mahasiswa = $row['id'];

        // Fetch current schedule
        $sql = "SELECT id_waktu_absen, kode_mk FROM waktu_absen 
                WHERE NOW() BETWEEN waktu_mulai AND waktu_selesai";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_waktu_absen = $row['id_waktu_absen'];
            $kode_mk = $row['kode_mk'];

            // Check if there is an existing check-in record without check-out for the current schedule
            $sql = "SELECT id_absen FROM absen WHERE id = $id_mahasiswa 
                    AND id_waktu_absen = $id_waktu_absen 
                    AND check_out IS NULL ORDER BY check_in DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_absen = $row['id_absen'];

                // Update the attendance record with check-out time
                $sql = "UPDATE absen SET check_out = NOW(), status = 'Hadir' WHERE id_absen = $id_absen";
                if (mysqli_query($conn, $sql) === TRUE) {
                    echo "Check-out berhasil";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            } else {
                echo "Tidak ada catatan check-in yang aktif atau Anda sudah check-out.";
            }
        } else {
            echo "Tidak ada jadwal saat ini.";
        }
    } else {
        echo "Mahasiswa tidak ditemukan.";
    }
} else {
    echo "RFID tidak diberikan.";
}

mysqli_close($conn);
?>
