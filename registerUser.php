<?php
// session_start();
include("dbcon.php");
include("links.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<div id="modal-dialog">
    <div class="modal-content">
        <div id="modal-header">
            <h4>Register To your Name</h4>
        </div>
        <div id="modal-body">
            <form action="signup.php" method="POST" enctype ="multipart/form-data">
                <p>Name</p>
                <input type="text" name="uName" id="uName" class="form-control" autocomplete="off" required>
                <br>
                <p>email</p>
                <input type="email" name="uEmail" id="email" class="form-control" autocomplete="off" required>
                <br>
                <p>password</p>
                <input type="password" name="upwd" id="upwd" class="form-control" autocomplete="off" required>
                <br>
                <input type = "file" name ="photo" class="form-control" autocomplete="off" required>
                <input type="submit" name="sign_up"  class="btn btn-primary" style="float:right;" value="OK">
            </form>  
        </div>
    </div>
</div>    
</body>
</html>