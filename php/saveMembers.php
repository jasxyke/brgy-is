<?php

require_once "config.php";
require_once "resident.php";
session_start();

if(isset($_SESSION["members"]) && count($_SESSION["members"]) > 0){
    //sql statement
    $sql = "INSERT INTO residents_t(familyID, lastName, firstName,
    middleName, birthdate, occupation, mobileNum, emailAdd, vaccinationState)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $isFailed = 0;
    foreach($_SESSION["members"] as $resident){
        if($stmt = mysqli_prepare($link, $sql)){
            //bind variables
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_famID, $param_lastname,
            $param_firstName, $param_midname, $param_bday, $param_occupation, $param_mobilenum,
            $param_email, $param_vaccstate);
            
            //set parameters
            $param_famID = $_SESSION["id"];
            $param_lastname = $resident->getLastname();
            $param_firstName = $resident->getFirstname();
            $param_midname = $resident->getMidname();
            $param_bday = $resident->getBirthdate();
            $param_occupation = $resident->getOccupation();
            $param_mobilenum = $resident->getMobilenum();
            $param_email = $resident->getEmail();
            $param_vaccstate = $resident->getVaccstate();

            mysqli_stmt_execute($stmt);
        }
        else{
            $isFailed = 1;
            break;
        } 
    }
    if($isFailed){

        header("location: fam-setup.php");
    }
    else{
        $sql = "UPDATE family_t SET setupDone= ? WHERE familyID= ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_done, $param_famID);
            $param_done = 1;
            $param_famID = $_SESSION["id"];

            mysqli_stmt_execute($stmt);
        }
        header("location: home.php");
        }
    

}
?>