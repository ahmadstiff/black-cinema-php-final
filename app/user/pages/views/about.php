<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Parallax Star background in CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="\style\stars.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <style>
        .slideInUp {
            -webkit-animation-name: slideInUp;
            animation-name: slideInUp;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        @-webkit-keyframes slideInUp {
            0% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
                visibility: visible;
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            0% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
                visibility: visible;
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        .slideInDown {
            -webkit-animation-name: slideInDown;
            animation-name: slideInDown;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        @-webkit-keyframes slideInDown {
            0% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
                visibility: visible;
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            0% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
                visibility: visible;
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="m-0 p-0 border-0">
    <main class="mx-8">
        <div id='stars'></div>
        <div id='stars2'></div>
        <div id='stars3'></div>
        <div class='flex justify-center items-center mx-auto mt-[10vh]'>
            <div id='at-item' class='text-white text-bold text-7xl'>Tentang Kami</div>
        </div>
        <div class="flex flex-col mt-8 mb-4 p-8">
            <div class="flex justify-center gap-3">
                <div class="flex w-1/2 flex-col " id="at-block-left">
                    <div class="text-white mb-4 text-6xl">Black Cinema</div>
                    <div class="flex flex-col mt-3">
                        <div class="mb-3">Binema adalah website penyedia layanan pemesanan ruang mini bioskop secara online agar memudahkan pelanggan untuk melakukan pemesanan kapanpun dan dimanapun.</div>
                        <div class="mb-3">Kami Hadir untuk anda yang ingin menonton mini bioskop bersama pasangan atau teman.</div>
                        <div class="mb-3">Ruangan nyaman dan luas cocok untuk menonton sambil bersantai</div>
                        <div class="mb-3">Pemesanan mudah cepat dan tidak ribet.</div>
                    </div>
                </div>
                <div class="flex w-1/4 flex-col mt-8" id='at-block-right'>
                    <div class="text-white text-4xl">Alamat Kantor</div>
                    <div>Jogja</div>
                    <div class="text-white text-4xl mt-4">Kontak kami</div>
                    <div>081216483555</div>
                </div>
            </div>
        </div>
        <div class="bg-black/70 relative">
            <div>
                <UrProfile />
            </div>
            <div class="text-gray-200 ">
                <section class="text-gray-200 ">
                    <section class="slideInUp text-center py-12 px-4">
                        <h2 class="text-2xl font-bold text-gray-200 animate">Profil kami</h2>
                        <p class="mt-4 text-gray-300 max-w-2xl mx-auto animate">Binema adalah website penyedia layanan pemesanan ruang mini bioskop secara online agar memudahkan pelanggan untuk melakukan pemesanan kapanpun dan dimanapun.</p>
                        <div class="flex justify-center space-x-8 mt-8 animate">
                            <div class="transition transform hover:scale-110 animate">
                                <h3 class="text-xl font-bold ">18</h3>
                                <p class="text-blue-600 dark:text-blue-400">Ruang</p>
                            </div>
                            <div class="transition transform hover:scale-110 animate">
                                <h3 class="text-xl font-bold ">3</h3>
                                <p class="text-blue-600 dark:text-blue-400">Pilihan Paket</p>
                            </div>
                            <div class="transition transform hover:scale-110 animate">
                                <h3 class="text-xl font-bold ">500+</h3>
                                <p class="text-blue-600 dark:text-blue-400">Pilihan Film</p>
                            </div>
                        </div>
                    </section>

                    <section class="slideInDown text-gray-200 py-12 px-4" id="">
                        <h2 class="text-2xl font-bold text-center  animate">Misi kami</h2>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class=" rounded-lg shadow-md p-4 animate">
                                <h3 class="text-lg text-blue-600 font-semibold">Memantau Penjualan dan Stok Tiket</h3>
                                <p class="mt-2 text-gray-300 ">Bioskop dapat dengan mudah memantau penjualan tiket dan mengelola stok tiket secara efektif.</p>
                            </div>

                            <div class=" rounded-lg shadow-md p-4 animate">
                                <h3 class="text-lg text-blue-600 font-semibold">Meningkatkan Kepuasan Pelanggan</h3>
                                <p class="mt-2 text-gray-300 ">Membantu bioskop dalam meningkatkan kepuasan pelanggan dengan memberikan informasi yang akurat dan up-to-date tentang jadwal tayang film dan penjualan tiket.</p>
                            </div>

                            <div class=" rounded-lg shadow-md p-4 animate">
                                <h3 class="text-lg text-blue-600 font-semibold">Memudahkan Transaksi Online</h3>
                                <p class="mt-2 text-gray-300 ">Memudahkan pelanggan dalam melakukan transaksi online tanpa harus mengantri di loket penjualan tiket.</p>
                            </div>
                        </div>
                    </section>
                </section>

                <section class="slideInDown text-center flex flex-col w-full items-center py-12 px-4" id=''>
                    <h2 class="text-2xl font-bold  animate">Pilihan Paket</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full gap-8 mt-8 animate">
                        <div class="p-4 shadow-lg rounded-lg  hover:bg-gray-100 hover:text-gray-800 transition-colors animate">
                            <h3 class="text-xl font-bold ">REGULER</h3>
                        </div>
                        <div class="p-4 shadow-lg rounded-lg  hover:bg-gray-100 hover:text-gray-800 transition-colors animate">
                            <h3 class="text-xl font-bold ">VIP</h3>
                        </div>
                        <div class="p-4 shadow-lg rounded-lg  hover:bg-gray-100 hover:text-gray-800 transition-colors animate">
                            <h3 class="text-xl font-bold ">VVIP</h3>
                        </div>
                    </div>
                </section>

                <section class="slideInUp text-gray-200  py-12 px-4">
                    <h2 class="text-2xl font-bold text-center  animate">Fasilitas Yang Didapat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8 max-w-7xl mx-auto">
                        <div class="p-4 shadow-lg rounded-lg  hover:shadow-xl transition-shadow animate">
                            <h3 class="text-xl font-bold ">REGULAR</h3>
                            <p class="text-gray-200 mt-2">Tv 50 inch, fasilitas untuk 6 orang</p>
                        </div>
                        <div class="p-4 shadow-lg rounded-lg  hover:shadow-xl transition-shadow animate">
                            <h3 class="text-xl font-bold ">VIP</h3>
                            <p class="text-gray-200 mt-2">Tv 55 inch, fasilitas untuk 8 orang</p>
                        </div>
                        <div class="p-4 shadow-lg rounded-lg  hover:shadow-xl transition-shadow animate">
                            <h3 class="text-xl font-bold ">VVIP</h3>
                            <p class="text-gray-200 mt-2">Tv 60 inch , fasilitas untuk 10 orang</p>
                        </div>
                    </div>
                </section>
            </div>
    </main>
    <script>
        document.getElementById('at-item').animate([{
                offset: 0,
                filter: "blur(12px)",
                opacity: 0
            },
            {
                offset: 1,
                filter: "blur(0)",
                opacity: 1
            }
        ], {
            duration: 1000,
            easing: 'linear',
            delay: 0,
            iterations: 1,
            direction: 'normal',
            fill: 'none'
        });

        document.getElementById('at-block-right').animate([{
                offset: 0,
                transform: "rotateY(-100deg)",
                transformOrigin: "right",
                opacity: 0
            },
            {
                offset: 1,
                transform: "rotateY(0)",
                transformOrigin: "right",
                opacity: 1
            }
        ], {
            duration: 1000,
            easing: 'linear',
            delay: 0,
            iterations: 1,
            direction: 'normal',
            fill: 'none'
        });

        document.getElementById('at-block-left').animate([{
                offset: 0,
                transform: "rotateY(100deg)",
                transformOrigin: "left",
                opacity: 0
            },
            {
                offset: 1,
                transform: "rotateY(0)",
                transformOrigin: "left",
                opacity: 1
            }
        ], {
            duration: 1000,
            easing: 'linear',
            delay: 0,
            iterations: 1,
            direction: 'normal',
            fill: 'none'
        });
    </script>

</body>

</html>