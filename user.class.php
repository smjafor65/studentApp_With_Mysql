<?php

include_once "db_config.php";

class User
{

    public $id;
    public $name;
    public $email;
    public $password;
    public $contact;
    public $role_id;

    public function __construct($id, $name, $email, $password, $contact, $role_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->contact = $contact;
        $this->role_id = $role_id;
    }

    public  function save()
    {
        global $db;

        $save = $db->query("insert into users (name, email, password,contact,role_id)values
        ('$this->name','$this->email','$this->password','$this->contact','$this->role_id')");

        if ($save) {
            return "Data saved successfully.";
        }
    }

    public static function getAll()
    {
        global $db;
        $data = $db->query("select * from users");
        $html = "<table>";
        $html .= "<tr><th>ID</th><th>NAME</th><th>EMAIL</th><th>CONTACT</th><th>ROLE</th><th>ACTION</th> </tr>";

        while ($row = $data->fetch_object()) {
            $html .= "<tr><td>{$row->id}</td><td>{$row->name}</td><td>{$row->email}</td><td>{$row->contact}</td><td>{$row->role_id}</td> <td>  <button> <a href='employeFile.php?EditId={$row->id}'>Edit</a></button>  <button> <a href='employeFile.php?id={$row->id}'>Delete</a></button> </td></tr>";
        }

        $html .= "</table>";
        return $html;
    }

    public static function delete($id)
    {
        global $db;
        //  try and catch for searching debug
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $delete = $db->query("delete from users where id=$id");
            if ($delete) {
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        global $db;

         if (empty($this->id)) {
        return false;}

        $update = $db->query("update  users set  name='$this->name',email='$this->email',password='$this->password',contact='$this->contact',role_id=$this->role_id where id=$this->id");

        if ($update) {
            return true;
        }
    }

    public static function find($id)
    {
        global $db;
        $data = $db->query("select * from users where id=$id");

        $datum = $data->fetch_assoc();
        if (count($datum)) {
            return $datum;
        }
        return "Data not Found";
    }
}

?>

<!-- <table>
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>CONTACT</th>
        <th  >ROLE</th>
    </tr>
</table>

<img src="$this->img" alt="flower"> -->