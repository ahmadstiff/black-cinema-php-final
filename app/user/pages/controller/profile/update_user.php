<?php
include "../../../../../config/conn.php";
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo 'not_logged_in';
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageProfile = isset($_POST['imageProfile']) ? mysqli_real_escape_string($conn, $_POST['imageProfile']) : '';
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $telephone = isset($_POST['telephone']) ? mysqli_real_escape_string($conn, $_POST['telephone']) : '';

    // Determine the type of update based on provided fields
    if (!empty($username) && !empty($telephone)) {
        // Update profile information
        $query = "UPDATE user SET user_username = '$username', user_telepon = '$telephone'";
        if (!empty($imageProfile)) {
            $query .= ", user_image = '$imageProfile'";
        }
        $query .= " WHERE user_id = $userId";
    } elseif (!empty($imageProfile)) {
        // Update only profile image
        $query = "UPDATE user SET user_image = '$imageProfile' WHERE user_id = $userId";
    } else {
        echo 'missing_fields';
        exit();
    }

    // Execute the query and check for errors
    if (mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error: ' . mysqli_error($conn); // Add MySQL error message for debugging
    }

    mysqli_close($conn);
} else {
    echo 'invalid_request';
}