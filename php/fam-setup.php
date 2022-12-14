<?php 

//initialize the session

//include the config file
require_once "config.php";
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
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

    // validate mobile number
    $email = $_POST["email"];

    // validate vaccination state
    if(empty(trim($_POST["vaccstate"]))){
        $vaccState = "Please select your vaccination state.";
    } else{
        $vaccState = trim($_POST["vaccstate"]);
    }

    if(empty($lastname_err) && empty($firstname_err) && empty($midname_err) && 
    empty($birthdate_err) && empty($occupation_err) && empty($mobilenum_err)){
        
        //create/update the list of members variable from the session variable
        if(isset($_SESSION["members"]) && is_array($_SESSION["members"])){
            $member = new Resident($famID, $lastname, $firstname, $midname, 
            $mobilenum, $birthdate, $occupation,$email,$vaccState);
            array_push($_SESSION["members"],$member);
        }
        else{
            $member = new Resident($famID, $lastname, $firstname, $midname, 
            $mobilenum, $birthdate, $occupation,$email,$vaccState);
            $_SESSION["members"] = array($member);
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Family Setup | Brgy. Pag-Asa Family I.S.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--css file-->
        <link href="/BrgyIS/css/fam-setup.css" rel="stylesheet" type="text/css">
        <link href="/BrgyIS/css/theme.css" rel="stylesheet" type="text/css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!--Font families-->
        <!--Ubuntu-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <!--Poppins-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <!--jQuery-->
        <script scr="/BrgyIS/js/jquery.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="main-container">
        <div class="title-header-box">
            <p class="title-header display-5">Barangay Pag-Asa Family I.S.</p>
        </div>
        <div class="views-container">
            <div class="view">
                <div class="view-title-box">
                    <p class="header-title"><?php echo $famname?></p>
                    <p class="sub-header"><?php echo $address?></p>
                </div>
                <div class="fam-members-list border border-2">
                    <p class="mid poppins">Family Members</p>
                    <!--
                    <div class="member-box">
                        <p class="h5">Firstname M.I. Lastname</p>
                        <p class="h6 poppins">09487834854</p>
                    </div>
                    -->
                    <?php
                        if(isset($_SESSION["members"])){
                            $count = 0;
                            foreach($_SESSION["members"] as $member){
                            echo "<div class='member-box border-top border-bottom border-1'>
                                    <div class='member-detail'>
                                    <p class='h5'>" . $member->getFullname() . "</p>" .
                                    "<p class'h6 poppins'>" . $member->getMobilenum() . "</p>" .
                                  "</div>" .
                                  "<form action='DeleteResident.php' method='post'>" .
                                    "<input type='hidden' name='index' value='". $count . "'>".
                                    "<input type='submit' value='Remove' class='btn submit-btn'>" .
                                    "</form>" . 
                                        "</div>";
                                        $count++;
                        }
                        }
                        
                    ?>
                </div>
                <div class="btn-box">
                    <form action="saveMembers.php" method="post">
                    <input type="submit" value="Done" class="btn submit-btn mt-4 me-2">
                    </form>
                </div>
            </div>
            <div class="view">
                <div class="view-title-box">
                    <p class="header-title">Resident Details</p>
                    <p class="sub-header">Enter the personal details 
                        of every member in the family</p>
                </div>
                <div class="form-box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" id="lastname" 
                        placeholder="Enter last name" name="lastname" 
                        required>

                        <input type="text" class="form-control" id="firstname" 
                        placeholder="Enter first name" name="firstname" 
                        required>

                        <input type="text" class="form-control" id="midname" 
                        placeholder="Enter middle name" name="midname" 
                        required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" 
                        placeholder="Enter birthday" name="birthday" 
                        required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" 
                        placeholder="Enter occupation" name="occupation" 
                        required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="mobilenum" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobilenum" 
                        placeholder="09#########" name="mobilenum" 
                         required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email Address(optional)</label>
                        <input type="email" class="form-control" id="email" 
                        placeholder="Enter Email Address" name="email" >
                    </div>
                    <div class="mb-3 mt-3">
                        <p>Vaccination State</p>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="unvacc" name="vaccstate"
                        value="unvaccinated" required>
                        <label for="unvacc" class="form-check-label" >Unvaccinated</label>
                        </div>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="firstdose" name="vaccstate" 
                        value="First Dose">
                        <label for="firstdose" class="form-check-label">First dose</label>
                        </div>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="fullvacc" name="vaccstate"
                        value="Fully Vaccinated">
                        <label for="fullvacc" class="form-check-label">Fully vaccinated</label>
                        </div>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="firstboost" name="vaccstate"
                        value="First Booster">
                        <label for="firstboost" class="form-check-label">First Booster</label>
                        </div>
                    </div>
                    <div class="btn-box add-btn">
                    <button type="submit" class="btn submit-btn mt-4 me-2">Add</button>
                </div>
                </form>
                </div>
                
            </div>
        </div>
        </div>
    </body>
</html>
    