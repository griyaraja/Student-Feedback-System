<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['feedbacktopicid']))
{
	//######
	$sqledit = "SELECT * FROM feedbacktopic where feedbacktopicid ='$_GET[feedbacktopicid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//######
}
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM feedbacktopic where feedbacktopicid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Feedback Topic deleted successfully...');</script>";
		echo "<script>window.location='viewfeedbacktopicadmin.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
if(isset($_GET['feedbackquestionid']))
{
	$sqlquestionedit = "SELECT * FROM  feedbackquestion where feedbackquestionid='$_GET[feedbackquestionid]'";
	$qquestionedit = mysqli_query($con,$sqlquestionedit);
	$rsquestionedit = mysqli_fetch_array($qquestionedit);
	$sql ="DELETE FROM feedbackquestion where feedbackquestionid ='$_GET[feedbackquestionid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Feedback Question deleted successfully...');</script>";
		echo "<script>window.location='feedbacktopicadmin.php?feedbacktopicid=$_GET[feedbacktopicid]';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
if(isset($_GET['st']))
{
	$sql ="UPDATE feedbacktopic SET feedbacktopic_status='$_GET[st]' where feedbacktopicid='$_GET[feedbacktopicid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Feedback Topic Status updated...');</script>";
		echo "<script>window.location='feedbacktopicadmin.php?feedbacktopicid=$_GET[feedbacktopicid]';</script>";
	}
}
if(isset($_POST['submit']))
{
	$feedback_icon = rand() . $_FILES["feedback_icon"]["name"];
	move_uploaded_file($_FILES["feedback_icon"]["tmp_name"],"imgfeedback_icon/".$feedback_icon);	
	$feedback_detail = mysqli_real_escape_string($con,$_POST['feedbacktopic_detail']);
	if(isset($_GET['feedbacktopicid']))
	{
		$sql ="UPDATE feedbacktopic SET feedback_topic='$_POST[feedback_topic]'";
		if($_FILES["feedback_icon"]["name"] !=  "")
		{
		$sql = $sql . ", feedback_icon='$feedback_icon'";
		}
		$sql = $sql . ", feedback_disptype='$_POST[feedback_disptype]', feedbacktopic_detail='$feedback_detail', ,course_id='$_POST[course_id]',faculty_id='$_POST[faculty_id]'";
		$sql = $sql . " WHERE feedbacktopicid='$_GET[feedbacktopicid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Your Feedback Question updated successfully...');</script>";
		}	
	}
	else
	{
		$sql ="INSERT INTO feedbacktopic(feedback_topic, feedbacktopic_date, feedback_icon, feedback_disptype, feedbacktopic_detail, feedbacktopic_status,course_id,faculty_id) values('$_POST[feedback_topic]','$dttim','$feedback_icon','$_POST[feedback_disptype]','$feedback_detail','Approved','$_POST[course_id]','$_POST[faculty_id]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			$feedbacktopicid = mysqli_insert_id($con);
			echo "<script>alert('New Feedback Topic Inserted successfully...');</script>";
			echo "<script>window.location='feedbacktopicadmin.php?feedbacktopicid=$feedbacktopicid';</script>";
		}
	}
}
//Update feedbackquestion
if(isset($_POST['btnupdatequestion']))
{
	$testseries_icon = rand() . $_FILES["edimg"]["name"];
	move_uploaded_file($_FILES["edimg"]["tmp_name"],"imgquestion/".$testseries_icon);
	$question = mysqli_real_escape_string($con,$_POST['edquestion']);
	$option1  = mysqli_real_escape_string($con,$_POST['edoption1']);
	$option2  = mysqli_real_escape_string($con,$_POST['edoption2']);
	$option3  = mysqli_real_escape_string($con,$_POST['edoption3']);
	$option4  = mysqli_real_escape_string($con,$_POST['edoption4']);
	$option5  = mysqli_real_escape_string($con,$_POST['edoption5']);
	$option6  = mysqli_real_escape_string($con,$_POST['edoption6']);
	$option7  = mysqli_real_escape_string($con,$_POST['edoption7']);
	$option8  = mysqli_real_escape_string($con,$_POST['edoption8']);
	$option9  = mysqli_real_escape_string($con,$_POST['edoption9']);
	$option10  = mysqli_real_escape_string($con,$_POST['edoption10']);
	$sql ="UPDATE feedbackquestion SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', option5='$option5', option6='$option6', option7='$option7', option8='$option8', option9='$option9', option10='$option10', question_type='$_POST[edquestion_type]', status='$_POST[edstatus]'";
	if($_FILES["testseries_icon"]["name"] != "")
	{
	$sql = $sql . ",img='$testseries_icon'";
	}
	$sql = $sql . " WHERE feedbackquestionid='$_POST[edfeedbackquestionid]'";
	//echo $sql;
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
$sqlquestionedit = "SELECT * FROM  feedbackquestion LEFT JOIN feedbacktopic ON feedbackquestion.feedbacktopicid=feedbacktopic.feedbacktopicid where feedbackquestion.feedbackquestionid='$_GET[edfeedbackquestionid]'";
$qquestionedit = mysqli_query($con,$sqlquestionedit);
$rsquestionedit = mysqli_fetch_array($qquestionedit);
		echo "<script>alert('Feedback Question  updated successfully...');</script>";
		//echo "<script>window.location='feedbacktopicadmin.php?feedbacktopicid=$_GET[feedbacktopicid]';</script>";
	}
}
//Insert feedbackquestion
if(isset($_POST['submitquestion']))
{
	$sqlquestionedit = "SELECT * FROM  feedbackquestion LEFT JOIN feedbacktopic ON feedbackquestion.feedbacktopicid=feedbacktopic.feedbacktopicid where feedbackquestion.feedbacktopicid='" . $_GET['feedbacktopicid'] . "'";
	$qquestionedit = mysqli_query($con,$sqlquestionedit);
	$rsquestionedit = mysqli_fetch_array($qquestionedit);
	//#############	
	$testseries_icon = rand() . $_FILES['img']['name'];
	move_uploaded_file($_FILES['img']['tmp_name'],"imgquestion/".$testseries_icon);
	$question = mysqli_real_escape_string($con,$_POST['question']);
	$option1 = mysqli_real_escape_string($con,$_POST['option1']);
	$option2 = mysqli_real_escape_string($con,$_POST['option2']);
	$option3 = mysqli_real_escape_string($con,$_POST['option3']);
	$option4 = mysqli_real_escape_string($con,$_POST['option4']);
	$option5 = mysqli_real_escape_string($con,$_POST['option5']);
	$option6 = mysqli_real_escape_string($con,$_POST['option6']);
	$option7 = mysqli_real_escape_string($con,$_POST['option7']);
	$option8 = mysqli_real_escape_string($con,$_POST['option8']);
	$option9 = mysqli_real_escape_string($con,$_POST['option9']);
	$option10 = mysqli_real_escape_string($con,$_POST['option10']);
	$sql ="INSERT INTO feedbackquestion(feedbacktopicid, question, option1, option2, option3, option4,option5, option6, option7,option8, option9, option10, question_type, img, status) values('$_GET[feedbacktopicid]','$question','$option1','$option2','$option3','$option4','$option5','$option6','$option7','$option8','$option9','$option10','$_POST[question_type]','$testseries_icon','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<script>alert('Feedback Question added successfully...');</script>";
		echo "<script>window.location='feedbacktopicadmin.php?feedbacktopicid=$_GET[feedbacktopicid]';</script>";
	}
}
if(isset($_GET['feedbacktopicid']))
{
	//######
	$sqledit = "SELECT * FROM feedbacktopic where feedbacktopicid='$_GET[feedbacktopicid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//######
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
if(isset($_GET['feedbackquestionid']))
{
	$sqlquestionedit = "SELECT * FROM  testseries where feedbackquestionid='$_GET[feedbackquestionid]'";
	$qquestionedit = mysqli_query($con,$sqlquestionedit);
	$rsquestionedit = mysqli_fetch_array($qquestionedit);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

<br>
    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Feedback Topic</h3>
        </div>
        <div class="card-body">
<div class="row">
	<div class="col-md-12">
		Feedback Topic*
		<input type="text"  class="form-control" name="feedback_topic" id="feedback_topic" value="<?php echo $rsedit['feedback_topic']; ?>">
		<span class="errmsg flash" id="errfeedback_topic" style="color: red;"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		Course
		<select  class="form-control" name="course_id" id="course_id">
			<option value="">Select Course</option>
			<?php
			$sql ="SELECT * FROM course where course_status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			while($rs = mysqli_fetch_array($qsql))
			{
				if($rs['course_id'] == $rsedit['course_id'])
				{
				echo "<option value='$rs[course_id]' selected>$rs[course_title]</option>";
				}
				else
				{
				echo "<option value='$rs[course_id]'>$rs[course_title]</option>";
				}
			}
			?>
		</select>
		<span class="errmsg flash" id="errstudentclass" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		Faculty
		<select  class="form-control" name="faculty_id" id="faculty_id">
			<option value="">Select Faculty</option>
			<?php
			$sql ="SELECT * FROM faculty where faculty_status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			while($rs = mysqli_fetch_array($qsql))
			{
				if($rs['faculty_id'] == $rsedit['faculty_id'])
				{
				echo "<option value='" . $rs['faculty_id'] . "' selected>" . $rs['faculty_name'] . " - " . $rs['faculty_designation'] . "</option>";
				}
				else
				{
				echo "<option value='" . $rs['faculty_id'] . "'>" . $rs['faculty_name'] . " - " . $rs['faculty_designation'] . "</option>";
				}
			}
			?>
		</select>
		<span class="errmsg flash" id="errstudentclass" style="color: red;"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		Feedback Topic Description
		<textarea class="form-control" name="feedbacktopic_detail" id="feedbacktopic_detail"><?php echo $rsedit['feedbacktopic_detail']; ?></textarea>
		<span class="errmsg flash" id="errfeedbacktopic_detail" style="color: red;"></span>
	</div>
</div>	<br>	
<div class="row">
	<div class="col-md-6">
		Feedback Icon
		<input type="file"  class="form-control" name="feedback_icon" id="feedback_icon" accept="image/*" >
		<?php
		if(isset($_GET['feedbacktopicid']))
		{
			if(file_exists("imgfeedback_icon/".$rsedit['feedback_icon']))
			{
		?>
		<img src="imgfeedback_icon/<?php echo $rsedit['feedback_icon']; ?>" style="width: 150px;height: 150px;">
		<?php
			}
		}
		?>
	</div>
	<div class="col-md-6">
		Feedback Viewer Type*
		<select name="feedback_disptype" id="feedback_disptype" class="form-control" required>
			<option value="">Select option</option>
			<?php
				$arr = array("Pagination Viewer","One Page Viewer");
				foreach($arr as $val)
				{
					if($val == $rsedit['feedback_disptype'])
					{
					echo "<option value='$val' selected >$val</option>";
					}
					else
					{
					echo "<option value='$val'>$val</option>";
					}
				}
			?>
		</select>
		<span class="errmsg flash" id="errfeedback_disptype" style="color: red;"></span>
	</div>
</div>
<br>	
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
		<?php
		if(isset($_GET['feedbacktopicid']))
		{
		?>
		<div class="col-md-4">
				<input class="form-control"  type="submit" name="submit" id="submit" value="Update Question Paper">
		</div>
		<div class="col-md-8" style="text-align: right;">
				<b><?php echo $rsedit['feedbacktopic_status']; ?></b> | 
				<a href="feedbacktopicadmin.php?feedbacktopicid=<?php echo $_GET['feedbacktopicid']; ?>&st=Approved" class="btn btn-primary">Activate</a>
				<a href="feedbacktopicadmin.php?feedbacktopicid=<?php echo $_GET['feedbacktopicid']; ?>&st=Rejected" class="btn btn-secondary">Deactivate</a>
				<a href="feedbacktopicadmin.php?feedbacktopicid=<?php echo $_GET['feedbacktopicid']; ?>&delid=<?php echo $_GET['feedbacktopicid']; ?>" class="btn btn-danger" onclick="return validatedel()">Delete Feedback</a>
		</div>
		<?php
		}
		else
		{
		?>
		<div class="col-md-12">
			<center><input class="btn btn-info"  type="submit" name="submit" id="submit" value="Post Feedback"></center>
		</div>
		<?php
		}
		?>
</div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->
	
<?php
if(isset($_GET['feedbacktopicid']))
{
?>
    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation1()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add Feedback Questions</h3>
        </div>
        <div class="card-body">
	
<div class="row">
	<div class="col-md-6">
		<b>Question Type*</b>
		<select class="form-control" name="question_type" id="question_type" required>
			<option value=''>Select Question Type</option>
			<?php
			$arr  = array("Radio Button","Check Box","Text Box");
			foreach($arr as $val)
			{
				if($rsquestionedit['question_type'] == $val)
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
		<span class="errmsg flash" id="errquestion_type" style="color: red;"></span>
	</div>
	<div class="col-md-6">
	<b>Image</b>
		<input type="file"  class="form-control" name="img" id="img" accept="image/*" >
<?php
if(isset($_GET['editid']))
{
	if(file_exists("imgquestion/".$rsquestionedit['img']))
	{
?>
<a href="imgquestion/<?php echo $rsquestionedit['img']; ?>" class="btn btn-info" download>Download file</a>
<?php
	}
}
?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<b>Question*</b>
		<textarea class="form-control" name="question" id="question"><?php echo $rsquestionedit['question']; ?></textarea>
		<span class="errmsg flash" id="errquestion" style="color: red;"></span>
	</div>
</div>
<br>
<div id="idhidden">
	<div class="row">
		<div class="col-md-6">
			<b>Option 1*</b>
			<textarea class="form-control" name="option1" id="option1"><?php echo $rsquestionedit['option1']; ?></textarea>
			<span class="errmsg flash" id="erroption1" style="color: red;"></span>
		</div>
		<div class="col-md-6">
			<b>Option 2</b>
			<textarea class="form-control" name="option2" id="option2" ><?php echo $rsquestionedit['option2']; ?></textarea>
			<span class="errmsg flash" id="erroption2" style="color: red;"></span>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Option 3</b>
			<textarea class="form-control" name="option3" id="option3"><?php echo $rsquestionedit['option3']; ?></textarea>
			<span class="errmsg flash" id="erroption3" style="color: red;"></span>
		</div>
		<div class="col-md-6">
			<b>Option 4</b>
			<textarea class="form-control" name="option4" id="option4"><?php echo $rsquestionedit['option4']; ?></textarea>
			<span class="errmsg flash" id="erroption4" style="color: red;"></span>
		</div>
	</div>    
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Option 5</b>
			<textarea class="form-control" name="option5" id="option5"><?php echo $rsquestionedit['option5']; ?></textarea>
			<span class="errmsg flash" id="erroption5" style="color: red;"></span>
		</div>
		<div class="col-md-6">
			<b>Option 6</b>
			<textarea class="form-control" name="option6" id="option6"><?php echo $rsquestionedit['option6']; ?></textarea>
			<span class="errmsg flash" id="erroption6" style="color: red;"></span>
		</div>
	</div>    
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Option 7</b>
			<textarea class="form-control" name="option7" id="option7"><?php echo $rsquestionedit['option7']; ?></textarea>
			<span class="errmsg flash" id="erroption7" style="color: red;"></span>
		</div>
		<div class="col-md-6">
			<b>Option 8</b>
			<textarea class="form-control" name="option8" id="option8"><?php echo $rsquestionedit['option8']; ?></textarea>
			<span class="errmsg flash" id="erroption8" style="color: red;"></span>
		</div>
	</div>    
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Option 9</b>
			<textarea class="form-control" name="option9" id="option9"><?php echo $rsquestionedit['option9']; ?></textarea>
			<span class="errmsg flash" id="erroption9" style="color: red;"></span>
		</div>
		<div class="col-md-6">
			<b>Option 10</b>
			<textarea class="form-control" name="option10" id="option10"><?php echo $rsquestionedit['option10']; ?></textarea>
			<span class="errmsg flash" id="erroption10" style="color: red;"></span>
		</div>
	</div>    
	<br>
</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-5">
		<input class="form-control"  type="submit" name="submitquestion" id="submitquestion" value="Add Question">
	</div>
	<div class="col-md-4"></div>
</div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->
	
	
	
    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation2()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Feedback Questions</h3>
        </div>
        <div class="card-body">
<table id="tblquestionviewer"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Number of Questions : 
			<?php
			$sqlqz ="SELECT * FROM feedbackquestion WHERE feedbacktopicid='$_GET[feedbacktopicid]'";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?>
			</th>
		</tr>
	</thead>
	<tbody>
	
<?php
while($rsqz = mysqli_fetch_array($qsqlqz))
{
?>
	<tr>
		<td>
<input type="hidden" name="edfeedbackquestionid" id="edfeedbackquestionid" value="<?php echo $rsqz['feedbackquestionid']; ?>">
<div class="row">
	<div class="col-md-12">
		<b>Question*</b>
		<textarea class="form-control" name="edquestion" id="edquestion"><?php echo $rsqz['question']; ?></textarea>
		<span class="errmsg flash" id="erredquestion" style="color: red;"></span>
	</div>   
</div>
<br>
<?php
if($rsqz['question_type'] == "Radio Button" || $rsqz['question_type'] == "Check Box")
{
?>
<div class="row">
	<div class="col-md-6">
		<b>Option 1*</b>
		<textarea class="form-control" name="edoption1" id="edoption1" required><?php echo $rsqz['option1']; ?></textarea>
		<span class="errmsg flash" id="erredoption1" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		<b>Option 2</b>
		<textarea class="form-control" name="edoption2" id="edoption2"><?php echo $rsqz['option2']; ?></textarea>
		<span class="errmsg flash" id="erredoption2" style="color: red;"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<b>Option 3</b>
		<textarea class="form-control" name="edoption3" id="edoption3"><?php echo $rsqz['option3']; ?></textarea>
		<span class="errmsg flash" id="erredoption3" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		<b>Option 4</b>
		<textarea class="form-control" name="edoption4" id="edoption4"><?php echo $rsqz['option4']; ?></textarea>
		<span class="errmsg flash" id="erredoption4" style="color: red;"></span>
	</div>
</div>    
<br>

<div class="row">
	<div class="col-md-6">
		<b>Option 5</b>
		<textarea class="form-control" name="edoption5" id="edoption5"><?php echo $rsqz['option5']; ?></textarea>
		<span class="errmsg flash" id="erredoption5" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		<b>Option 6</b>
		<textarea class="form-control" name="edoption6" id="edoption6"><?php echo $rsqz['option6']; ?></textarea>
		<span class="errmsg flash" id="erredoption6" style="color: red;"></span>
	</div>
</div>    
<br>	

<div class="row">
	<div class="col-md-6">
		<b>Option 7</b>
		<textarea class="form-control" name="edoption5" id="edoption5"><?php echo $rsqz['option7']; ?></textarea>
		<span class="errmsg flash" id="erredoption5" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		<b>Option 8</b>
		<textarea class="form-control" name="edoption6" id="edoption6"><?php echo $rsqz['option8']; ?></textarea>
		<span class="errmsg flash" id="erredoption6" style="color: red;"></span>
	</div>
</div>    
<br>	

<div class="row">
	<div class="col-md-6">
		<b>Option 9</b>
		<textarea class="form-control" name="edoption9" id="edoption5"><?php echo $rsqz['option9']; ?></textarea>
		<span class="errmsg flash" id="erredoption9" style="color: red;"></span>
	</div>
	<div class="col-md-6">
		<b>Option 10</b>
		<textarea class="form-control" name="edoption10" id="edoption10"><?php echo $rsqz['option10']; ?></textarea>
		<span class="errmsg flash" id="erredoption10" style="color: red;"></span>
	</div>
</div>    
<br>	
<?php
}
?>
<div class="row">
	<div class="col-md-6">
		<b>Question Type*</b>
		<select class="form-control" name="edquestion_type" id="edquestion_type" required>
			<option value=''>Select Answer</option>
			<?php
			$arr  = array("Radio Button","Check Box","Text Box");
			foreach($arr as $val)
			{
				if($rsqz['question_type'] == $val)
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
		<span class="errmsg flash" id="erredquestion_type" style="color: red;"></span>
	</div>
	<div class="col-md-4">
	<b>Image</b>
		<input type="file"  class="form-control" name="edimg" id="edimg" accept="image/*" >
	</div>
	<div class="col-md-2"><br>
<?php
if(isset($_GET['feedbacktopicid']))
{
	if(file_exists("imgquestion/".$rsqz['img']))
	{
?>
<a href="imgquestion/<?php echo $rsqz['img']; ?>" class="btn btn-info" download>Download file</a>
<?php
	}
}
?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<b>Status*</b>
		<select class="form-control" name="edstatus" id="edstatus">
			<?php
			$arr  = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($rsqz['status'] == $val)
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
		<span class="errmsg flash" id="erredstatus" style="color: red;"></span>
	</div>
	<div class="col-md-6"><br>

	</div>
</div>
<br>

        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<input class="form-control"  type="submit" name="btnupdatequestion" id="submitquestion" value="Click here to update">
	</div>
	<div class="col-md-4" style='text-align: right;'>
		<a class="btn btn-danger" name="img" id="img" style='color: white;' href="feedbacktopicadmin.php?feedbackquestionid=<?php echo $rsqz[0]; ?>&feedbacktopicid=<?php echo $_GET['feedbacktopicid']; ?>"  onclick='return validatedel()' >Delete</a>
	</div>
</div>
        </div>
        <!-- /.card-footer-->
		</td>
	</tr>
<?php
}
?>
	</tbody>
</table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->
<?php
}
?>	
  </div>
  <!-- /.content-wrapper -->
<?php
include("footer.php");
?>


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
<script>
$(document).ready( function () {
    $('#tblquestionviewer').DataTable({
	"pageLength": 1,
	"bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false
});
} );
</script>

<script>
function confirmvalidation()
{
	var i = 0;
	$('.errmsg').html('');
	    
	if(document.getElementById("testseries_topic").value == "")
	{
		document.getElementById("errtestseries_topic").innerHTML="Topic should not be empty...";
		i=1;
	}  
	
	if(document.getElementById("categoryid").value == "")
	{
		document.getElementById("errcategoryid").innerHTML="Kindly select the category...";
		i=1;
	}  
	if(document.getElementById("marksperquestion").value == "")
	{
		document.getElementById("errmarksperquestion").innerHTML="Kindly enter the Corrent answer marks";
		i=1;
	}
	if(document.getElementById("negativemarks").value == "")
	{
		document.getElementById("errnegativemarks").innerHTML="Kindly enter negative mark";
		i=1;
	}
	
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function confirmvalidation1() 
{
	var i = 0;
	$('.errmsg').html('');
	if(document.getElementById("question").value == "")
	{
		document.getElementById("errquestion").innerHTML="Question should not be empty...";
		i=1;
	}  
	if($('#question_type').val() != 'Text Box')
	{
		if(document.getElementById("option1").value == "")
		{
			document.getElementById("erroption1").innerHTML="Kindly enter Option 1...";
			i=1;
		}
		if(document.getElementById("question_type").value != "Text Box")
		{
			if(document.getElementById("option2").value == "")
			{
				document.getElementById("erroption2").innerHTML="Kindly enter Option 2...";
				i=1;
			}
		}
	}
	 /*
	if(document.getElementById("option3").value == "")
	{
		document.getElementById("erroption3").innerHTML="Kindly enter Option 3...";
		i=1;
	}
	if(document.getElementById("option4").value == "")
	{
		document.getElementById("erroption4").innerHTML="Kindly enter Option 4...";
		i=1;
	}
	*/
	if(document.getElementById("question_type").value == "")
	{
		document.getElementById("errquestion_type").innerHTML="Kindly select Question Type...";
		i=1;
	}
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function confirmvalidation2() 
{
	var i = 0;
	$('.errmsg').html('');

	if(document.getElementById("edquestion").value == "")
	{
		document.getElementById("erredquestion").innerHTML="Question should not be empty...";
		i=1;
	}  
	
	if(document.getElementById("edoption1").value == "")
	{
		document.getElementById("erredoption1").innerHTML="Kindly enter Option 1...";
		i=1;
	}  
	 
	if(document.getElementById("edoption2").value == "")
	{
		document.getElementById("erredoption2").innerHTML="Kindly enter Option 2...";
		i=1;
	}
	
	if(document.getElementById("edquestion_type").value != "Text Box")
	{
		if(document.getElementById("edoption2").value == "")
		{
			document.getElementById("erredoption2").innerHTML="Kindly enter Option 2...";
			i=1;
		}
	}
	 /*
	if(document.getElementById("edoption3").value == "")
	{
		document.getElementById("erredoption3").innerHTML="Kindly enter Option 3...";
		i=1;
	}
	if(document.getElementById("edoption4").value == "")
	{
		document.getElementById("erredoption4").innerHTML="Kindly enter Option 4...";
		i=1;
	}
	*/
	if(document.getElementById("edquestion_type").value == "")
	{
		document.getElementById("erredquestion_type").innerHTML="Kindly select answer...";
		i=1;
	}
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function validatedel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
    $('#question_type').change(function(){
        if($('#question_type').val() == 'Text Box') {
			$('#idhidden').hide();
        } else {
            $('#idhidden').show(); 
        } 
    });
</script>
</body>
</html>