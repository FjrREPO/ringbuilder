<?php
ob_start(); // Mulai output buffering

include("../../config/conn.php");

$query = '';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM movie WHERE title LIKE '%$query%' OR category LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $hasil = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($conn); // Handle query error gracefully
        exit;
    }

    // Redirect to daftar_pencarian.php with results
    header("Location: daftar_pencarian?query=" . urlencode($query));
    exit();
}

ob_end_flush(); // Akhiri dan kirim output ke browser
?>

<head>
    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(1, 0, 1, 0.1);
            border-radius: 20px;
        }

        .swiper-slide img {
            max-width: 60%;
            max-height: 40%;
            border-radius: 20px;
        }
    </style>
</head>

<div class="h-screen w-full relative bg-[#08344c]">
    <div class="relative w-screen h-screen">
        <div class="flex items-center justify-center flex flex-row w-full h-full gap-4 text-center z-20">
            <div class="flex flex-col gap-2">
                <h2 class="text-4xl font-bold z-20 text-start">Komponen Komputer</h2>
                <h6 class="text-xl font-semibold z-20 max-w-[600px] text-start">RINGBUILDER ialah tempat dimana anda dapat menemukan berbagai komponen komputer yang anda inginkan!</h6>
            </div>
            <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1723778647/project-orang/komputer-home2png_sqktjc.png" class="h-[400px] z-20" alt="">
        </div>
    </div>
</div>