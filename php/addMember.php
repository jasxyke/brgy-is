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

//process form date when form is submitted
    // validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter lastname.";
    } else{
        $lastname = trim($_POST["lastname"]);
    }

    // validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter firstname.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    // validate middle name
    if(empty(trim($_POST["midname"]))){
        $midname_err = "Please enter middlename.";
    } else{
        $midname = trim($_POST["midname"]);
    }

    // validate birthday
    if(empty(trim($_POST["birthday"]))){
        $birthdate_err = "Please enter your birthday.";
    } else{
        $birthdate = trim($_POST["birthday"]);
    }

    // validate occupation
    if(empty(trim($_POST["occupation"]))){
        $occupation_err = "Please enter your occupation.";
    } else{
        $occupation = trim($_POST["occupation"]);
    }

    // validate mobile number
    if(empty(trim($_POST["mobilenum"]))){
        $mobilenum_err = "Please enter your mobilenum.";
    } else{
        $mobilenum = trim($_POST["mobilenum"]);
    }

    if(empty($lastname_err) && empty($firstname_err) && empty($midname_err) && 
    empty($birthdate_err) && empty($occupation_err) && empty($mobilenum_err)){
        
        //create/update the list of members variable from the session variable
        if(isset($_SESSION["members"]) && is_array($_SESSION["members"])){
            $member = new Resident($famID, $lastname, $firstname, $midname, $mobilenum);
            array_push($_SESSION["members"],$member);
        }
        else{
            $member = new Resident($famID, $lastname, $firstname, $midname, $mobilenum);
            $_SESSION["members"] = array($member);
        }
    }
    header("location: fam-setup.php");
?>