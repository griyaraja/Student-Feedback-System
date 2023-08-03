<?php
include("header.php");
include("sidebar.php");
if(!isset($_SESSION['date']))
{
	$_SESSION['feedbacktopicid'] = $_GET['feedbacktopicid'];
	$_SESSION['date'] = date("Y-m-d H:i:s");
	$sql_feedbackquestion_result ="INSERT INTO feedbackquestion_result (feedbacktopicid,studentid,date,feedbackquestionid,selectedanswer) SELECT '$_GET[feedbacktopicid]', '$_SESSION[studentid]', '$_SESSION[date]', feedbackquestionid, '' FROM feedbackquestion WHERE feedbacktopicid='$_GET[feedbacktopicid]'";
	$qsl = mysqli_query($con,$sql_feedbackquestion_result);
	echo "<script>window.location='feedbackpanel.php?feedbacktopicid=$_GET[feedbacktopicid]';</script>";
}
if(isset($_SESSION['feedbacktopicid']))
{
	$sqledit = "SELECT * FROM feedbacktopic where feedbacktopicid='$_SESSION[feedbacktopicid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//######
	$sqlstudent = "SELECT * FROM student WHERE studentid='$rsedit[studentid]'";
	$qsqlstudent = mysqli_query($con,$sqlstudent);
	$rsstudent = mysqli_fetch_array($qsqlstudent);
	//######
	//######
	$sqladmin = "SELECT * FROM admin WHERE adminid='$rsedit[adminid]'";
	$qsqladmin = mysqli_query($con,$sqladmin);
	$rsadmin = mysqli_fetch_array($qsqladmin);
	//######
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

<br>
<?php
{
?>
	
    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation2()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Feedback Panel </h3>
        </div>
        <div class="card-body">
		
<table id="tblquestionviewer"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th></th>
			<th>
			<centeR>
			<?php echo $rsedit['feedback_topic']; ?>
			</center>
			</th>
		</tr>
		<tr>
		
			<th></th>
			<th>
			<centeR>
			Number of Questions : 
			<?php
			$sqlqz ="SELECT * FROM feedbackquestion WHERE feedbacktopicid='$_SESSION[feedbacktopicid]'";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?>
			| 
			Answered Questions : 
			<span id="idansweredquestions"><?php
			$sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_SESSION[feedbacktopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer != ''";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?></span>
			|
			Unanswered Questions : 
			<span id="idunansweredquestions"><?php
			$sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_SESSION[feedbacktopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer=''";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?></span>
			</center>
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$qno=1;
$sqlqz ="SELECT feedbackquestion_result.*, feedbackquestion.question,feedbackquestion.option1,feedbackquestion.option2,feedbackquestion.option3,feedbackquestion.option4,feedbackquestion.option5,feedbackquestion.option6,feedbackquestion.option7,feedbackquestion.option8,feedbackquestion.option9,feedbackquestion.option10,feedbackquestion.question_type,feedbackquestion.img FROM `feedbackquestion_result` LEFT JOIN feedbackquestion ON feedbackquestion_result.feedbackquestionid=feedbackquestion.feedbackquestionid WHERE feedbackquestion_result.feedbacktopicid='$_SESSION[feedbacktopicid]' AND feedbackquestion_result.studentid='$_SESSION[studentid]' AND feedbackquestion_result.date='$_SESSION[date]' ORDER BY feedbackquestion_result.feedbackquestion_resultid ASC";
$qsqlqz  = mysqli_query($con,$sqlqz);
while($rsqz = mysqli_fetch_array($qsqlqz))
{
?>
	<tr>
		<td><?php echo $qno; ?></td>
		<td>
		
<input type="hidden" name="edfeedbackquestionid" id="edfeedbackquestionid" value="<?php echo $rsqz[0]; ?>">
		
		<table style='width: 100%;'>
			<tr>
				<td>
				
				<b>Question No.  <?php echo $qno; ?> :- </b><br><b style="color: blue;"><?php echo $rsqz['question']; ?></b>		
				</td>
			</tr>			

<?php
if(file_exists("imgquestion/".$rsqz['img']))
	{
?>
			<tr>
				<td>
<img src="imgquestion/<?php echo $rsqz['img']; ?>" style='height: 200px;'>
				</td>
			</tr>
<?php
	}
if($rsqz['question_type'] == 'Radio Button' )
{
	if($rsqz['option1'] != "") 
	{
	?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>1">Option 1:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>1" value="<?php echo $rsqz['option1']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>1"><?php echo $rsqz['option1']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option2'] != "") 
	{
	?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>2">Option 2:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>2" value="<?php echo $rsqz['option2']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>2"><?php echo $rsqz['option2']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option3'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>3">Option 3:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>3" value="<?php echo $rsqz['option3']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>3"><?php echo $rsqz['option3']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option4'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>4">Option 4:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>4" value="<?php echo $rsqz['option4']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>4"><?php echo $rsqz['option4']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option5'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>5">Option 5:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>5" value="<?php echo $rsqz['option5']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>5"><?php echo $rsqz['option5']; ?></label>
					</td>
				</tr>	
	<?php
	}
	if($rsqz['option6'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>6">Option 6:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>6" value="<?php echo $rsqz['option6']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>6"><?php echo $rsqz['option6']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option7'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>7">Option 7:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>7" value="<?php echo $rsqz['option7']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>7"><?php echo $rsqz['option7']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option8'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>8">Option 8:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>8" value="<?php echo $rsqz['option8']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>8"><?php echo $rsqz['option8']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option9'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>9">Option 9:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>9" value="<?php echo $rsqz['option9']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>9"><?php echo $rsqz['option9']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option10'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>10">Option 10:</b><input type="radio" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>10" value="<?php echo $rsqz['option10']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>10"><?php echo $rsqz['option10']; ?></label>
					</td>
				</tr>
	<?php
	}
}
if($rsqz['question_type'] == 'Check Box' )
{
	if($rsqz['option1'] != "") 
	{
	?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>1">Option 1:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>1" value="<?php echo $rsqz['option1']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>1"><?php echo $rsqz['option1']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option2'] != "") 
	{
	?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>2">Option 2:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>2" value="<?php echo $rsqz['option2']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>2"><?php echo $rsqz['option2']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option3'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>3">Option 3:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>3" value="<?php echo $rsqz['option3']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>3"><?php echo $rsqz['option3']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option4'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>4">Option 4:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>4" value="<?php echo $rsqz['option4']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>4"><?php echo $rsqz['option4']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option5'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>5">Option 5:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>5" value="<?php echo $rsqz['option5']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>5"><?php echo $rsqz['option5']; ?></label>
					</td>
				</tr>	
	<?php
	}
	if($rsqz['option6'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>6">Option 6:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>6" value="<?php echo $rsqz['option6']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>6"><?php echo $rsqz['option6']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option7'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>7">Option 7:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>7" value="<?php echo $rsqz['option7']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>7"><?php echo $rsqz['option7']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option8'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>8">Option 8:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>8" value="<?php echo $rsqz['option8']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>8"><?php echo $rsqz['option8']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option9'] != "") 
	{
	?>
				
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>9">Option 9:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>9" value="<?php echo $rsqz['option9']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>9"><?php echo $rsqz['option9']; ?></label>
					</td>
				</tr>
	<?php
	}
	if($rsqz['option10'] != "") 
	{
	?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>10">Option 10:</b><input type="checkbox" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>10" value="<?php echo $rsqz['option10']; ?>" style="display: inline-block; border: 1px solid #000;border-radius: 50%;margin: 0 0.5em;width: 30px;height: 15px;" onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" >
						 <label for="option<?php echo $rsqz[0]; ?>10"><?php echo $rsqz['option10']; ?></label>
					</td>
				</tr>
	<?php
	}
}
if($rsqz['question_type'] == 'Text Box' )
{
?>
				<tr>
					<td>
						<b style='color: red;' for="option<?php echo $rsqz[0]; ?>10">Kindly enter your Answer here</b><textarea class="form-control" name="option<?php echo $rsqz[0]; ?>" id="option<?php echo $rsqz[0]; ?>10"   onclick="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')" onchange="updanswer('<?php echo $rsqz[0]; ?>',this.value,'<?php echo $rsqz['question_type']; ?>')"></textarea>
					</td>
				</tr>
<?php
}
?>
			
		</table>


		</td>
	</tr>
<?php
$qno =$qno + 1;
}
?>
	</tbody>
</table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
	
	    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
<center><input type="button" name="submit" id="submit" value="Click Here to End" class="btn btn-info" onclick="confirmtocomplete('<?php echo $_SESSION['feedbacktopicid']; ?>','<?php echo $_SESSION['studentid']; ?>')" ></center>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
<?php
}
?>	
  </div>
  <!-- /.content-wrapper -->
<?php
include("footer.php");
?>
<div id="idansstatus"><?php $sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_SESSION[feedbacktopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer != ''";
$qsqlqz  = mysqli_query($con,$sqlqz); ?><input type="hidden" name="answereedq" id="answereedq" value="<?php echo mysqli_num_rows($qsqlqz); ?>" ><?php $sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_SESSION[feedbacktopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer=''";
$qsqlqz  = mysqli_query($con,$sqlqz); ?><input type="hidden" name="unanswereedq" id="unanswereedq" value="<?php echo mysqli_num_rows($qsqlqz); ?>" ></div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="dist/js/pages/dashboard3.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<?php
if($rsedit['feedback_disptype'] == "Pagination Viewer" )
{
?>
<script>
$(document).ready( function () {
    $('#tblquestionviewer').DataTable({
	"columnDefs": [
		{
			"targets": [ 0 ],
			"visible": false,
			"searchable": false
		}
	],
    "aaSorting": [[0, 'asc']],
	"pageLength": 1,
	"bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "bAutoWidth": false,
});
} );
</script>
<?php
}
else
{
?>
<script>
$(document).ready( function () {
    $('#tblquestionviewer').DataTable({
	"columnDefs": [
		{
			"targets": [ 0 ],
			"visible": false,
			"searchable": false
		}
	],
    "aaSorting": [[0, 'asc']],
	"pageLength": 50,
	"bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "bAutoWidth": false,
});
} );
</script>
<?php
}
?>
<script>
function updanswer(feedbackquestion_resultid,answer,question_type)
{
	var answers ="";
	if(question_type == "Radio Button")
	{
		answers = answer;
	}
	if(question_type == "Check Box")
	{
		$("input[name='option" + feedbackquestion_resultid + "']:checked").each(function() {
			answers = answers + " " + this.value + ",";
		});
		answers = answers.replace(/.$/,".");
	}	
	if(question_type == "Text Box")
	{
		answers = answer;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("idansstatus").innerHTML = this.responseText;
			document.getElementById("idansweredquestions").innerHTML = document.getElementById("answereedq").value;
			document.getElementById("idunansweredquestions").innerHTML = document.getElementById("unanswereedq").value;
		}
	};
	xmlhttp.open("GET", "ajaxfeedbackquestionanswer.php?feedbackquestion_resultid=" + feedbackquestion_resultid + "&answer=" + answers, true);
	xmlhttp.send();
}
function confirmtocomplete(feedbacktopicid,studentid) 
{
	if(document.getElementById("unanswereedq").value == 0)
	{
		if(confirm("Are you sure?") == true)
		{
			window.location="feedbackquestion_success.php?feedbacktopicid="+feedbacktopicid+"&studentid="+studentid;
		}
	}
	if(document.getElementById("unanswereedq").value != 0)
	{
		if(confirm("All Questions not answered yet.. Are you sure want to close feedbackquestion panel?") == true)
		{
			window.location="feedbackquestion_success.php?feedbacktopicid="+feedbacktopicid+"&studentid="+studentid;
		}
	}
}
</script>
</body>
</html>