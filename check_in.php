<?php
include 'koneksi.php';

// Pastikan koneksi berhasil
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Periksa apakah RFID diberikan
if (isset($_GET['rfid'])) {
    $rfid = mysqli_real_escape_string($conn, $_GET['rfid']);

    // Ambil data mahasiswa berdasarkan RFID
    $sql = "SELECT id, angkatan FROM user WHERE norfid = '$rfid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_mahasiswa = $row['id'];
        $angkatan = $row['angkatan'];

        // Ambil jadwal saat ini
        $sql = "SELECT id_waktu_absen, kode_mk FROM waktu_absen 
                WHERE NOW() BETWEEN waktu_mulai AND waktu_selesai 
                AND angkatan = $angkatan";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_waktu_absen = $row['id_waktu_absen'];
            $kode_mk = $row['kode_mk'];

            // Periksa apakah mahasiswa sudah check-in pada jadwal waktu absensi ini
            $sql = "SELECT id_absen, check_in, check_out FROM absen 
                    WHERE id = $id_mahasiswa 
                    AND id_waktu_absen = $id_waktu_absen";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if ($row['check_out'] === NULL) {
                    // Jika check-in sudah ada dan check-out belum dilakukan
                    // Lakukan check-out
                    $id_absen = $row['id_absen'];
                    $sql = "UPDATE absen 
                            SET check_out = NOW(), status = 'Hadir'
                            WHERE id_absen = $id_absen";

                    if (mysqli_query($conn, $sql) === TRUE) {
                        echo "Check-out berhasil";
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                } else {
                    echo "Anda sudah check-out untuk jadwal ini.";
                }
            } else {
                // Jika belum ada check-in, lakukan check-in dengan status default '-'
                $sql = "INSERT INTO absen (check_in, check_out, id, id_waktu_absen, kode_mk, status) 
                        VALUES (NOW(), NULL, $id_mahasiswa, $id_waktu_absen, '$kode_mk', '-')";

                if (mysqli_query($conn, $sql) === TRUE) {
                    echo "Check-in berhasil";
                } else {
                    echo "Error inserting record: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Tidak ada jadwal saat ini atau Anda tidak memiliki jadwal di angkatan ini.";
        }
    } else {
        echo "Mahasiswa tidak ditemukan.";
    }
} else {
    echo "RFID tidak diberikan.";
}

// Tutup koneksi
mysqli_close($conn);
?>
