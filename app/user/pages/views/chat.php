<?php
include "../../config/conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userRole = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="bg-gray-100">

    <div class="container mt-[10vh] mx-auto py-8">
        <div class="w-full max-w-lg md:max-w-2xl lg:max-w-4xl mx-auto h-[60vh] bg-white rounded-lg shadow-md overflow-hidden md:h-[80vh]">
            <div class="p-4 h-full flex flex-col">
                <h2 class="text-xl font-semibold text-gray-700 text-center">Admin</h2>
                <div id="chat-box" class="flex-1 overflow-y-scroll border p-2 my-4 bg-gray-300">
                    <!-- Chat messages will be appended here -->
                </div>
                <form id="chat-form" class="flex">
                    <input type="text" id="message" class="flex-1 border p-2 text-black" placeholder="Type a message">
                    <button type="submit" class="bg-blue-500 text-white p-2 ml-2 rounded-lg">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function loadChat() {
                var chatWith = <?php echo $userRole == 'user' ? '$(\'#chat-with\').val()' : '\'admin\''; ?>;
                $.ajax({
                    url: 'pages/controller/chat/chat_action.php?action=load',
                    method: 'GET',
                    data: {
                        chat_with: chatWith
                    },
                    success: function(data) {
                        $('#chat-box').html(data);
                    }
                });
            }

            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                var message = $('#message').val();
                var chatWith = <?php echo $userRole == 'admin' ? '$(\'#chat-with\').val()' : '\'admin\''; ?>;
                if (message) {
                    $.ajax({
                        url: 'pages/controller/chat/chat_action.php?action=send',
                        method: 'POST',
                        data: {
                            message: message,
                            chat_with: chatWith
                        },
                        success: function(data) {
                            $('#message').val('');
                            loadChat();
                        }
                    });
                }
            });

            <?php if ($userRole == 'user') : ?>
                $('#chat-with').on('change', function() {
                    loadChat();
                });
            <?php endif; ?>

            loadChat();
            setInterval(loadChat, 500); // Refresh chat every 500 milliseconds
        });
    </script>

</body>

</html>