

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
            </div>
        </nav>
        <div class="main-container">
            <section class="fam-section">
                <div class="view-title-box">
                    <p id="fam-name" class="display-2">Family Name</p>
                </div>
                <div class="fam-details">
                    <div class="detail">
                        <p class="mid poppins">Username: </p>
                        <p class="sm ms-3" id="username">jasxyke</p>
                    </div>
                    <div class="detail">
                        <p class="mid poppins">Adress: </p>
                        <p class="sm ms-3" id="address">54 pag-asa street</p>
                    </div>
                    <div class="detail">
                        <p class="mid poppins">Email Address: </p>
                        <p class="sm ms-3" id="username">jasxyke</p>
                    </div>
                </div>
            </section>
            <section class="members-section">
                <div class="view-title-box">
                    <p id="fam-name" class="display-4">Family Members</p>
                </div>
                <div id="accordion" class="content-box">
                    <div class="card">
                    <div class="card-header">
                        <a class="btn collapsed" data-bs-toggle="collapse"
                        href="#residentid">Jaspher Xyke M. Cortez</a>
                    </div>
                    <div id="residentid" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <p><b>Name:</b> Cortez, Jaspher Xyke M.</p>
                            <p>Age: 20</p>
                            <p>Occupation: Student</p>
                            <p>Mobile Number: 043123</p>
                            <p>Email Address: jasxyke</p>
                            <p>Vaccination State: vaccinated</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>