<?php
include 'koneksi.php';

$rfid = $_GET['rfid'];

// Check if user has checked out
$query = "SELECT * FROM absen WHERE id = (SELECT id FROM user WHERE norfid = '$rfid') AND check_out IS NOT NULL";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Update the status to 'Hadir'
    $update_status_query = "UPDATE absen SET status = 'Hadir' WHERE id = (SELECT id FROM user WHERE norfid = '$rfid') AND check_out IS NOT NULL";
    if ($conn->query($update_status_query) === TRUE) {
        echo "Status berhasil diperbarui menjadi Hadir";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Anda belum check-out";
}

$conn->close();
?>
