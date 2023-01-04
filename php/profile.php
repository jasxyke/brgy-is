
<?php
    require_once "config.php";
    require_once "resident.php";
    session_start();

    $famID = $_SESSION["id"];
    $famname = $_SESSION["famname"];
    $username = $_SESSION["username"];
    $address = $_SESSION["address"];
    $famEmail = $_SESSION["famEmail"];
    $members = array();

    $sql = "SELECT * FROM residents_t WHERE familyID = " . $famID;

    if($query = mysqli_query($link, $sql)){
        while($member = mysqli_fetch_assoc($query)){
            $fam = new Resident($famID, $member["lastName"], $member["firstName"], $member["middleName"],
        $member["mobileNum"], $member["birthdate"], $member["occupation"], $member["emailAdd"], 
        $member["vaccinationState"]);
            $fam->setResidentID($member["residentID"]);
            array_push($members, $fam);
        }
    }
    else{
        //do something when sql connection failed
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile | Brgy. Pag-Asa Family I.S.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--css file-->
        <link href="/BrgyIS/css/profile.css" rel="stylesheet" type="text/css">
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
    <nav class="navbar navbar-expand-sm title-header-box" >
            <div class="container-fluid">
                <img src="/BrgyIS/pics/logo.png" style="width: 40px;" alt="logo" class="rounded-pill">
                <a class="navbar-brand title-header" href="home.php">Barangay Pag-Asa Family I.S.</a>
            <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link my-nav-link " href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link my-nav-link active-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link my-nav-link" href="doc-request.php">Request Docoment</a></li>
            </ul>
            </div>
            <a href="logout.php" class="btn btn-color">Logout</a>
            </div>
        </nav>
        <div class="main-container">
            <section class="fam-section">
                <div class="view-title-box">
                    <p id="fam-name" class="display-2"><?php echo $famname?></p>
                </div>
                <div class="fam-details">
                    <div class="detail">
                        <p class="mid poppins">Username: </p>
                        <p class="sm ms-3" id="username"><?php echo $username?></p>
                    </div>
                    <div class="detail">
                        <p class="mid poppins">Adress: </p>
                        <p class="sm ms-3" id="address"><?php echo $address?></p>
                    </div>
                    <div class="detail">
                        <p class="mid poppins">Email Address: </p>
                        <p class="sm ms-3" id="username"><?php echo $famEmail?></p>
                    </div>
                </div>
            </section>
            <section class="members-section">
                <div class="view-title-box">
                    <p id="fam-name" class="display-4">Family Members</p>
                </div>
                <div id="accordion" class="content-box">
                    <?php 
                    $today = date("Y-m-d");
                    foreach($members as $member){
                        echo "
                    <div class='card'>
                    <div class='card-header'>
                        <a class='btn' data-bs-toggle='collapse'
                        href='#card-". $member->getResidentID() ."'>". $member->getFullname() ."</a>
                    </div>
                    <div id='card-". $member->getResidentID() ."' class='collapse' data-bs-parent='#accordion'>
                        <div class='card-body'>
                            <p><b>Name:</b>". $member->getFullname() ."</p>
                            <p><b>Age:</b> ". date_diff(date_create($member->getBirthdate()), date_create($today))->format('%y') ."</p>
                            <p><b>Occupation:</b> ". $member->getOccupation() ."</p>
                            <p><b>Mobile Number:</b> ". $member->getMobilenum() ."</p>
                            <p><b>Email Address:</b> ". $member->getEmail() . "</p>
                            <p><b>Vaccination State:</b> ". $member->getVaccstate() . "</p>
                        </div>
                    </div></div>";
                    }
                    
                ?>
                </div>
            </section>
        </div>
    </body>
</html>