<?php
include "../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];

    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : null;
    $id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_POST['deskripsi']) : null;
    $harga = isset($_POST['harga']) ? mysqli_real_escape_string($conn, $_POST['harga']) : null;
    $jenis = isset($_POST['jenis']) ? mysqli_real_escape_string($conn, $_POST['jenis']) : null;
    $gambar = isset($_POST['gambar']) ? mysqli_real_escape_string($conn, $_POST['gambar']) : null;

    $updateQuery = "UPDATE computer 
                    SET title='$title', deskripsi='$deskripsi', harga='$harga', jenis='$jenis', gambar='$gambar', userId='$userId'
                    WHERE id='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../list");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
