<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div  class="container">
        <div id="post" class="box">
        </div>
        <div class="option">
            <button id="1" class="bt2">Show</button>
        </div>
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
    $('#post').html (data);
  // 0 alert(data); 
   }
  });
 }
 $(document).on('click', '.previous', function(){
  var post_id = $(this).attr("id");
  fetch (post_id);
 });

 $(document).on('click', '.next', function(){
  var post_id = $(this).attr("id");
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
    $('#post').append(data);
   }
  });
});
});
 </script>
</html>