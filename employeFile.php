<?php



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






?>











<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Center page content */
        body {
            font-family: Arial, sans-serif;
            background: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Tiny container */
        div {
            width: 220px;
            /* much smaller width */
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-align: center;
        }

        /* Heading */
        h1 {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        /* Form */
        form {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        label {
            font-size: 0.8rem;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            padding: 3px;
            width: 100%;
            font-size: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Submit button */
        input[type="submit"] {
            margin-top: 6px;
            padding: 4px;
            width: 100%;
            font-size: 0.8rem;
            background: #007acc;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #005f99;
        }

        /* Super compact table */
        table {
            width: 50%;
            /* fits the small container */
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 0.7rem;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px 10px;
            /* very small padding */
            text-align: left;
        }

        th {
            background: #eee;
        }

        tr {
            height: 18px;
            /* smaller row height */
        }
    </style>
</head>

<body>
    <?php
    echo  User::getAll();
    
    ?>

    <div>
        <h1>Data Table</h1>
        <form action="" method="post">
            <label for="n">Name
                <input type="text" name="name">
            </label><br>
            <label for="m">Mail
                <input type="text" name="email">
            </label><br>
            <label for="p">Password
                <input type="text" name="password">
            </label><br>
            <label for="c">Contact
                <input type="text" name="contact">
            </label><br>
            <label for="e">Employe Name:
                <input type="text" name="employe">
            </label>
            <input type="submit" name="submit">
        </form>
    </div>


    <div>
        <h1>Update Table</h1>
        <form action="" method="post">
            <label for="id">ID:
               <input type="hidden" name="id" value="<?php echo isset($search['id']) ? $search['id'] : ''; ?>">

            </label>
            <label for="n">Name
                <input type="text" name="name" value=" <?php echo $search['name']?>">
            </label><br>
            <label for="m">Mail
                <input type="text" name="email" value=" <?php echo $search['email']?>">
            </label><br>
            <label for="p">Password
                <input type="text" name="password" value=" <?php echo $search['password']?>">
            </label><br>
            <label for="c">Contact
                <input type="text" name="contact" value=" <?php echo $search['contact']?>">
            </label><br>
            <label for="e">Employe Name:
                <input type="text" name="employe" value=" <?php echo $search['role_id']?>">
            </label>
            <input type="submit" name="update_btn" value="UPDATE">
        </form>
    </div>
</body>

</html>