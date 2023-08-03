<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE course SET course_title='".$_POST['course_title']."',course_description='".$_POST['course_description']."',course_status='".$_POST['course_status']."' WHERE course_id ='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{			
			echo "<script>alert('Course record Updated successfully...');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO course SET course_title	='".$_POST['course_title']."',course_description='".$_POST['course_description']."',course_status='".$_POST['course_status']."'";		
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			$insid=mysqli_insert_id($con);
			echo "<script>alert('Course record inserted successfully...');</script>";
			echo "<script>window.location='course.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM course where course_id='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
			echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Course detail</h3>
        </div>
        <div class="card-body">
		

<div class="row">
	<div class="col-md-3">Course Title</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="course_title" id="course_title" value="<?php if(isset($rsedit['course_title'])) { echo $rsedit['course_title']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errcourse_title" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Course Description</div>
	<div class="col-md-5">
		<textarea class="form-control" name="course_description" id="course_description" ><?php if(isset($rsedit['course_description'])) { echo $rsedit['course_description']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errcourse_description" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-5">
		<select class="form-control" name="course_status" id="course_status">
		<option value="">Select Status</option>
		<?php
		 $arr  = array("Active","Inactive");
		 foreach($arr as $val)
			{
				if($rsedit['course_status'] == $val)
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
	<div class="col-md-4"><span class="errmsg flash" id="errcourse_status" style="color: red;"></span></div>
</div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-5">
		<input class="btn btn-primary"  type="submit" name="submit" id="submit" value="Submit">
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
	//         
	if(document.getElementById("course_title").value == "")
	{
		document.getElementById("errcourse_title").innerHTML="Course title should not be empty";
		i=1;
	}     
	if(document.getElementById("course_description").value == "")
	{
		document.getElementById("errcourse_description").innerHTML="Course description should not be empty";
		i=1;
	}
	if(document.getElementById("course_status").value == "")
	{
		document.getElementById("errcourse_status").innerHTML="Course status should not be empty";
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