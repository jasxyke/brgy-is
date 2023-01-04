<?php

session_start();
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_SESSION['members'])) {
    // Remove
    unset($_SESSION['members'][$_POST['index']]);
    $_SESSION["members"] = $_SESSION["members"];
    header("location: fam-setup.php");
}
?>