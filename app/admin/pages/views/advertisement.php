<section class="bg-gray-50 dark:bg-black p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-white/10 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class=" md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="mt-8 sm:rounded-lg">
                    <!-- Add Advertisement Form -->
                    <div class="flex justify-end mb-4">
                        <button id="addBtn" class="flex items-center justify-center text-white bg-gray-700 hover:bg-black focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-black">
                            Add Advertisement
                        </button>
                    </div>

                    <!-- Advertisement List -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-800 dark:text-gray-400">
                            <thead class="text-xs text-black/20 uppercase bg-gray-50 dark:bg-black/20 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Image</th>
                                    <th scope="col" class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white" id="advertisementList">
                                <?php
                                include "pages/controller/advertisement/advertisement_controller.php";
                                $advertisements = getAllAdvertisements();

                                if (is_array($advertisements) && !empty($advertisements)) {
                                    foreach ($advertisements as $row) { ?>
                                        <tr class="border-b dark:border-black/20">
                                            <td class="px-4 py-3"><?= $row['id']; ?></td>
                                            <td class="px-4 py-3">
                                                <img src="<?= $row['links']; ?>" alt="Advertisement Image" class="h-10 w-10 object-cover rounded-full">
                                            </td>
                                            <td class="px-4 py-3">
                                                <button class="fa-solid fa-trash text-red-500 deleteBtn" data-id="<?= $row['id']; ?>"></button>
                                            </td>
                                        </tr>
                                <?php }
                                } else {
                                    echo '<tr><td colspan="3" class="text-center py-4">No advertisements found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Advertisement Modal -->
<div id="addModal" tabindex="-1" aria-hidden="true" class="hidden fixed z-50 inset-0 flex items-center justify-center backdrop-blur-sm">
    <div class="rounded-lg shadow-lg p-6 overflow-y-auto max-w-md">
        <div class="relative bg-gray-900 rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-700">
                <h2 class="text-xl font-medium text-gray-200 dark:text-white">Add Advertisement</h2>
                <button id="closeAddModal" class="text-gray-300 dark:text-gray-300 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="addAdvertisementForm" class="p-5 space-y-4">
                <div class="mb-4 w-1/2">
                    <label for="imageQR" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Gambar QR</label>
                    <input type="text" id="imageQR" name="imageQR" placeholder="https://" required class="hidden w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    <button type="button" id="uploadWidget2" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Upload Image</button>
                    <img id="imageQRPreview" src="" alt="Image Preview" class="mt-2 hidden w-full h-auto rounded-md" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Advertisement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('addModal');
        const closeAddModalBtn = document.getElementById('closeAddModal');
        const addAdvertisementForm = document.getElementById('addAdvertisementForm');
        const advertisementList = document.getElementById('advertisementList');

        // Show add modal
        document.getElementById('addBtn').addEventListener('click', function() {
            addModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        // Close add modal
        closeAddModalBtn.addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });

        // Handle add advertisement form submission
        addAdvertisementForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const image = document.getElementById('imageQR').value;

            fetch('pages/controller/advertisement/advertisement_controller.php?action=add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        imageQR: image
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Advertisement added successfully!',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add advertisement. Please try again.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add advertisement. Please try again.',
                    });
                });
        });

        // Handle delete advertisement
        advertisementList.addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteBtn')) {
                const advertisementId = event.target.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this advertisement!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`pages/controller/advertisement/advertisement_controller.php?action=delete&id=${advertisementId}`, {
                                method: 'GET'
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Advertisement has been deleted.',
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete advertisement. Please try again.',
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to delete advertisement. Please try again.',
                                });
                            });
                    }
                });
            }
        });

        $('#uploadWidget2').click(function() {
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
                    $('#imageQR').val(imageUrl); // set the image URL to the input field
                    $('#imageQRPreview').attr('src', imageUrl); // set the image URL to the img element
                    $('#imageQRPreview').removeClass('hidden');
                }
            });
        });
    });
</script>