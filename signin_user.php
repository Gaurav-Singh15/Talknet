<?php
session_start();

Include("dbcon.php");

        if(isset($_POST['sign_in'])){
            
            $email = htmlentities(mysqli_real_escape_string($connect , $_POST['email']));
            $pass = htmlentities(mysqli_real_escape_string($connect , $_POST['pass']));

            $select_user = "select * from users where email = '$email' AND pwd= '$pass' ";
            
            $query = mysqli_query($connect ,$select_user);
            $check_user =mysqli_num_rows($query);

            if($check_user == 1){
                $_SESSION['email'] = $email;

                $update_msg = mysqli_query($connect ,"UPDATE users SET log_in='Online' WHERE email ='$email'");

                $user = $_SESSION['email'];
                $get_user ="select * from users where user_email='$user'";
                $run_user = mysqli_query($connect ,$get_user);
                $row = mysqli_fetch_array($run_user);

                $user_name =$row['user_name'];

                echo"<script>window.open('chatbox.php','_self')</script>";
            }
            else{
                echo"
                    <div class='alert-danger'>
                        <strong>Check Your Email and Password.</strong>
                    </div>
                ";
            }
        }

?>