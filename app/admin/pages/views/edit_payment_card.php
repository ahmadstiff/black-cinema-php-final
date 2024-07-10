<?php
include "../../config/conn.php";

$paymentCardId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM payment_card WHERE id='$paymentCardId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Payment card not found.');
}

mysqli_close($conn);
?>


<div class="w-full h-auto">
    <div class="flex px-10 items-center justify-center self-center">
        <form id="editMovieForm" class="p-4 md:p-5" action="pages/controller/payments/payment_card/edit_payment_card.php" method="POST">
            <input type="hidden" id="paymentCardId" name="paymentCardId" value="<?= $row['id']; ?>">
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="nameCard" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Nama Kartu</label>
                    <input type="text" id="nameCard" name="nameCard" value="<?= $row['nameCard']; ?>" placeholder="nama paket" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
                <div class="mb-4 w-1/2">
                    <label for="numberCard" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Nomor Kartu</label>
                    <input type="text" id="numberCard" name="numberCard" value="<?= $row['numberCard']; ?>" placeholder="0" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                </div>
            </div>
            <div class="flex flex-row w-full gap-3">
                <div class="mb-4 w-1/2">
                    <label for="categoryInstitue" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="categoryInstitue" name="categoryInstitue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="ewallet" <?= ($row['categoryInstitue'] == 'ewallet') ? 'selected' : ''; ?>>E-Wallet</option>
                        <option value="bank" <?= ($row['categoryInstitue'] == 'bank') ? 'selected' : ''; ?>>Bank</option>
                    </select>
                </div>
                <div class="mb-4 w-1/2">
                    <label for="imageCard" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Gambar Kartu</label>
                    <input type="text" id="imageCard" name="imageCard" value="<?= $row['imageCard']; ?>" placeholder="https://" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                    <button type="button" id="uploadWidget" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Upload Image</button>
                    <img id="imageCardPreview" src="" alt="Image Preview" class="mt-2 hidden w-full h-auto rounded-md" />
                </div>
            </div>
            <div class="mb-4 w-full">
                <label for="imageQR" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">Gambar QR</label>
                <input type="text" id="imageQR" name="imageQR" value="<?= $row['imageQR']; ?>" placeholder="https://" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:text-white">
                <button type="button" id="uploadWidget2" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Upload Image</button>
                <img id="imageQRPreview" src="" alt="Image Preview" class="mt-2 hidden w-full h-auto rounded-md" />
            </div>
            <div class="mt-2 flex justify-center w-full">
                <button type="submit" id="updateMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Update</button>
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
                    $('#imageCard').val(imageUrl); // set the image URL to the input field
                    $('#imageCardPreview').attr('src', imageUrl); // set the image URL to the img element
                    $('#imageCardPreview').removeClass('hidden');
                }
            });
        });
    });
    $(document).ready(function() {
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