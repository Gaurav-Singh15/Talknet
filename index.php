<?php
    session_start();
    include("dbcon.php");
    include("links.php");

    if(isset($_GET["userId"]))
    {
        $_SESSION["userId"] = $_GET["userId"];
        header("Location: chatbox.php ");
    }
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box </title>
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="modal-dialog">
        <div class="modal-content">
            <div id="modal-header">
                <h4>Please Select Your Account</h4>
            </div>
            <div id="modal-body">
                <ol>
                <?php
                    $users = mysqli_query($connect,"Select * from users")or die("Failed to query Db".mysql_error());
                    while($user = mysqli_fetch_assoc($users))
                    {
                        echo '<li>
                        <A href = "index.php?userId='.$user["id"].'">
                        <div class = "info">
                        <h4>'.$user["User"].'</h4>
                        </div></li></a>
                        ';
                    }    
                ?>
                </ol>
                <a href="registerUser.php" style="float:right;">Register Here.</a>
            </div>
        </div>
    </div>
    <div class="signin-form">
        <form action="" method="post">
            <div class="form-header">
                <h2>Sign In</h2>
                <p>Login To myChat</p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input  class="form-control" type="email" name="email" id="email" placeholder="Enter your Email.." autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input  class="form-control" type="password" name="pass" id="pass" placeholder="*********" autocomplete="off" required>
            </div>
            <!-- <div class="small">
                forgot Password?<a href="forgot.php">Click Here</a>
            </div> -->
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in">Sign in</button>
            </div>
             <?php include("signin_user.php"); ?> 
        </form>
        <div class="text-center small" style="color:#67428B;">Dont Have an Account? <a href="registerUser.php">Create One</a></div>
    </div>
</body>
</html>