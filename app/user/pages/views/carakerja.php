<?php 
include '../../config/conn.php';

$getNameCard = $_GET['nameCard'];

$query = mysqli_query($conn, "SELECT * FROM payment_card WHERE nameCard = '$getNameCard'");
$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">
    <div class="container mx-auto py-16">
        <div class="bg-black max-w-md mx-auto p-6 rounded-lg shadow-lg">
            <div class="bg-gray-100 bg-opacity-25 rounded-lg text-center py-8">
                <img src="<?= $row['imageCard'] ?>" alt="img" class="block mx-auto rounded-lg" width="250">
            </div>

            <div class="mt-8">
                <div class="space-y-4">
                    <div class="border-2 border-gray-700 rounded-lg p-4">
                        <h2 class="font-bold text-xl">Bayar dengan nomor rekening</h2>
                        <ul class="list-disc list-inside">
                            <li>Buka aplikasi Anda</li>
                            <li>Masukkan nomor rekening tujuan</li>
                            <li>Periksa detail transaksi Anda pada aplikasi, lalu tap tombol Bayar</li>
                            <li>Masukkan PIN Anda</li>
                            <li>Transaksi selesai</li>
                        </ul>
                    </div>

                    <div class="border-2 border-gray-700 rounded-lg p-4">
                        <h2 class="font-bold text-xl">Bayar dengan kode QR</h2>
                        <ul class="list-disc list-inside">
                            <li>Buka aplikasi Anda</li>
                            <li>Pindai kode QR pada monitor Anda</li>
                            <li>Periksa detail transaksi Anda pada aplikasi, lalu tap tombol Bayar</li>
                            <li>Masukkan PIN Anda</li>
                            <li>Transaksi selesai</li>
                        </ul>
                    </div>

                    <div class="text-center mt-8">
                        <p class="text-xs text-gray-500">Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan kembali dengan Virtual Account agar nomor tetap sama</p>
                        <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg mt-4">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
