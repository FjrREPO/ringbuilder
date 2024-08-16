<?php
include "../../config/conn.php";

$query = mysqli_query($conn, "SELECT * FROM computer");
?>

<div class="min-h-svh w-full relative bg-[#08344c]">
    <section class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center gap-y-20 gap-x-14 py-[100px]">
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                <a href="#">
                    <img src="<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['title']); ?>" class="h-80 w-72 object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs"><?= htmlspecialchars($row['jenis']); ?></span>
                        <p class="text-lg font-bold text-black truncate block capitalize"><?= htmlspecialchars($row['title']); ?></p>
                        <p class="text-gray-400 block capitalize"><?= htmlspecialchars($row['deskripsi']); ?></p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3"><?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            <div class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </section>
</div>
