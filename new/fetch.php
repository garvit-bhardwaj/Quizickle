<?php
if(isset($_POST["post_id"]))
{
 $connect = mysqli_connect("localhost", "root", "", "next");
 $output = '';
 $query = "SELECT * FROM questions WHERE qd = '".$_POST["post_id"]."'";
 $result = mysqli_query($connect, $query);
 $query_1 = "SELECT qd FROM questions WHERE qd < '".$_POST['post_id']."' ORDER BY qd DESC LIMIT 1";
 $result_1 = mysqli_query($connect, $query_1);
 $data_1 = mysqli_fetch_assoc($result_1);
 $query_2 = "SELECT qd FROM questions WHERE qd > '".$_POST['post_id']."' ORDER BY qd ASC LIMIT 1";
 $result_2 = mysqli_query($connect, $query_2);
 $data_2 = mysqli_fetch_assoc($result_2);
 $if_previous_disable = '';
 $if_next_disable = '';
 $val1='';
 $val2='';
 $flag=false;
 if(!mysqli_num_rows($result_1))
  {  
   $if_previous_disable = 'disabled';
  // echo "hello";
  }
  else{
     $val1=@$data_1["qd"];
  }
  if(!mysqli_num_rows($result_2))
  {
   $if_next_disable = 'disabled';
  }
  else{
    $val2=@$data_2["qd"];
  }
  $row=mysqli_fetch_assoc($result);

$output.="<p class='que' data-id='".$row['qd']."' id='".$row['cid']."'>".$row['content']."</p><br>";
$query3="SELECT * FROM options WHERE qd = '".$_POST["post_id"]."'";
$result3=mysqli_query($connect,$query3);
$output.="<form id='numbers'>";
$count=0;
while($row = mysqli_fetch_assoc($result3)) {
 // echo $row['option'];
$output.="<input type='radio' id='".$row['oid']."' name='choice' value='".$row['option']."'>".$row['option']."<br>";
// echo $count;
// $count++;
}
 $output.="</form>";
  }
//   echo "hello"
//   echo $if_next_disable;
  $output .= '
  <br /><br />
  <div align="center">
  <button type="button" name="previous" class="btn btn-warning btn-sm previous" id="'.$val1.'" '.$if_previous_disable.'>Previous</button>
  <button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$val2.'" '.$if_next_disable.'>Next</button>
  </div>
  <br /><br />
  ';
 echo $output; 
?>