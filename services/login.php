<?php
session_start();
require_once('../config/db_config.php');
if(isset($_POST['submit']))
{
    if(isset($_POST['user'],$_POST['password']) && !empty($_POST['user']) && !empty($_POST['password']))
    {
        $user = trim($_POST['user']);
        $password = trim($_POST['password']);

        
          echo  $sql = "select * from users where Login = :Login ";
            $handle = $pdo->prepare($sql);
            $params = ['Login'=>$user];
            $handle->execute($params);
            if($handle->rowCount() > 0)
            {

                $getRow = $handle->fetch(PDO::FETCH_ASSOC);                
                unset($getRow['MOT DE PASSE']);
                $_SESSION = $getRow;
                header('location:'.BASE_URL.'pages/affilie.php');
                exit();
               
            }
            else
            {
                header('location:'.BASE_URL.'index.php?msg=error');
                exit();
            }


    }
    else
    {
        header('location:index.php?msg=empty');
        exit();
    }

}
?>
