<?php
if(isset($_POST['submit']))
{
    $con=mysqli_connect("localhost","root","","quizickle");
    $admin_username=$_POST['username'];
    $admin_pass=$_POST['password'];

    $query="select * from admin where username='$admin_username' and password='$admin_pass'";
    $res=mysqli_query($con,$query);
    if(mysqli_num_rows($res)>0)
    {
        $userright=1;
        $passright=1;
        header("location:home_admin.php");
    }
    else
    {
        echo "<script>alert('You are not an admin');</script>";
    }

/*  if($userright==0)
    {
        echo "<script>alert('wrong username');</script>";
    }
    else if($passright==0)
    {
        echo"<script>alert('wrong password');</script>";
    }
    else
    {
        echo "<script>alert('welcome!');</script>";
    }

    */
}



?>

