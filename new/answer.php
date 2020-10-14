<?php

if(isset($_POST["post_id"]))
{
   echo $_POST["post_id"];
$connect = mysqli_connect("localhost", "root", "", "next");
$query1="SELECT * FROM answer WHERE `user_id`=1";
$result=mysqli_query($connect,$query1);
if(mysqli_num_rows($result))
{
   // echo "success";
}
else{
   echo mysqli_error($connect);
}
$row=mysqli_fetch_array($result);
// foreach($row as $item)
// {
//     echo $item;
// }
$score=$row['score'];
echo $score;
echo $_POST['chosen_id'];
if($_POST['chosen_id']==$_POST['correct_id'])
{
    $calcualted=$score+1;
}
else{
    $calcualted=$score-1;
}
$query="UPDATE answer SET `score`=$calcualted WHERE `user_id`=1";
mysqli_query($connect,$query);
}

?>