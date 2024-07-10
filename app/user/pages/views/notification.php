<?php
include '../../config/conn.php';

$query = mysqli_query($conn, "SELECT * FROM payment WHERE userId = '{$_SESSION['user_id']}' AND status = 'success' ORDER BY id DESC");
?>

<div class="w-full h-auto pt-[100px] px-5 sm:px-10">
    <div class="2xl:container 2xl:mx-auto py-10">
        <div class="md:py-12 lg:px-20 md:px-6 py-9 px-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="lg:text-4xl dark:text-white text-3xl lg:leading-9 leading-7 text-gray-800 font-semibold">Notification</h2>
            </div>
            <p class="text-xl dark:text-gray-400 leading-5 text-gray-600 font-medium">list notification</p>
        </div>
        <?php if (mysqli_num_rows($query) > 0) { ?>
            <div class="block relative md:py-10 lg:px-20 md:px-6 py-9 px-4 bg-gray-50 dark:bg-gray-800 w-full rounded-lg">
                <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <div>
                        <div class="flex space-x-2 text-gray-800 dark:text-white">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H15C14.4696 3 13.9609 3.21071 13.5858 3.58579C13.2107 3.96086 13 4.46957 13 5V17C13 18.0609 13.4214 19.0783 14.1716 19.8284C14.9217 20.5786 15.9391 21 17 21C18.0609 21 19.0783 20.5786 19.8284 19.8284C20.5786 19.0783 21 18.0609 21 17V5C21 4.46957 20.7893 3.96086 20.4142 3.58579C20.0391 3.21071 19.5304 3 19 3Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.9994 7.35022L10.9994 5.35022C10.6243 4.97528 10.1157 4.76465 9.58539 4.76465C9.05506 4.76465 8.54644 4.97528 8.17139 5.35022L5.34339 8.17822C4.96844 8.55328 4.75781 9.06189 4.75781 9.59222C4.75781 10.1225 4.96844 10.6312 5.34339 11.0062L14.3434 20.0062" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.3 13H5C4.46957 13 3.96086 13.2107 3.58579 13.5858C3.21071 13.9609 3 14.4696 3 15V19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M17 17V17.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="lg:text-2xl text-xl lg:leading-6 leading-5 font-medium">Tiket #<?= $row['id'] ?></p>
                        </div>
                        <div class="flex flex-col">
                            <span><?= $row['createdAt'] ?></span>
                        </div>
                        <div class="md:flex md:space-x-6 mt-8 grid grid-cols-3 gap-y-8 flex-wrap">
                            <span>Untuk lebih detail cek email anda</span>
                        </div>
                        <div class="flex pt-2">
                            <a href="https://mail.google.com" target="_blank" class="px-3 py-4 bg-white text-black font-semibold rounded-lg">Cek Email</a>
                        </div>
                    </div>
                    <hr class="bg-gray-200 lg:w-6/12 w-full md:my-10 my-8" />
                <?php } ?>
            </div>
        <?php } else { ?>
            <h2>Tidak ada notifikasi</h2>
        <?php } ?>
    </div>
</div>