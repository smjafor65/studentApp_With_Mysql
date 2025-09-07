<?php
define('SERVER', 'localhost');
define('ROOT', 'root');
define('PASS', '');
define('DATABASE', 'batch67');

$db=new mysqli(SERVER,ROOT,PASS,DATABASE);

?>

 <!-- $data=$db->query("select * from users");

 1️⃣ You are trying to update the id column
 $update = $db->query("update  users set id='$this->id', name='$this->name', ... where id=$this->id");


 ❌ Mistake: You should never update the primary key id. MySQL allows it in theory, but it can break the query, especially if $this->id is empty or has spaces.

 ✅ Fix: Remove id='$this->id' from SET:

$update = $db->query("UPDATE users 
    SET name='$this->name',
        email='$this->email',
        password='$this->password',
         contact='$this->contact',
         role_id=$this->role_id
     WHERE id=$this->id");

 2️⃣ $this->id might be empty

 In your form for update:

 <input type="number" name="id" value=" <?php echo $search['id']?> ">

 Extra spaces inside value=" <?php echo $search['id']?> " will make $this->id " 5" instead of 5.
 This will break SQL (WHERE id= 5 → MySQL sees extra spaces).
 ✅ Fix: Remove spaces:
 <input type="hidden" name="id" value="<?php echo isset($search['id']) ? $search['id'] : ''; ?>">

 And in PHP, cast $id to integer:
 $id = (int)$_POST['id']; -->




