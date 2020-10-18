<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "quizickle");
if(isset($_POST["post_id"]))
{
 $output = '';
 $query = "SELECT * FROM questable WHERE qd = '".$_POST["post_id"]."'";
 $result = mysqli_query($connect, $query);
 $query_1 = "SELECT qd FROM questable WHERE qd < '".$_POST['post_id']."' ORDER BY qd DESC LIMIT 1";
 $result_1 = mysqli_query($connect, $query_1);
 $data_1 = mysqli_fetch_assoc($result_1);
 $query_2 = "SELECT qd FROM questable WHERE qd > '".$_POST['post_id']."' ORDER BY qd ASC LIMIT 1";
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
  $output.=$row["qid"];
  $query4 = "SELECT * FROM answer WHERE `qid` = '".$row["qid"]."'";
  $result5=mysqli_query($connect,$query4);
  $row2=mysqli_fetch_assoc($result5);

$output.="<p class='que' data-id='".$row['qd']."' id='".$row2['ansid']."'>".$row['qns']."</p><br>";
$query3="SELECT * FROM options WHERE `qid`= '".$row["qid"]."'";
$result3=mysqli_query($connect,$query3);
$output.="<form id='numbers'>";
$count=0;
while($row = mysqli_fetch_assoc($result3)) {
 // echo $row['option'];
$output.="<input type='radio'  class='data' id='".$row['optionid']."' name='choice' value='".$row['option']."'>".$row['option']."<br>";
// echo $count;
// $count++;
}
 $output.="</form>";
//   echo "hello"
//   echo $if_next_disable;
  $output .= '
  <br /><br />
  <div align="center">
  <button type="button" name="previous" class="btn" id="prev" data-id="'.$val1.'" '.$if_previous_disable.'>Previous</button>
  <button type="button" name="next" class="btn" id="next" data-id="'.$val2.'" '.$if_next_disable.'>Next</button>
  </div>
  <br /><br />
  ';
 echo $output; 
}
if(isset($_POST["nav"]))
{
  $output="";
  $count=1;
  $query="SELECT * FROM questions WHERE `exam_id`=1";
  if ($result = mysqli_query($connect, $query)) {

    /* fetch associative array */
    while($row = mysqli_fetch_assoc($result)) {
				$output .= '
				<div class="col-md-2" style="margin-bottom:24px;">
					<button type="button" class="navigation" id="'.$row["qd"].'">'.$count.'</button>
				</div>
				';
				$count++;
			}
    }

    /* free result set */
    // mysqli_free_result($result);
else {
 echo "failed"; 
}
        echo $output;
  }
?>