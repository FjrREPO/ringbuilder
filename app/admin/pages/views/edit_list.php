<?php
include "../../config/conn.php";

$computerId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM computer WHERE id='$computerId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Computer not found.');
}

mysqli_close($conn);
?>

<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editComputerForm" class="p-4 md:p-5" action="pages/controller/list/edit_list.php" method="POST">
            <input type="hidden" id="computerId" name="id" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title" value="<?= $row['title']; ?>" placeholder="Title" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Price</label>
                    <input type="number" id="harga" name="harga" value="<?= $row['harga']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <input type="text" id="jenis" name="jenis" value="<?= $row['jenis']; ?>" placeholder="Type" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="gambar" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Image</label>
                    <input type="text" id="gambar" name="gambar" value="<?= $row['gambar']; ?>" placeholder="https://" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    <button type="button" id="uploadWidget" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Upload Image</button>
                    <img id="gambarPreview" src="<?= $row['gambar']; ?>" alt="Image Preview" class="mt-2 w-[200px] h-auto rounded-md" />
                </div>
            </div>
            <div class="mb-4 w-full">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Description</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Description" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white"><?= $row['deskripsi']; ?></textarea>
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateComputerBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#uploadWidget').click(function() {
            cloudinary.openUploadWidget({
                cloudName: 'dv3z889zh', // replace with your Cloudinary cloud name
                uploadPreset: 'z6euuqyl', // replace with your upload preset
                sources: ['local', 'url', 'camera'],
                multiple: false,
                maxFileSize: 2000000, // optional max file size in bytes (2MB in this example)
                maxImageWidth: 2000, // optional max image width
                maxImageHeight: 2000 // optional max image height
            }, function(error, result) {
                if (!error && result && result.event === "success") {
                    const imageUrl = result.info.secure_url;
                    $('#gambar').val(imageUrl); // set the image URL to the input field
                    $('#gambarPreview').attr('src', imageUrl); // set the image URL to the img element
                }
            });
        });
    });
</script>
