<?php
include '../../config/conn.php';

$userId = $_SESSION['user_id'];

$queryPending = "
SELECT 
    p.*, 
    m.title, 
    m.poster_path, 
    m.overview
FROM 
    payment p
LEFT JOIN 
    movie m ON p.movieId = m.id
WHERE 
    p.status = 'pending' 
    AND p.userId = '$userId' 
    AND p.expiredPayment > NOW()";

$querySuccess = "
    SELECT 
        p.*, 
        m.title, 
        m.poster_path, 
        m.overview,
        p.totalPrice,
        p.startTime,
        p.methodPayment,
        p.room
    FROM 
        payment p
    LEFT JOIN 
        movie m ON p.movieId = m.id
    WHERE 
        p.status = 'success' 
        AND p.userId = '$userId'";


$queryCancelled = "
    SELECT 
        p.*, 
        m.title, 
        m.poster_path, 
        m.overview,
        p.totalPrice,
        p.startTime,
        p.methodPayment,
        p.room
    FROM 
        payment p
    LEFT JOIN 
        movie m ON p.movieId = m.id
    WHERE 
        p.status = 'canceled' 
        AND p.userId = '$userId'";

$resultPending = mysqli_query($conn, $queryPending);
$resultSuccess = mysqli_query($conn, $querySuccess);
$resultCancelled = mysqli_query($conn, $queryCancelled);

$queryTotalPrice = "
SELECT 
    SUM(totalPrice) as totalPrice 
FROM 
    payment 
WHERE 
    status = 'pending' 
    AND userId = '$userId' 
    AND expiredPayment > NOW()";

$resultTotalPrice = mysqli_query($conn, $queryTotalPrice);
$rowTotalPrice = mysqli_fetch_assoc($resultTotalPrice);

$queryCard = mysqli_query($conn, "SELECT * FROM payment_card");
$queryPromo = mysqli_query($conn, "SELECT * FROM payment_promo");
$promoCode = $_POST['promoCode'] ?? '';
$promoMessage = '';

if (!empty($promoCode)) {
    $queryPromo = mysqli_query($conn, "SELECT * FROM payment_promo WHERE promoCode = '$promoCode'");
    if (mysqli_num_rows($queryPromo) > 0) {
        $promo = mysqli_fetch_assoc($queryPromo);
        $discountedPrice = $rowTotalPrice['totalPrice'] - $promo['discount'];

        $promoMessage = "<p class='text-base text-green-500'>Diskon " . $promo['discount'] . "% berhasil digunakan.</p>";
?>
        <div class="flex justify-between items-center mt-2">
            <p class="text-base text-green-500">Total Pembayaran Setelah Diskon:</p>
            <p class="text-base text-green-500">Rp <?= number_format($discountedPrice, 2, ',', '.') ?></p>
        </div>
<?php
    } else {
        $promoMessage = "<p class='text-base text-red-500'>Kode promo tidak valid.</p>";
    }
}

?>

