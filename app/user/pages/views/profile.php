<?php
include "../../config/conn.php";

// Memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Query untuk mengambil data user beserta jumlah favorit
$query = "SELECT u.user_username, u.user_email, u.user_image, u.user_telepon, COUNT(f.movie_id) AS num_favorites
          FROM user u
          LEFT JOIN favorites f ON u.user_id = f.user_id
          WHERE u.user_id = $userId
          GROUP BY u.user_username, u.user_email, u.user_image, u.user_telepon";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="dark:bg-black dark:text-white bg-gray-100">
    <section class="w-full overflow-hidden dark:bg-black">
        <div class="flex flex-col">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1719427209368-8ee06271a8b1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="User Profile" class="w-full h-[20rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem] object-cover" />
            </div>

            <div class="sm:w-[80%] xs:w-[90%] mx-auto flex justify-center -mt-14">
                <div class="relative">
                    <div class="absolute z-10 right-2 rounded-full p-2 cursor-pointer" onclick="openEditImageModal()">
                        <i class="fas fa-edit text-white outline-1 outline-gray-400 text-2xl"></i>
                    </div>
                    <img src="<?= $user['user_image'] ?>" class="relative rounded-lg lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] border-4 border-white object-cover" />
                </div>
            </div>

            <div class="xl:w-[80%] lg:w-[90%] md:w-[90%] sm:w-[92%] xs:w-[90%] mx-auto flex flex-col gap-4 items-center mt-6">
                <div class="w-full py-6 flex flex-col gap-4">
                    <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                        <div class="w-full sm:w-1/2 p-6 rounded-lg border flex flex-col justify-center border-gray-200 bg-slate-900">
                            <table class="w-full text-gray-900 dark:text-gray-200">
                                <tbody>
                                    <tr class="pb-3">
                                        <td class="text-gray-200 md:text-lg">Username</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_username'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="text-gray-200 md:text-lg">Email</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_email'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="text-gray-200 md:text-lg">Telephone</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_telepon'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="text-gray-200 md:text-lg">Favorites</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['num_favorites'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" onclick="openEditInfoModal()" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-md px-8 py-2.5 ">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Edit Image -->
    <div id="editImageModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-green-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Profile Image</h3>
                            <div class="mt-2">
                                <form id="editImageForm">
                                    <div class="mb-4">
                                        <label for="imageProfile" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Foto Profile</label>
                                        <input type="text" id="imageProfile" name="imageProfile" placeholder="https://" class="hidden w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                                        <button type="button" id="uploadPhoto" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Upload Image</button>
                                        <img id="imageProfilePreview" src="" alt="Image Preview" class="mt-2 hidden w-full h-auto rounded-md" />
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" onclick="submitEditImageForm()" class="inline-flex justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">Save</button>
                                        <button type="button" onclick="closeModal('editImageModal')" class="inline-flex justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Info -->
    <div id="editInfoModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-green-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit User Information</h3>
                            <div class="mt-2">
                                <form id="editInfoForm">
                                    <div class="mb-4">
                                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" name="username" id="username" value="<?= $user['user_username'] ?>" class="mt-1 p-2 text-black border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
                                        <input type="text" name="telephone" id="telephone" value="<?= $user['user_telepon'] ?>" class="mt-1 p-2 text-black border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" onclick="submitEditInfoForm()" class="inline-flex justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">Save</button>
                                        <button type="button" onclick="closeModal('editInfoModal')" class="inline-flex justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#uploadPhoto').click(function() {
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
                        $('#imageProfile').val(imageUrl); // set the image URL to the input field
                        $('#imageProfilePreview').attr('src', imageUrl); // set the image URL to the img element
                        $('#imageProfilePreview').removeClass('hidden');
                    }
                });
            });
        });

        function openEditImageModal() {
            document.getElementById("editImageModal").classList.remove("hidden");
        }

        function openEditInfoModal() {
            document.getElementById("editInfoModal").classList.remove("hidden");
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }

        function submitEditImageForm() {
            const form = document.getElementById('editImageForm');
            const formData = new FormData(form);

            fetch('pages/controller/profile/update_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Server response:', data); // Added for debugging
                    if (data.includes('success')) { // Ensure there is 'success' in the response
                        Swal.fire('Profile image updated successfully', '', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update profile image: ' + data, 'error'); // Display more informative error
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to update profile image', 'error');
                });
        }

        function submitEditInfoForm() {
            const form = document.getElementById('editInfoForm');
            const formData = new FormData(form);

            fetch('pages/controller/profile/update_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Server response:', data); // Added for debugging
                    if (data.includes('success')) { // Ensure there is 'success' in the response
                        Swal.fire('Profile information updated successfully', '', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update profile information: ' + data, 'error'); // Display more informative error
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to update profile information', 'error');
                });
        }
    </script>
</body>

<?php
// Menutup koneksi
mysqli_close($conn);
?>