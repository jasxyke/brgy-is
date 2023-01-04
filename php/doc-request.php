<?php
$requested = 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $requested = 1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Request Document | Brgy. Pag-Asa Family I.S.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--css file-->
        <link href="/BrgyIS/css/doc-request.css" rel="stylesheet" type="text/css">
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
                <li class="nav-item"><a class="nav-link my-nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link my-nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link my-nav-link active-link" href="doc-request.php">Request Docoment</a></li>
            </ul>
            </div>
            </div>
        </nav>
        <div class="main-container">
                <div class="view-title-box" id="xd">
                    <p class="header-title">Document Request Form</p>
                    <p class="sub-header">A form to request a document for a family member</p>
                </div>
            <div class="form-box">
                <form action="doc-request.php" method="post">
                    <div class="mb-3 mt-3">
                        <label for="fam-members" class="form-label">Who is requesting the document?</label>
                        <select name="fam-members" class="form-select" id="cars">
                            <option value="jaspher xyke cortez">Jaspher Xyke Cortez</option>
                            <option value="thyron james cortez">Thyron James Cortez</option>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <p>What are you requesting?</p>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="clearance" name="document"
                        value="clearance" checked>
                        <label for="clearance" class="form-check-label" >Barangay Clearance</label>
                        </div>
                        <div class="form-check">
                        <input type="radio" class="form-check-input" id="certif" name="document" 
                        value="certif">
                        <label for="certif" class="form-check-label">Barangay Certificate of Residency</label>
                        </div>
                        </div>
                    <div class="mb-3 mt-3">
                        <label for="purpose" class="form-label">Purpose(saan gagamitin?)</label>
                        <input type="text" class="form-control" id="purpose" placeholder="purpose"
                        name="purpose">
                        <input type="submit" value="Submit" class="btn submit-btn mt-5">
                    </div>
                    </div>
                </form>
<?php
            if($requested){
                echo "<div class='alert alert-success'>
    <strong>Success!</strong> We have received your request, a message via text message will
     be sent when the document is ready.
    </div>";
            }   
    ?>
            </div>
            
        </div>
    </body>