<div class="w-screen min-h-screen">
    <div class="w-full bg-cover bg-black/50">
        <div class="flex flex-col w-full justify-center items-center pt-[100px]">
            <h2 class="title font-manrope font-bold text-2xl leading-10 mb-8 text-center text-white">Keranjang</h2>
            <?php if (mysqli_num_rows($resultPending) > 0) { ?>
                <div>
                    <div class="flex flex-col items-center justify-center gap-4 max-w-xl">
                        <?php while ($rowPayment = mysqli_fetch_assoc($resultPending)) { ?>
                            <div class="rounded-2xl border-2 border-gray-200 p-4 lg:p-8 grid grid-cols-12 mb-8 max-lg:max-w-lg max-lg:mx-auto gap-y-4 ">
                                <div class="col-span-12 lg:col-span-3 flex items-center">
                                    <img src="<?= $rowPayment['poster_path'] ?>" alt="poster" class="max-lg:w-full lg:w-[200px] rounded-lg">
                                </div>
                                <div class="col-span-12 lg:col-span-9 detail w-full lg:pl-3 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between w-full mb-4">
                                            <h5 class="font-manrope font-bold text-2xl leading-9 text-white"><?= $rowPayment['title'] ?></h5>
                                            <button class="rounded-full group flex items-center justify-center focus-within:outline-red-500">
                                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle class="fill-red-50 transition-all duration-500 group-hover:fill-red-400" cx="17" cy="17" r="17" fill="" />
                                                    <path class="stroke-red-500 transition-all duration-500 group-hover:stroke-white" d="M14.1673 13.5997V12.5923C14.1673 11.8968 14.7311 11.333 15.4266 11.333H18.5747C19.2702 11.333 19.834 11.8968 19.834 12.5923V13.5997M19.834 13.5997C19.834 13.5997 14.6534 13.5997 11.334 13.5997C6.90804 13.5998 27.0933 13.5998 22.6673 13.5997C21.5608 13.5997 19.834 13.5997 19.834 13.5997ZM12.4673 13.5997H21.534V18.8886C21.534 20.6695 21.534 21.5599 20.9807 22.1131C20.4275 22.6664 19.5371 22.6664 17.7562 22.6664H16.2451C14.4642 22.6664 13.5738 22.6664 13.0206 22.1131C12.4673 21.5599 12.4673 20.6695 12.4673 18.8886V13.5997Z" stroke="#EF4444" stroke-width="1.6" stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>
                                        <p class="font-normal text-base leading-7 text-gray-500 mb-6 line-clamp-2">
                                            <?= $rowPayment['overview'] ?>
                                        </p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-4">
                                            <span class="font-semibold text-lg">Paket <?= $rowPayment['packageName'] ?></span>
                                        </div>
                                        <h6 class="font-manrope font-semibold text-lg leading-9 text-right">Rp <?= number_format($rowPayment['totalPrice'], 2, ',', '.') ?></h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $queryPayment = mysqli_query($conn, "SELECT * FROM payment WHERE userId = '$userId' AND status = 'pending' AND id = '$rowPayment[id]'");
                            while ($resultPayment = mysqli_fetch_assoc($queryPayment)) {
                                $queryCardSelected = mysqli_query($conn, "SELECT * FROM payment_card WHERE nameCard = '$resultPayment[methodPayment]'");
                            ?>
                                <div class='flex flex-col items-center justify-center'>
                                    <?php if ($resultPayment['methodPayment'] === '' && $resultPayment['status'] === 'pending') { ?>
                                        <form action="pages/controller/payments/update_method_promo.php?paymentId=<?= $resultPayment['id'] ?>" method="POST">
                                            <div id="payment-method" class='flex flex-col w-[70vw] lg:w-[40vw] pb-2 items-center'>
                                                <?php
                                                $index = 0;
                                                mysqli_data_seek($queryCard, 0);
                                                while ($rowCard = mysqli_fetch_assoc($queryCard)) {
                                                    $isChecked = $index === 0 ? 'checked' : '';
                                                ?>
                                                    <div class='flex flex-row w-full h-20 justify-between rounded-tr-lg mt-5 rounded-tl-lg <?= $isChecked ? 'bg-gray-200 dark:bg-gray-800' : 'bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer' ?>' onClick='handleClick(<?= $index ?>)'>
                                                        <img src="<?= $rowCard['imageCard'] ?>" alt="pay" class='w-[100px] pl-3 object-contain' />
                                                        <input type="radio" class="card-select mr-3" name="methodPayment" value="<?= $rowCard['nameCard'] ?>" <?= $isChecked ?> data-imageqr="<?= $rowCard['imageQR'] ?>" required />
                                                    </div>
                                                    <div class='flex flex-row justify-between items-center w-full py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded-br-lg rounded-bl-lg border-t-2 border-gray-400 dark:border-gray-600'>
                                                        <span class='text-black dark:text-white pl-4 font-medium'> <?= $rowCard['nameCard'] ?></span>
                                                        <a href="carakerja?nameCard=<?= $rowCard['nameCard'] ?>" class='text-blue-500 dark:text-blue-400 font-bold mr-3 border-2 border-blue-500 dark:border-blue-400 p-1 rounded-lg cursor-pointer animate-bounce mt-2'><span>?</span></a>
                                                    </div>
                                                <?php
                                                    $index++;
                                                }
                                                ?>
                                                <input type="text" name="promoCode" placeholder="Masukkan kode promo" class="px-4 py-2 border border-gray-600 mt-3 rounded-md bg-gray-800 w-[70vw] lg:w-[40vw]">
                                            </div>
                                            <?php if (!empty($promoCode)) { ?>
                                                <div class="flex justify-between items-center mt-4">
                                                    <p class="text-base text-gray-200">Total Pembayaran Sebelum Diskon:</p>
                                                    <p class="text-base text-gray-200">Rp <?= number_format($rowTotalPrice['totalPrice'], 2, ',', '.') ?></p>
                                                </div>
                                                <?= $promoMessage ?>
                                                <?php if (mysqli_num_rows($promoQuery) > 0) { ?>
                                                    <div class="flex justify-between items-center mt-2">
                                                        <p class="text-base text-green-500">Total Pembayaran Setelah Diskon:</p>
                                                        <?php
                                                        $promo = mysqli_fetch_assoc($promoQuery);
                                                        $discountedPrice = $rowTotalPrice['totalPrice'] - $promo['discount'];
                                                        ?>
                                                        <p class="text-base text-green-500">Rp <?= number_format($discountedPrice, 2, ',', '.') ?></p>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                            <div id="checkout-button" class="max-lg:max-w-lg max-lg:mx-auto">
                                                <p class="font-normal text-base leading-7 text-gray-500 text-center mb-5 mt-6">Shipping taxes, and discounts calculated at checkout</p>
                                                <button id="checkout" type="submit" class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700">Checkout</button>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <div>
                                            <?php while ($resultCard = mysqli_fetch_assoc($queryCardSelected)) { ?>
                                                <div class="flex w-full h-auto">
                                                    <div class="flex w-full h-full mt-10 justify-center items-center">
                                                        <div class="flex flex-col items-center border-2 bg-gray-900 border-white px-20 py-5 rounded-lg">
                                                            <h1 class="text-[30px] text-white">Pembayaran</h1>
                                                            <div class="flex flex-col items-center pt-4">
                                                                <img src="<?php echo $resultCard['imageCard']; ?>" alt="img" loading="lazy" class="w-[100px] h-fit flex animate-bounce rounded-lg" />
                                                            </div>
                                                            <div>
                                                                <div class="flex flex-col justify-center items-center px-3 pt-3 bg-[#20344c] rounded-[20px] w-fit h-fit">
                                                                    <div class="flex p-10 bg-white w-fit h-fit rounded-[20px]">
                                                                        <img src="<?= $resultCard['imageQR'] ?>" alt="img" loading="lazy" class="max-w-[150px] h-fit w-fit" />
                                                                    </div>
                                                                    <span class="flex py-3 font-medium text-white">Scan to pay</span>
                                                                </div>
                                                            </div>
                                                            <span class="flex my-5 text-white">atau</span>
                                                            <div class="flex flex-col items-center">
                                                                <h1 class="flex mb-2 text-white">Transfer rekening</h1>
                                                                <span class="flex bg-[#20344c] py-2 px-20 rounded-[20px] text-white"><?php echo $resultCard['numberCard']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                    <p class="font-manrope font-semibold text-xl leading-9 text-center">Belum ada transaksi</p>
                </div>
            <?php } ?>

            <h2 class="title font-manrope font-bold text-2xl leading-10 mb-8 mt-12 text-center text-white">Pembayaran Sukses</h2>
            <?php if (mysqli_num_rows($resultSuccess) > 0) { ?>
                <div class="w-screen">
                    <table class="w-full max-w-screen-xl mx-auto ">
                        <thead class="bg-gray-950">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Waktu Tayang</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Metode Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Ruang</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-900">
                            <?php foreach ($resultSuccess as $rowPayment) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded" src="<?= $rowPayment['poster_path'] ?>" alt="<?= $rowPayment['title'] ?>">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['title'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200">Rp <?= number_format($rowPayment['totalPrice'], 2, ',', '.') ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['startTime'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['methodPayment'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['room'] ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                    <p class="font-manrope font-semibold text-xl leading-9 text-center">Belum ada pembayaran sukses</p>
                </div>
            <?php } ?>

            <!-- Tampilkan Pembayaran Dibatalkan -->
            <h2 class="title font-manrope font-bold text-2xl leading-10 mb-8 mt-12 text-center text-white">Pembayaran Dibatalkan</h2>

            <?php if (mysqli_num_rows($resultCancelled) > 0) { ?>
                <div class="w-full max-w-screen-xl mx-auto">
                    <table class="w-full divide-y divide-gray-900">
                        <thead class="bg-gray-950">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Waktu Tayang</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Metode Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Ruang</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-900">
                            <?php foreach ($resultCancelled as $rowPayment) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded" src="<?= $rowPayment['poster_path'] ?>" alt="<?= $rowPayment['title'] ?>">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['title'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200">Rp <?= number_format($rowPayment['totalPrice'], 2, ',', '.') ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['startTime'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['methodPayment'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-200"><?= $rowPayment['room'] ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                    <p class="font-manrope font-semibold text-xl leading-9 text-center">Belum ada pembayaran dibatalkan</p>
                </div>
            <?php } ?>

        </div>
    </div>
</div>