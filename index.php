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
    // header('location:services/task_test.php?code='.$_GET["code"]);

}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
  //Create a URL to obtain user authorization
  $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png"  width="200px" height="50px"/></a>';
}
 
?>



<!DOCTYPE html>   
<html>   
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> Login Page </title>  
<style>   
    Body {  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: pink;  
    width: 100%;
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
    width: 500px;
    align-content: center; 
    } 
    .error{
        font-size: 18px;
        color: red;
    }  
</style>   
</head>  

<body>  
<?php 
$error ='';
if(isset($_GET['msg']) && $_GET['msg'] =='error'){
$error='You have entered a wrong email or password!!!';
}
?>  
    <center> <h1> Login Form </h1> 
    <div class="error"><?php echo $error;?></div>   
     <form name="frm" method ="post" action="<?php echo BASE_URL;?>services/login.php"> 
        <div class="container">          
            <label>nom d'utilisateur : </label>   
            <input type="text" placeholder="Enter Username" name="user" required>  
            <label>le mot de passe : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button type="submit" name="submit" class="btn btn-primary">Login</button> 
        </div>   
    </form>  
<?php
if($login_button == '')
{
    $fieldArr['gmail']  = (isset($_SESSION['user_email_address'])) ? $_SESSION['user_email_address'] : '';
    $fieldArr['default_email']  = (isset($_SESSION['user_email_address'])) ? $_SESSION['user_email_address'] : '';
    $fieldArr['LOGIN']  = (isset($_SESSION['user_email_address'])) ? $_SESSION['user_email_address'] : '';
    $fieldArr['MOT DE PASSE'] = $password = '123456';
    $fieldArr['NOM'] = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
    $fieldArr['role'] = 'user';
    $sql = 'select * from users where (LOGIN = :LOGIN) or (gmail = :LOGIN) or (default_email = :LOGIN)';
    $stmt = $pdo->prepare($sql);
    $p = ['LOGIN'=>$_SESSION['user_email_address']];
    $stmt->execute($p);
    if($stmt->rowCount() == 0)
    { 
      $aff_id=$crud->create('users', $fieldArr);
      // header('location:pages/affilie.php');
       $email_from = 'cpathak205@gmail.com';
        $email_subject = "Thank you for registration";
        $email_body = "Thank you for registration.".
         "Your email address is: ".$_SESSION['user_email_address'].
        "Your password is:  ".$password." ";

        $to = $_SESSION['user_email_address'];
        $headers = "From: ".$email_from." ";
        mail($to,$email_subject,$email_body,$headers);
        header('location:pages/affilie.php');
       die;
    }else{
      header('location:pages/affilie.php');
      die;
    }
        

  
 echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
  echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
  echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
   echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  echo '<h3><a href="services/logout.php">Logout</a></h3></div>';
  echo  $access_token = $_SESSION['access_token'];
 }
   else
    {
  echo '<div align="center">'.$login_button.'</div>';
 }
   ?> </center>   
     
</body>     
</html>  
 