<?php 
session_start();
$username= $_SESSION["adminlogin"];
include "dbcon.php";
$sql="SELECT * FROM admin where username='$username'";
$res=mysqli_query($con,$sql);
if (!$res) {
  printf("Error: %s\n", mysqli_error($con));
  exit();
}

$row = mysqli_fetch_array($res);


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard | Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="adminportal.css">
    <script src="https://kit.fontawesome.com/d717612254.js" crossorigin="anonymous"></script>

  </head>

  <body>
    <?php require "adminportal.php" ?>
    <p class="need">Need to change your password? Do it here!<p>
      <div class="reset"><a id="decor"  href="<?php echo "admin_changepassword.php?id=".$row["id"];?>"><p class="change">Change Password</p></a></div>
     </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
