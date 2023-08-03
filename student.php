<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$condition='';
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE student SET studentname='".$_POST['studentname']."',rollno='".$_POST['rollno']."',`dateofbirth`='".$_POST['dateofbirth']."',`password`='".$_POST['password']."',`course_id`='".$_POST['studentclass']."',`section`='".$_POST['section']."',status='".$_POST['status']."'  WHERE studentid='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			echo "<script>alert('Student Profile updated successfully...');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO student SET studentname='".$_POST['studentname']."',rollno='".$_POST['rollno']."',`dateofbirth`='".$_POST['dateofbirth']."',`password`='".$_POST['password']."',`course_id`='".$_POST['studentclass']."',`section`='".$_POST['section']."',status='".$_POST['status']."'   ";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			$insid=mysqli_insert_id($con);		
			echo "<script>alert('Student Profile inserted successfully...');</script>";
			echo "<script>window.location='student.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	//Step 2 : Select statement starts here
	$sqledit ="SELECT * FROM student WHERE studentid='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//Step 2 : Select statement ends here
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
          <h3 class="card-title">Student Entry</h3>
        </div>
        <div class="card-body">
		
<div class="row">
	<div class="col-md-3">Full Name</div>
	<div class="col-md-5">
		<input type="text"  class="form-control" name="studentname" id="studentname" value="<?php  if(isset($rsedit['studentname'])){ echo $rsedit['studentname']; } ?>">
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstudentname" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Roll Number</div>
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
<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-5">
		<select class="form-control" name="status" id="status">
		<option value=''>Select status</option>
		<?php
		$arr  = array("Active","Inactive");
		foreach($arr as $val)
		{
		    if($rsedit['status'] == $val)
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
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errstatus" style="color: red;"></span></div>
</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-5">
		<input class="btn btn-primary btn-block"  type="submit" name="submit" id="submit" value="Submit">
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
	if(document.getElementById("section").value == "")
	{
		document.getElementById("errsection").innerHTML="University Name should not be empty";
		i=1;
	}
	if(document.getElementById("studentclass").value == "")
	{
		document.getElementById("errstudentclass").innerHTML="Course should not be empty";
		i=1;
	}
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML="Kindly select the status";
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
