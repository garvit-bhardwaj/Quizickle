<?php
session_start();
include "dbcon.php";
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION['name']))
{
    header("location:user_login.php");
}
$quizid=$_GET['n'];
$email=$_SESSION['email'];
$endtime="";
$starttime="";
$duration=$_GET['dur'];
$query="select * from quiztime where quizid='$quizid' and email='$email'";
$res= mysqli_query($con,$query);
if(mysqli_num_rows($res)==0)
{
    $starttime=date('Y-m-d H:i:s');
    $endtime= date('Y-m-d H:i:s',strtotime($starttime . '+' . $duration . 'minutes'));
    $insertquery="insert into quiztime (quizid,email,time) values('$quizid','$email','$endtime')";
    $insert=mysqli_query($con,$insertquery);
    
}
else
{
    $selectendtime="select * from quiztime where quizid='$quizid' and email='$email'";
    $res=mysqli_query($con,$selectendtime);
    $row = mysqli_fetch_array($res);
    $endtime=$row['time'];
    $starttime=date('Y-m-d H:i:s');
}
$countdowntime= date('Y/m/d H:i:s',strtotime($endtime));

/*if(date('Y-m-d H:i:s')>$endtime)
{
    header("location:userportal_quizzes.php");
} */


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="insertscore.css" rel="stylesheet">
    <link rel="stylesheet" href="startsquiz.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        p,
label {
    font: 1rem 'Fira Sans', sans-serif;
}

input {
    margin: .4rem;
}

    </style>
        </head>
        <body>
        <script>
var countDownDate= new Date("<?php echo $countdowntime; ?>");
var timer= setInterval(function(){
    var x = new Date();
var distance = countDownDate - x;
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

document.getElementById("timer").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

if(distance < 0) {
  clearInterval(timer);
  //document.write(countDownDate," ",x);
  document.getElementById("timer").innerHTML = "EXPIRED";
  window.location.replace("examsubmitted.php");
}
},1000);
</script>
<div class="option">
<button id="1" class="bt2">Show</button>
</div>
<div id="timer"></div>
<div id="quizarea">
</div>  
        </body>
      <script>
    $(document).ready(function(){
 function fetch(post_id)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{post_id:post_id},
   success:function(data)
   {
    //$('#post_modal').modal('show');
    $('#quizarea').html(data);
   alert(data); 
   }
  });
 }
 $(document).on('click', '#prev', function(){
  var post_id = $(this).attr("data-id");
  fetch (post_id);
 });
 $(document).on('click', '#next', function(){
  var post_id = $(this).attr("data-id");
  fetch(post_id);
 });
 $(document).on('click', '.bt2', function(){
  var post_id = $(this).attr('id');
  fetch(post_id);
 });
 $(document).on('change', '#numbers input', function() {
    var btnId = $('input[name=choice]:checked').attr('id');
    var crct=$('.que').attr('id');
    var post_id=$('.que').attr('data-id');
    alert(post_id);
   // alert(crct);
   alert($('input[name=choice]:checked', '#numbers').attr('id')); 
   $.ajax({
   url:"answer.php",
   method:"POST",
   data:{
    post_id:post_id,
   chosen_id:btnId,
   correct_id:crct
//  
},
   success:function(data)
   {
   }
  });
});
question_navigation();
function question_navigation()
	{
        console.log("hggggg");
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{nav:1,exam_id:1},
			success:function(data)
			{
				$('#question_navigation_area').html(data);
			}
		});
	}

    $(document).on('click', '.navigation', function(){
  var post_id = $(this).attr('id');
  fetch(post_id);
 });
    $("#post").on("contextmenu",function(){
       return false;
    }); 
}); 
</script>
    </html>
