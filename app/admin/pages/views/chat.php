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

    <div class="container mx-auto py-8">
        <div class="w-full max-w-lg md:max-w-2xl lg:max-w-4xl mx-auto h-[60vh] bg-white rounded-lg shadow-md overflow-hidden md:h-[80vh]">
            <div class="p-4 h-full flex flex-col">
                <?php if ($userRole == 'admin') : ?>
                    <select id="chat-with" class="w-full border text-black p-2 mb-4">
                        <option value="0">Select User</option>
                        <?php
                        // Ambil daftar user untuk admin pilih
                        $stmt = $conn->prepare("SELECT user_id, user_username, user_image FROM user WHERE user_role = 'user'");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['user_id'] . '" data-username="' . $row['user_username'] . '" data-image="' . $row['user_image'] . '">' . $row['user_username'] . '</option>';
                        }
                        $stmt->close();
                        ?>
                    </select>
                    <div id="selected-user" class="flex items-center mb-1">
                        <img id="selected-user-image" src="" alt="" class="w-10 h-10 rounded-full mr-2" style="display:none;">
                        <span id="selected-user-name" class="text-lg font-semibold text-gray-700"></span>
                    </div>
                <?php endif; ?>
                <div id="chat-box" class="flex-1 overflow-y-scroll border p-2 my-4 bg-gray-100">
                    <!-- Chat messages will be appended here -->
                </div>
                <form id="chat-form" class="flex">
                    <input type="text" id="message" class="flex-1 rounded-lg border p-2 text-black" placeholder="Type a message">
                    <button type="submit" class="bg-blue-500 rounded-lg text-white p-2 ml-2">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function loadChat() {
                var chatWith = <?php echo $userRole == 'admin' ? '$(\'#chat-with\').val()' : '\'admin\''; ?>;
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

            <?php if ($userRole == 'admin') : ?>
                $('#chat-with').on('change', function() {
                    loadChat();
                    var selectedOption = $(this).find('option:selected');
                    var username = selectedOption.data('username');
                    var userImage = selectedOption.data('image');

                    if (username && userImage) {
                        $('#selected-user-name').text(username);
                        $('#selected-user-image').attr('src', userImage).show();
                    } else {
                        $('#selected-user-name').text('');
                        $('#selected-user-image').hide();
                    }
                });
            <?php endif; ?>

            loadChat();
            setInterval(loadChat, 500); // Refresh chat every 500 milliseconds
        });
    </script>

</body>

</html>
