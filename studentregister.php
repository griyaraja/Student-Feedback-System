<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
error_reporting(0);
date_default_timezone_set("Asia/Calcutta");
$dttim = date("Y-m-d H:i:s");
$dt = date("Y-m-d");
if(isset($_SESSION['adminid']))
{
 echo "<script>window.location='admindashboard.php';</script>";
}
if(isset($_SESSION['studentid']))
{
 echo "<script>window.location='studentdashboard.php';</script>";
}
include("database.php");
//  
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE student SET studentname='".$_POST['studentname']."',rollno='".$_POST['rollno']."',dateofbirth='".$_POST['dateofbirth']."',password='".$_POST['password']."',course_id='".$_POST['studentclass']."',section='".$_POST['section']."',status='".$_POST['status']."' WHERE studentid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{			
			echo "<script>alert('Student updated successfully...');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO student SET studentname='".$_POST['studentname']."',rollno='".$_POST['rollno']."',dateofbirth='".$_POST['dateofbirth']."',password='".$_POST['password']."',course_id='".$_POST['studentclass']."',section='".$_POST['section']."',status='Pending'  ";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
//#####REGISTRATION MAIL STARTS HERE
$message = "Welcome $_POST[studentname],<br>
You have registered successfully to Student Feedback System. Our staff will verify your account and send Activation notification when it is done...<br>Thank you...";
include("phpmailer.php");
sendmail($_POST['rollno'], $_POST['studentname'] , "Student Feedback System Registration Notification..", $message);
//#####REGISTRATION MAIL ENDS HERE		
			echo "<script>alert('Your registration request sent successfully...');</script>";
			echo "<script>window.location='index.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	//Step 2 : Select statement starts here
	$sqledit ="SELECT * FROM student WHERE studentid='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//Step 2 : Select statement ends here
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Feedback - Student Login Window</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('images/iStock-872232248-1.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;width: 100%;">
<div class="row">
		<div class="col-md-12">
		
<div class="login-box" style="width: 700px;">
  <!-- /.login-logo -->
<br>			<div class="col-md-12">
		  <!-- /.login-logo -->
		  <div class="card">
			<div class="card-body login-card-body"  onclick="window.location='index.php'" style="cursor: pointer;">
			  <center><h2><b>Student Feedback System</b></h2></center>
			</div>
			<!-- /.login-card-body -->
		  </div>
			
			</div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>STUDENT REGISTRATION PANEL</b></p>
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-3">Full Name</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="studentname" id="studentname" value="<?php  if(isset($rsedit['studentname'])){ echo $rsedit['studentname']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentname" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Roll No.</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="rollno" id="rollno" value="<?php if(isset($rsedit['rollno'])){ echo $rsedit['rollno']; } ?>">
		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errrollno" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">Password</div>
	<div class="col-md-5">
		<input type="password"  class="form-control" name="password" id="password" value="<?php if(isset($rsedit['password'])){ echo $rsedit['password']; } ?>">
		
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Confirm Password</div>
	<div class="col-md-5">
		<input type="password"  class="form-control" name="confirmpassword" id="confirmpassword" value="<?php if(isset($rsedit['password'])){ echo $rsedit['password']; } ?>">
	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errconfirmpassword" style="color: red;"></span></div>
</div>
<br>	
<div class="row">
	<div class="col-md-3">Date of Birth</div>
	<div class="col-md-5">
	<input type="date"  class="form-control" name="dateofbirth" id="dateofbirth" value="<?php if(isset($rsedit['dateofbirth'])){ echo $rsedit['dateofbirth']; } ?>" >
	
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errdateofbirth" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Course</div>
	<div class="col-md-5">
		<select  class="form-control" name="studentclass" id="studentclass">
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
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentclass" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Section</div>
	<div class="col-md-5">
	<input type="text"  class="form-control" name="section" id="section" value="<?php if(isset($rsedit['section'])){ echo $rsedit['section']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errsection" style="color: red;"></span></div>
</div>
<br>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

      <!-- /.social-auth-links -->
      <div class="social-auth-links text-center mb-3">
		<input type="submit" class="btn btn-primary" name="submit" id="submit"
        value=" Click Here to Register " >
      </div>
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

      </form>

	
	</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
function confirmvalidation()
{
	var i = 0;
	$('.errmsg').html('');
	if(document.getElementById("studentname").value == "")
	{
		document.getElementById("errstudentname").innerHTML="Original Name should not be empty";
		i=1;
	}
	if(document.getElementById("rollno").value == "")
	{
		document.getElementById("errrollno").innerHTML="Email ID should not be empty";
		i=1;
	}	
	if(document.getElementById("password").value.length < 6)
	{
		document.getElementById("errpassword").innerHTML="Password should contain more than 6 characters";
		i=1;
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password code should not be empty";
		i=1;
	}
	if(document.getElementById("confirmpassword").value != document.getElementById("password").value)
	{
		document.getElementById("errconfirmpassword").innerHTML="Password and Confirm password not matching";
		i=1;
	}
	if(document.getElementById("confirmpassword").value == "")
	{
		document.getElementById("errconfirmpassword").innerHTML="Confirm Password  should not be empty";
		i=1;
	}
	if(document.getElementById("dateofbirth").value == "")
	{
		document.getElementById("errdateofbirth").innerHTML="Date of Birth should not be empty";
		i=1;
	}    
	if(document.getElementById("section").value == "")
	{
		document.getElementById("errsection").innerHTML="University Name should not be empty";
		i=1;
	}
	if(document.getElementById("studentclass").value == "")
	{
		document.getElementById("errstudentclass").innerHTML="Qualification  should not be empty";
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
</body>
</html>
