<?php
session_start();
include_once "db_config.php";

if(isset($_POST["btn_login"])){
    $name = $_POST['name'];
    $password = $_POST['password'];
    $message=[];








    $statement=$db->query("select users.name, users.password, roles.name as role from users, roles where users.name='$name' or users.email='$name' and users.password='$password' and users.role_id=roles.id");
    $data =$statement->fetch_assoc();
    if($data){
       $message= ["login"=>"Welcome {$data['name']}"];
       $_SESSION["name"]=$data['name'];
       $_SESSION["role"]=$data['role'];
       header("location:employeFile.php");
    }else{
       $message= ["login"=>"Incorrect username or password"];
    //    header("location:login.php");
    }
    echo   $message["login"];
}



//  echo md5(12345);
//  echo $Password = password_hash(12345,PASSWORD_BCRYPT);
//  echo password_verify(12345,$hashPassword);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
        body{
            display: flex;
            place-content: center;
            height: 100vh;
        }
    </style>
</head>
<body>
       <div>
         <h1>Login Form</h1>
            <form action="login.php" method="POST">
            <label for="n">Username or Email</label> <br>
            <input type="text" name="name" id="name"> <br> <br>
            <label for="n">Password</label> <br>
            <input type="password" name="password" id="password"><br><br>
            <input type="submit" name="btn_login" value="login">
            </form>
       </div>

</body>
</html>