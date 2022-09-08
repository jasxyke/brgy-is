<?php 
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = $sql_err =  "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["pswd"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["pswd"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT familyID, famUser, famPass, setupDone, famDisplayName, 
        address FROM family_t WHERE famUser = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, 
                    $setupDone, $famname, $address);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
                            $_SESSION["famname"]  = $famname;
                            $_SESSION["address"] = $address;                        
                            
                            if($setupDone){
                                // Redirect user to welcome page
                                header("location: home.php");
                            }
                            else{
                                header("location: home.php");
                                //header("location: fam-setup.php");
                            }
                            
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                $sql_err = "Oops! Something went wrong please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Brgy. Pag-Asa Family I.S.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/BrgyIS/css/login.css" rel="stylesheet" type="text/css">
    <link href="/BrgyIS/css/theme.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Font families-->
    <!--Ubuntu-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
            if(!empty($sql_err)){
                echo '<div class="alert alert-danger sql-err">' . $sql_err . '/div>';
            }
        ?>
    <div class="main-container container border">
        <div class="container header-section">
            <p class="display-2">Barangay Pag-Asa Family I.S.</p>
            <p class="display-6">Mandaluyong City</p>
        </div>
        
        <div class="form-section">
            <div class="container login-container">
                <div class="h4">Login</div>
                <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label">Family Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" 
                    name="username" required>
                    <?php 
                        if(!empty($username_err)){
                            echo '<div class="alert alert-danger">' . $username_err . '</div>';
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" 
                    name="pswd" required>
                    <?php 
                        if(!empty($password_err)){
                            echo '<div class="alert alert-danger">' . $password_err . '</div>';
                        }
                    ?>
                  </div>
                  
                  <button type="submit" class="btn submit-btn">Login</button>
            </form>
            <a href="/BrgyIS/php/register.php">
            <button type="button" class="btn btn-link mt-3">No account yet? Click here to register your family</button>
            </a>
       </div>
            </div>
            
        </div>
</body>
</html>

