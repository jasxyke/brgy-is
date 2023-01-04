<?php

require_once "resident.php";

session_start();

//variables sheesh
$famID = $_SESSION["id"];
$username = $_SESSION["username"];
$famname = $_SESSION["famname"];
$address = $_SESSION["address"];

//initialize form variables
$lastname = $firstname = $midname = "";
$lastname_err = $firstname_err = $midname_err = "";

$birthdate = $occupation = $mobilenum = $email = $vaccState = "";
$birthdate_err = $occupation_err = $mobilenum_err = $email_err = $vaccState_err = "";
?>