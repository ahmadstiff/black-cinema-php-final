<?php
include "../../../../../config/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $paymentId = isset($_GET['paymentId']) ? intval($_GET['paymentId']) : 0;

    if ($paymentId <= 0) {
        echo "Invalid payment ID";
        exit;
    }

    // Calculate total price
    $feeAdmin = 5000;
    $promoCode = isset($_POST['promoCode']) ? mysqli_real_escape_string($conn, $_POST['promoCode']) : '';
    $methodPayment = isset($_POST['methodPayment']) ? mysqli_real_escape_string($conn, $_POST['methodPayment']) : '';

    // Fetch payment details
    $queryPayment = "SELECT * FROM payment WHERE id = $paymentId";
    $resultPayment = mysqli_query($conn, $queryPayment);

    if (!$resultPayment || mysqli_num_rows($resultPayment) == 0) {
        echo "Payment record not found";
        exit;
    }

    $paymentData = mysqli_fetch_assoc($resultPayment);
    $price = $paymentData['price'];
    $totalPrice = $price + $feeAdmin; // Initialize total price with base price + admin fee

    // Check if promo code is provided and valid
    if (!empty($promoCode)) {
        $queryPromoCode = "SELECT * FROM payment_promo WHERE promoCode = '$promoCode'";
        $resultPromoCode = mysqli_query($conn, $queryPromoCode);

        if ($resultPromoCode && mysqli_num_rows($resultPromoCode) > 0) {
            $rowPromoCode = mysqli_fetch_assoc($resultPromoCode);
            $promoDiscount = $rowPromoCode['priceDisc'];
            $totalPrice -= $promoDiscount; // Apply promo discount
        } else {
            echo "<script>
                    alert('Promo code is invalid!');
                    window.history.back();
                  </script>";
            exit;
        }
    }

    // Update payment record
    $updateQuery = "UPDATE payment SET
                    totalPrice = '$totalPrice',
                    methodPayment = '$methodPayment',
                    promoCode = '$promoCode'
                    WHERE id = $paymentId";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: ../../../movie_cart');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
