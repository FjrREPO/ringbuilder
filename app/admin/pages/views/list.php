<?php
include "../../config/conn.php";

$query = mysqli_query($conn, "SELECT * FROM computer");
?>

<section class="bg-gray-50 dark:bg-black p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-white/10 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2 dark:bg-black/20 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button id="addBtn" type="button" class="flex items-center justify-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Komponen
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black/20 uppercase bg-gray-50 dark:bg-black/20 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Deskripsi</th>
                            <th scope="col" class="px-4 py-3">Harga</th>
                            <th scope="col" class="px-4 py-3">Gambar</th>
                            <th scope="col" class="px-4 py-3">Jenis</th>
                            <th scope="col" colspan="2" class="px-4 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="computerList">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr class="border-b dark:border-black/20">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= htmlspecialchars($row['title']); ?>
                                </th>
                                <td class="px-4 py-3 max-w-[100px] line-clamps-2"><span><?= htmlspecialchars($row['deskripsi']); ?></span></td>
                                <td class="px-4 py-3"><span><?= number_format($row['harga'], 0, ',', '.'); ?></span></td>
                                <td class="px-4 py-3"><img src="<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar <?= htmlspecialchars($row['title']); ?>" width="50"></td>
                                <td class="px-4 py-3"><span><?= htmlspecialchars($row['jenis']); ?></span></td>
                                <td class="px-4 py-3">
                                    <a href="edit_list?id=<?= $row['id']; ?>" class="text-green-600 hover:text-green-800">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i>
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="text-red-600 hover:text-red-800" onclick="deleteComputer(<?= $row['id']; ?>)"><i class="fa-solid fa-trash text-red-500"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden fixed z-50 inset-0 flex items-center justify-center backdrop-blur-sm">
    <div class="rounded-lg shadow-lg p-6 overflow-y-auto max-w-md">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-medium text-gray-700 dark:text-white">
                    Tambah Data Komputer
                </h3>
                <button id="closeAddModal" type="button" class="text-gray-400 dark:text-gray-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M19.071 4.929a1 1 0 010 1.414L5.757 19.071a1 1 0 01-1.414-1.414L17.657 4.93a1 1 0 011.414 0z" fill-rule="evenodd"></path>
                        <path clip-rule="evenodd" d="M4.929 4.929a1 1 0 00-1.414 1.414L18.243 19.07a1 1 0 001.414-1.413L4.929 4.93z" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="addComputerForm" class="p-4 md:p-5" action="pages/controller/list/add_list.php" method="POST">
                <div class="flex flex-row w-full gap-3">
                    <div class="mb-4 w-1/2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Nama Komputer</label>
                        <input type="text" id="title" name="title" placeholder="Nama Komputer" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Harga</label>
                        <input type="number" id="harga" name="harga" placeholder="Harga" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">URL Gambar</label>
                    <input type="text" id="imageCard" name="gambar" placeholder="URL Gambar" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    <button id="uploadWidget" type="button" class="mt-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Upload Gambar</button>
                    <img id="imageCardPreview" class="mt-2 hidden w-32 h-32 object-cover" />
                </div>
                <div class="mb-4">
                    <label for="jenis" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Jenis</label>
                    <input type="text" id="jenis" name="jenis" placeholder="Jenis Komputer" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi" placeholder="deskripsi" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="submitAddForm" type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Tambah</button>
                    <button type="button" id="cancelAddModal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://widget.cloudinary.com/v2.0/global/all.js"></script>
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
                    $('#imageCard').val(imageUrl); // set the image URL to the input field
                    $('#imageCardPreview').attr('src', imageUrl); // set the image URL to the img element
                    $('#imageCardPreview').removeClass('hidden');
                }
            });
        });

        $('#closeAddModal').click(function() {
            $('#add-modal').addClass('hidden');
        });

        $('#cancelAddModal').click(function() {
            $('#add-modal').addClass('hidden');
        });

        $('#addBtn').click(function() {
            $('#add-modal').removeClass('hidden');
        });
    });

    function deleteComputer(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = `pages/controller/liat/delete_list.php?id=${id}`;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('add-modal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const addComputerCardForm = document.getElementById('addComputerForm');

        document.getElementById('addBtn').addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        addComputerCardForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(addComputerCardForm);

            fetch('pages/controller/list/add_list.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Component added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add Component. Please try again.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Component added successfully!',
                    }).then(() => {
                        location.reload();
                    });
                });
        });
    });
</script>

<script>
    function deleteComputer(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`pages/controller/list/delete_list.php?id=${id}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The component has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the component.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Failed to delete the component.',
                            'error'
                        );
                    });
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('add-modal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const editModal = document.getElementById('edit-modal');
        const closeEditModalBtn = document.getElementById('closeEditModal');
        const addBtn = document.getElementById('addBtn');
        const editComputerCardBtns = document.querySelectorAll('.editComputerForm');
        const computerForm = document.getElementById('computerForm');
        const computerList = document.getElementById('computerList');

        addBtn.addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        editComputerCardBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const computerCardId = btn.getAttribute('data-id');
                editModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        });

        closeEditModalBtn.addEventListener('click', function() {
            editModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
</script>