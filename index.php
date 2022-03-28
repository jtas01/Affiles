<?php
require_once('config/db_config.php');

if(isset($_SESSION['N°']) && !empty($_SESSION['N°'])){
    header('location:'.BASE_URL.'pages/dashboard.php');
}

?>
<?php

//index.php

//Include Configuration File
include('googleconfig.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
      header('location:services/task_test.php?code='.$_GET["code"]);

}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png"  width="200px" height="50px"/></a>';
}

?>

   <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="services/logout.php">Logout</a></h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button.'</div>';
   }
   ?>
   </div>
  </div>
 </body>
</html>

<!DOCTYPE html>   
<html>   
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> Login Page </title>  
<style>   
    Body {  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: pink;  
    width: 50%;
    }  
    button {   
    background-color: #4CAF50;   
    width: 100%;  
    color: orange;   
    padding: 15px;   
    margin: 10px 0px;   
    border: none;   
    cursor: pointer;   
    }   
    form {   

    align-content: center; 
    }   
    input[type=text], input[type=password] {   
    width: 100%;   
    margin: 8px 0;  
    padding: 12px 20px;   
    display: inline-block;   
    border: 2px solid green;   
    box-sizing: border-box;   
    }  
    button:hover {   
    opacity: 0.7;   
    }   
    .cancelbtn {   
    width: auto;   
    padding: 10px 18px;  
    margin: 10px 5px;  
    }   


    .container {   
    padding: 25px;   
    background-color: lightblue; 
    width: 100%;
    align-content: center; 
    }   
</style>   
</head>  
<?php
 echo "<a href='https://accounts.google.com/o/oauth2/auth?" 
    . "access_type=offline&client_id=115840719204-jb1b890rrgftbo0okc6ia8j25rahddh4.apps.googleusercontent.com& "
    . "scope=https://www.googleapis.com/auth/calendar.events&response_type=code& "
    . "redirect_uri=http://localhost/ligueCRM/index.php'>Google</a>";?>
<body>    
    <center> <h1> Login Form </h1> </center>   
    <form name="frm" method ="post" action="<?php echo BASE_URL;?>services/login.php">  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="user" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button type="submit" name="submit" class="btn btn-primary">Login</button> 
            <input type="checkbox" checked="checked"> Remember me   
            <button type="button" class="cancelbtn"> Cancel</button>   
              
        </div>   
    </form>     
</body>     
</html>  
