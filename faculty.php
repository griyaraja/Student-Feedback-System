<?php
include("header.php");
include("sidebar.php");
if(isset($_POST['submit']))
{
	$imgfaculty = rand() . $_FILES["faculty_img"]["name"];
	move_uploaded_file($_FILES["faculty_img"]["tmp_name"],"imgfaculty/".$imgfaculty);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE `faculty` SET `faculty_name`='".$_POST['faculty_name']."',`faculty_designation`='".$_POST['faculty_designation']."'";
		if($_FILES["faculty_img"]["name"] != "")
		{
		$sql = $sql . ",`faculty_img`='$imgfaculty'";
		}
		$sql = $sql . ",`faculty_profile`='".$_POST['faculty_profile']."',`faculty_status`='".$_POST['faculty_status']."' WHERE faculty_id='".$_GET['editid']."'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{			
			echo "<script>alert('Faculty record Updated successfully...');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO faculty SET `faculty_name`='".$_POST['faculty_name']."',`faculty_designation`='".$_POST['faculty_designation']."'";
		if($_FILES["faculty_img"]["name"] != "")
		{
		$sql = $sql . ",`faculty_img`='$imgfaculty' ";
		}
		$sql = $sql . ",`faculty_profile`='".$_POST['faculty_profile']."',`faculty_status`='".$_POST['faculty_status']."'";		
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1)
		{
			$insid=mysqli_insert_id($con);
			echo "<script>alert('Faculty record inserted successfully...');</script>";
			echo "<script>window.location='faculty.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM faculty where faculty_id='".$_GET['editid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
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
          <h3 class="card-title">Faculty Entry</h3>
        </div>
        <div class="card-body">
		

<div class="row">
	<div class="col-md-3">Faculty Name</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="faculty_name" id="faculty_name" value="<?php if(isset($rsedit['faculty_name'])) { echo $rsedit['faculty_name']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfaculty_name" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Designation</div>
	<div class="col-md-5">
		<input type="text" class="form-control" name="faculty_designation" id="faculty_designation" value="<?php if(isset($rsedit['faculty_designation'])) { echo $rsedit['faculty_designation']; } ?>"  />
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfaculty_designation" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Faculty Image</div>
	<div class="col-md-5">
		<input type="file" class="form-control" name="faculty_img" id="faculty_img" value="<?php if(isset($rsedit['faculty_img'])) { echo $rsedit['faculty_img']; } ?>"  />
		<?php
		if(file_exists("imgfaculty/".$rsedit['faculty_img']))
		{
			$imgname = "imgfaculty/".$rsedit['faculty_img'];
		}
		else
		{
			$imgname = "images/defaultimg.png";
		}
		?>
		<img src='<?php echo $imgname; ?>' style='width: 100px;height: 100px;'>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfaculty_img" style="color: red;"></span></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">Faculty Profile</div>
	<div class="col-md-5">
		<textarea class="form-control" name="faculty_profile" id="faculty_profile" ><?php if(isset($rsedit['faculty_profile'])) { echo $rsedit['faculty_profile']; } ?></textarea>
	</div>
	<div class="col-md-4"><span class="errmsg flash" id="errfaculty_profile" style="color: red;"></span></div>
</div>
<br>

<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-5">
		<select class="form-control" name="faculty_status" id="faculty_status">
		<option value="">Select Status</option>
		<?php
		 $arr  = array("Active","Inactive");
		 foreach($arr as $val)
			{
				if($rsedit['faculty_status'] == $val)
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
	<div class="col-md-4"><span class="errmsg flash" id="errfaculty_status" style="color: red;"></span></div>
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
	if(document.getElementById("faculty_name").value == "")
	{
		document.getElementById("errfaculty_name").innerHTML="Faculty name should not be empty";
		i=1;
	}
	if(document.getElementById("faculty_designation").value == "")
	{
		document.getElementById("errfaculty_designation").innerHTML="Faculty designation should not be empty";
		i=1;
	}
	if(document.getElementById("faculty_profile").value == "")
	{
		document.getElementById("errfaculty_profile").innerHTML="Faculty Profile should not be empty";
		i=1;
	}
	if(document.getElementById("faculty_status").value == "")
	{
		document.getElementById("errfaculty_status").innerHTML="Faculty status should not be empty";
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