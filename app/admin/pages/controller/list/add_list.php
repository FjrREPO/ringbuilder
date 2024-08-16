<?php
include "../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];

    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : null;
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_POST['deskripsi']) : null;
    $harga = isset($_POST['harga']) ? mysqli_real_escape_string($conn, $_POST['harga']) : null;
    $jenis = isset($_POST['jenis']) ? mysqli_real_escape_string($conn, $_POST['jenis']) : null;
    $gambar = isset($_POST['gambar']) ? mysqli_real_escape_string($conn, $_POST['gambar']) : null;

    $insertQuery = "INSERT INTO computer (userId, title, deskripsi, harga, jenis, gambar) 
                    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ississ', $userId, $title, $deskripsi, $harga, $jenis, $gambar);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: pages/views/list.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
