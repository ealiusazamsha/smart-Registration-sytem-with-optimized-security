<form action="form.php" method="POST">
 <input type="text" placeholder="name" name="name">

 <input type="email" placeholder="email" name="email">

 <input type="submit" value="submit" name="submit">

</form>

<?php

echo $name=$_POST['name'];
echo $email=$_POST['email'];




?>