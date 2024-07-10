<?php
if (!isset($_SESSION['user_image'])) {
    $_SESSION['user_image'] = 'default/path/to/image.jpg'; // Set a default image if not set
}
?>

<body>
    <nav class="absolute py-5 z-50 w-full h-fit inset-0 px-10 bg-black bg-opacity-30">
        <div class="flex flex-wrap items-center justify-between mx-auto">
            <a href="home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="h-12 rounded-lg" alt="Flowbite Logo" />
            </a>
            <div class="flex items-center md:hidden">
                <button id="menu-toggle" class="text-gray-300 hover:text-white focus:outline-none">
                    <i class="fa fa-bars fa-lg"></i>
                </button>
            </div>
            <div class="hidden md:flex flex-wrap items-center gap-3 justify-center mx-auto">
                <a href="about" class="flex items-center"><i class="fa-solid fa-info bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
                <a href="faq" class="flex items-center"><i class="fa-solid fa-question bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
                <a href="chat" class="flex items-center"><i class="fa-solid fa-message bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
                <a href="favorites" class="flex items-center"><i class="fa-solid fa-bookmark bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
                <a href="notification" class="flex items-center"><i class="fa-solid fa-bell bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
                <a href="movie_cart" class="flex items-center"><i class="fa-solid fa-cart-shopping bg-gray-900 text-gray-300 border-2 border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800 duration-200"></i></a>
            </div>
            <div class="relative md-auto">
                <button id="dropdownMenuButton" class="flex flex-row justify-center items-center gap-3 rounded-full px-2.5 border-2 border-gray-300 bg-gray-900 hover:bg-gray-800 duration-200 py-1.5 relative">
                    <i id="menu-icon" class="fas fa-bars w-5 h-5 self-center pt-0.5"></i>
                    <img id="user-image" src="<?php echo htmlspecialchars($_SESSION['user_image']); ?>" alt="User Image" class="rounded-full bg-white w-7 h-7 object-cover">
                </button>
                <div id="dropdownMenu" class="hidden absolute bg-black right-0 mt-2 w-48 border border-gray-300 shadow-lg rounded-xl p-1 text-white bg-black animate-slide-down">
                    <button id="profileButton" class="text-sm w-full p-2 rounded-lg text-left hover:bg-gray-800 duration-200" type="button">
                        <a href="profile">Profile</a>
                    </button>
                    <button onclick="window.location.href = 'logout'" class="text-sm w-full p-2 rounded-lg text-left hover:bg-gray-800 duration-200" type="button">
                        Sign Out
                    </button>
                </div>
            </div>
        </div>
        <div id="navbar-menu" class="hidden md:hidden mt-4 w-full">
            <ul class="flex flex-col items-center p-4 md:p-0 font-medium border backdrop-blur-sm border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0" id="navbar-menu-list">
                <li class="w-full">
                    <a href="about" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">About</a>
                </li>
                <li class="w-full">
                    <a href="faq" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">FAQ</a>
                </li>
                <li class="w-full">
                    <a href="chat" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">Chat</a>
                </li>
                <li class="w-full">
                    <a href="favorites" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">Favorites</a>
                </li>
                <li class="w-full">
                    <a href="notification" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">Notifications</a>
                </li>
                <li class="w-full">
                    <a href="movie_cart" class="text-gray-200 hover:bg-gray-800 duration-200 block px-4 py-2 rounded-lg">Cart</a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButton = document.getElementById('dropdownMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const menuToggle = document.getElementById('menu-toggle');
            const navbarMenu = document.getElementById('navbar-menu');

            menuToggle.addEventListener('click', function() {
                navbarMenu.classList.toggle('hidden');
            });

            dropdownButton.addEventListener('click', function(event) {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
