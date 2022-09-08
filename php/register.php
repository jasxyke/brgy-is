<?php
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$famname = $address = $email = "";
$famname_err = $address_err = $email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT familyID FROM family_t WHERE famUser = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["pswd"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pswd"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["pswd"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["conpswd"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["conpswd"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    //validate family name
    if(empty(trim($_POST['famname']))){
        $famname_err = "Please enter a family name";
    }elseif(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['famname'])){
        $famname_err = "Only letters and white space allowed";    
    }
    else{
        $famname = trim($_POST['famname']);
    }

    //validate email
    if(empty(trim($_POST['email']))){
        $email_err = "Please enter an email";
    }
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid email format";
    }
    else{
        $email = trim($_POST['email']);
    }

    //validate home address
    if(empty(trim($_POST['address']))){
        $address_err = "Please enter an address";
    }
    else{
        $address = htmlspecialchars($_POST['address']);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)
        && empty($famname_err) && empty($email_err) && empty($address_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO  family_t(famUser, famPass, famEmail,
            famDisplayName, address) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password,
            $param_email, $param_famname, $param_address);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_famname = $famname;
            $param_address = $address;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: success.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Sign Up | Brgy. Pag-Asa Family I.S.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/BrgyIS/css/login.css" rel="stylesheet" type="text/css">
    <link href="/BrgyIS/css/theme.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="/BrgyIS/css/theme.css" rel="stylesheet" type="text/css">
    <!--Font families-->
    <!--Ubuntu font family-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<!--Poppins font family-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Ubuntu:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container container border">
        <div class="container header-section">
            <p class="display-2">Barangay Pag-Asa Family I.S.</p>
            <p class="display-6">Mandaluyong City</p>
        </div>
        <div class="form-section">
            <div class="container login-container">
                <div class="h4">Register your family</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="famname" class="form-label">Family Display Name</label>
                    <input type="text" class="form-control" id="famname" placeholder="Enter family display name" 
                    name="famname" required>
                    <?php 
                        if(!empty($famname_err)){
                            echo '<div class="alert alert-danger">' . $famname_err . '</div>';
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address" 
                    name="address" required>
                    <?php 
                        if(!empty($address_err)){
                            echo '<div class="alert alert-danger">' . $address_err . '</div>';
                        }
                    ?>
                  </div>
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
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email Address"
                     name="email" required>
                     <?php 
                        if(!empty($email_err)){
                            echo '<div class="alert alert-danger">' . $email_err . '</div>';
                        }
                    ?>
                  </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" onkeyup="check()" 
                    name="pswd" required>
                    <?php 
                        if(!empty($password_err)){
                            echo '<div class="alert alert-danger">' . $password_err . '</div>';
                        }
                    ?>
                  </div>
                  <div class="mb-3">
                    <label for="pwd" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="confirm-pass" placeholder="Enter your password again" 
                    onkeyup="check()" name="conpswd" required>
                    <?php 
                        if(!empty($confirm_password_err)){
                            echo '<div class="alert alert-danger">' . $confirm_password_err . '</div>';
                        }
                    ?>
                  </div>
                  <p id="message"></p>
                  <button type="submit" class="btn submit-btn" value="Submit">Submit</button>
            </form>
            <a href="login.php">
            <button type="button" class="btn btn-link mt-3">Already have an account? Click here to login.</button>
            </a>
        </div>
            </div>
            
        </div>

<script src="/BrgyIS/js/signup.js"></script>
</body>
</html>