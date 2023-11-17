<?php
session_start();
include("dbcon.php");
include("links.php");

$users = mysqli_query($connect, "SELECT * FROM users WHERE Id ='".$_SESSION["userId"]."'")
    or die("Failed to qUERY database".mysql_error());
    $user = mysqli_fetch_assoc($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Chat Box</title>
</head>
<style type="text/css">
    #wrapper{
        max-width:900px;
        min-height:500px;
        margin:auto;
        display:flex;
        color:white;
        font-size:13px;
    }
    #left_pannel{
        min-height:500px;
        background-color:#27344b;
        flex:1;
    }
    #profile_image{

        width:80%;
        border:solid thin white;
        border-radius:50%;
        margin:10px;
        padding:10px;
    }
    #left_pannel label{

        width:100%;
        height:20px;
        display:block;
        font-size:13px;
        /* text-align:center; */
        background-color:#404b56;
        border-bottom:solid thin #ffffff55;
        cursor:pointer;
        padding:5px;
        transition:all 0.5s ease;
    }
    #left_pannel label:hover{
        background-color:#778593;
    }
    #left_pannel label img{
        
        float:right;
        width:25px;
       
    }
    #right_pannel{
        min-height:400px;
        /* background-color:green; */
        flex:4;
        text-align:center;
    }
    #header{
        background-color:#485b6c;
        height:70px;
        font-size:40px;
        text-align:center;
    }
    #inner_left_pannel{

        background-color:#383e48;
        flex:1;
        min-height:430px;
    }
    #inner_right_pannel{

        background-color:#f2f7f8;
        flex:2;
        min-height:430px;
        transition:all 0.8s ease;

    }
    #radio_contacts:checked ~ #inner_right_pannel{
       
        flex:0;
    }
    #radio_settings:checked ~ #inner_right_pannel{
       
       flex:0;
   }
</style>
<body>
<div id="wrapper">
        <div id="left_pannel">
            <div style="padding:10px;">
                <img id="profile_image"src="ui/images/user3.jpg" >
                <br>
                Kelly 
                <br>
                <span style= "font-size:12px; opacity:0.5">abc@gmail.com</span>

                <br>
                <br>
                <br>
                <div>
                <label id="label_chat" for="radio_chat">chat<img src="ui/icons/chat.png"></label>
                <label id="label_contacts" for="radio_contacts">Contacts<img src="ui/icons/contacts.png"></label>
                <label id="label_settings" for="radio_settings">Settings<img src="ui/icons/settings.png"></label>
                </div>
            </div>
        </div>
        <div id="right_pannel">
            <div id="header">MY CHAT</div>
            <div id="container" style="display:flex;">
                <div id="inner_left_pannel">
                    Hello THERE
                </div>

                <input type="radio" id="radio_chat" name="myradio" style="display:none;">
                <input type="radio" id="radio_contacts" name="myradio" style="display:none;">
                <input type="radio" id="radio_settings" name="myradio" style="display:none;">
                
                
                <div id="inner_right_pannel">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <p>Hi <?php echo $user["User"]; ?></p>
                <input type="text" id="fromUser" value=<?php echo $user["id"]; ?> hidden >

                <p>Send Message to: </p>
                <ul>
                    <?php
                        $msgs = mysqli_query($connect,"SELECT * FROM users")
                        or die("Failed to qUERY database".mysql_error());
                        while($msg = mysqli_fetch_assoc($msgs))
                        {
                            
                            echo '<li><a href="?toUser='.$msg["id"].'">'.$msg["User"].'</a></li>';
                        }
                    ?>
                </ul>
                <a href="index.php">Back to Home Page </a>
            </div>
            <div class="col-md-4">
                <div id="modal-dialog">
                    <div class="modal-content">
                        <div id="modal-header">
                            <h4>
                                <?php
                                if(isset($_GET["toUser"]))
                                {
                                    $userName = mysqli_query($connect,"SELECT * FROM users WHERE id = '".$_GET["toUser"]."' ")
                                    or die("Failed to qUERY database".mysql_error());
                                    $uName = mysqli_fetch_assoc($userName);
                                    echo '<input type="text" value='.$_GET["toUser"].' id="toUser" hidden />';
                                    echo $uName["User"];   
                                }
                                else 
                                {
                                    $userName = mysqli_query($connect,"SELECT * FROM users")
                                    or die("Failed to qUERY database".mysql_error());
                                    $uName = mysqli_fetch_assoc($userName);
                                    $_SESSION["toUser"] = $uName["id"];
                                    echo '<input type="text" value='.$_SESSION["toUser"].' id="toUser" hidden />';
                                    echo $uName["User"];
                                }
                                ?>
                            </h4>
                        </div>
                        <div id="msgBody" style="height:400px; overflow-y: scroll;overflow-x: hidden;">
                            <?php
                                if(isset($_GET["toUser"]))
                                {
                                    $chats = mysqli_query($connect,"SELECT * FROM messages where (FromUser = '".$_SESSION["userId"]."' AND 
                                        ToUser = '".$_GET["toUser"]."') OR (FromUser = '".$_GET["toUser"]."' AND ToUser = '".$_SESSION["userId"]." ') ")
                                    or die("Failed to qUERY database".mysql_error());
                                    
                                }
                                else
                                {
                                    $chats = mysqli_query($connect,"SELECT * FROM messages where (FromUser = '".$_SESSION["userId"]."' AND 
                                    ToUser = '".$_SESSION["toUser"]."') OR (FromUser = '".$_SESSION["toUser"]."' AND ToUser = '".$_SESSION["userId"]."') ")
                                    or die("Failed to qUERY database".mysql_error());
                                     
                                }
                                while($chat = mysqli_fetch_assoc($chats))
                                {
                                    if($chat["FromUser"] == $_SESSION["userId"])
                                        echo "<div style='text-align:right;'>
                                                <p style='background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; 
                                                border-radius:10px;max-width:70%;'>
                                                    ".$chat["Message"]."
                                                </p>
                                              </div>";
                                    else    
                                    echo "<div style='text-align:left;'>
                                            <p style='background-color:green; word-wrap:break-word; display:inline-block; padding:5px; 
                                            border-radius:10px;max-width:70%;'>
                                            ".$chat["Message"]."
                                            </p>
                                            </div>";           
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <textarea id="message" class="form-control"  style="height:70px"></textarea>
                            <button id="send" class="btn btn-primary" style="height:70%;">send</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            
            </div>
        </div>
    </div>
    

</body>
<script type="text/javascript" >
    $(document).ready(function(){

        $('#send').on("click" , function(){
            $.ajax({
                url:"insertMessage.php",
                method:"POST",
                data:{
                    fromUser:$("#fromUser").val(),
                    toUser:$("#toUser").val(),
                    message:$("#message").val(),
                },
                dataType:"text",
                success:function(data)
                {
                    $("#message").val("");
                }
            });
        });

        setInterval(function(){
            $.ajax({
               url:"realtimeChat.php",
               method:"POST",
               data:{
                   fromUser:$("#fromUser").val(),
                   toUser:$("#toUser").val(),    
               },
               dataType:"text",
               success:function(data)
               {
                //    console.log(data);
                   $("#msgBody").html(data);
               } 
            });
        }, 700);
    });
</script>
</html>