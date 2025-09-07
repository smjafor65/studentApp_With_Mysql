<?php

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
   
}



include_once("user.class.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $role_id = $_POST['employe'];

    $user = new User("", $name, $email, $password, $contact, $role_id);

    $save = $user->save();
    if ($save) {
        echo $save;

        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['password']);
        unset($_POST['contact']);
        unset($_POST['employe']);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    User::delete($id);
}

if (isset($_POST['update_btn'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $role_id = $_POST['employe'];

    $user = new User($id, $name, $email, $password, $contact, $role_id);

    $update = $user->update();
    if ($update) {
        echo $update;

        unset($_POST['id']);
        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['password']);
        unset($_POST['contact']);
        unset($_POST['employe']);
    }

    
}
    $search=null;
if(isset($_GET['EditId'])){
    $id=$_GET['EditId'];
    $search=User::find($id);
}

if (isset($_GET['logout'])) {
    $logout=$_GET['logout'];
    if($logout){
        session_unset();
        session_destroy();
        header("location:login.php");
    }
}



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
            gap: 20px;
        }
        table,th,td{
            border-collapse: collapse;
            border: 1px solid black;
            padding: 10px;
        }

        tr:nth-child(even){
           background-color: lightgrey;
        }
     </style>
   
</head>

<body>
         <h1>Welcome <?php echo $_SESSION["role"] ??  "User" ; ?></h1>


    <?php
    echo  User::getAll();
    
    ?>

    <div style="max-width:400px; margin:20px auto; padding:25px; background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); font-family:Arial,sans-serif;">
    <h1 style="text-align:center; margin-bottom:20px; color:#444; font-size:22px;">Data Table</h1>
    <form action="" method="post">
        <label for="n" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Name
            <input type="text" name="name" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px; box-sizing:border-box;">
        </label>
        <label for="m" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Mail
            <input type="text" name="email" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>
        <label for="p" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Password
            <input type="text" name="password" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>
        <label for="c" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Contact
            <input type="text" name="contact" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>
        <label for="e" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Employe Name:
            <input type="text" name="employe" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>
        <input type="submit" name="submit" value="Submit" style="width:100%; background:#4CAF50; color:white; padding:12px; font-size:15px; border:none; border-radius:8px; cursor:pointer;">
    </form>
</div>



   <div style="max-width:400px; margin:20px auto; padding:25px; background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); font-family:Arial,sans-serif;">
    <h1 style="text-align:center; margin-bottom:20px; color:#444; font-size:22px;">Update Table</h1>
    <form action="" method="post">
        <label for="id" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            ID:
            <input type="hidden" name="id" value="<?php echo isset($search['id']) ? $search['id'] : ''; ?>">
        </label>

        <label for="n" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Name
            <input type="text" name="name" value="<?php echo $search['name'] ?? ''; ?>" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>

        <label for="m" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Mail
            <input type="text" name="email" value="<?php echo $search['email'] ?? ''; ?>" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>

        <label for="p" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Password
            <input type="text" name="password" value="<?php echo $search['password'] ?? ''; ?>" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>

        <label for="c" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Contact
            <input type="text" name="contact" value="<?php echo $search['contact'] ?? ''; ?>" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>

        <label for="e" style="display:block; margin-bottom:15px; font-weight:600; color:#555;">
            Employe Name:
            <input type="text" name="employe" value="<?php echo $search['role_id'] ?? ''; ?>" style="width:100%; padding:10px 12px; margin-top:5px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
        </label>

        <input type="submit" name="update_btn" value="UPDATE" style="width:100%; background:#4CAF50; color:white; padding:12px; font-size:15px; border:none; border-radius:8px; cursor:pointer;">
    </form>
</div>


<a href="employeFile.php?logout=1" 
   style="padding: 10px ;
        " >
   Logout
</a>
</body>

</html>