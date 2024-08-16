<?php
include '../../config/conn.php';
?>

<div class="w-full h-auto px-5">
    <div class="flex flex-col w-full h-auto">
        <div class="border-b-[3px]">
            <div class="container flex flex-wrap items-center justify-between gap-6 py-8">
                <span class="text-3xl font-bold">Hello, <?php echo $_SESSION['user_username']; ?>!👋🏼</span>
                <a href="logout" class="bg-red-700 text-sm py-3 px-5 rounded-md text-white hover:bg-red-900 duration-200">Logout</a>
            </div>
        </div>
    </div>
</div>