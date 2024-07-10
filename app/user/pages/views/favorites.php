<?php
include "../../config/conn.php";
// Memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

$query = "
    SELECT movie.id, movie.poster_path
    FROM favorites
    INNER JOIN movie ON favorites.movie_id = movie.id
    WHERE favorites.user_id = $userId
";

$result = mysqli_query($conn, $query);
?>

<div class="mt-[13vh] flex justify-center items-center mx-auto w-full">
    <h1 class="text-5xl font-bold">Film Favoritmu🥶</h1>
</div>
<div class='mt-7 overflow-x-hidden overflow-y-hidden scrollbar-none relative flex justify-center flex-wrap items-center mx-8'>
    <?php
    if (mysqli_num_rows($result) > 0) {
        $favorites = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($favorites as $data) {
    ?>
            <div class="flex items-end h-full mr-3 movie-card" data-movie-id="<?= $data['id'] ?>">
                <div class='w-[190px] overflow-hidden' style="margin-inline-end: 12px;">
                    <div class="relative flex overflow-hidden">
                        <div class='w-[100%] max-h-none scale-95 hover:scale-100 duration-300'>
                            <div class='w-full' style="max-height: 'none'; user-select: 'none'; pointer-events: 'none';">
                                <a href="movie_details?id=<?= $data['id'] ?>" class='z-30 w-[190px] h-full'>
                                    <img src="<?= $data['poster_path'] ?>" alt="poster" class="inline-block w-full h-full object-cover rounded-lg" style="pointer-events: 'none';" />
                                </a>
                            </div>
                            <button class="toggleFavorite absolute top-0 right-0 py-4 px-3 bg-black/80 rounded-tr-lg rounded-bl-xl" data-movie-id="<?= $data['id'] ?>">
                                <span class="bookmark-icon far fa-bookmark text-yellow-500 text-[25px]"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="text-center w-full">No favorites found.</div>
    <?php
    }
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggleFavorite').forEach(button => {
            var movieId = button.getAttribute('data-movie-id');
            var isFavorited = localStorage.getItem('favorite_' + movieId);

            if (isFavorited === 'true') {
                button.querySelector('.bookmark-icon').classList.add('fas');
                button.querySelector('.bookmark-icon').classList.remove('far');
            } else {
                button.querySelector('.bookmark-icon').classList.add('far');
                button.querySelector('.bookmark-icon').classList.remove('fas');
            }

            button.addEventListener('click', function() {
                var movieId = button.getAttribute('data-movie-id');
                var isFavorited = localStorage.getItem('favorite_' + movieId);

                fetch('pages/controller/movies/add_favorite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${movieId}&favorite=${!(isFavorited === 'true')}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'added') {
                            localStorage.setItem('favorite_' + movieId, 'true');
                            button.querySelector('.bookmark-icon').classList.remove('far');
                            button.querySelector('.bookmark-icon').classList.add('fas');
                            Swal.fire('Added to favorites', '', 'success');
                        } else if (data === 'removed') {
                            localStorage.setItem('favorite_' + movieId, 'false');
                            button.querySelector('.bookmark-icon').classList.remove('fas');
                            button.querySelector('.bookmark-icon').classList.add('far');
                            button.closest('.movie-card').remove();
                            Swal.fire('Removed from favorites', '', 'success');
                        } else {
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Failed to update favorites', 'error');
                    });
            });
        });
    });
</script>

<?php
// Menutup koneksi
mysqli_close($conn);
?>