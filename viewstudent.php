<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	//Step 2 : Select statement starts here
	$sqledit ="SELECT * FROM student WHERE studentid='".$_GET['delid']."'";
	$qsqledit = mysqli_query($con,$sqledit);
		echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
	//Step 2 : Select statement ends here
//################################
$log_message = "Student Account $rsedit[studentname]($rsedit[rollno]) deleted...";
	$sql ="DELETE FROM `student` where studentid ='". $_GET['delid'] . "' ";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Student record deleted successfully...');</script>";
		echo "<script>window.location='viewstudent.php';</script>";
	}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br>
    <!-- Main content -->
    <section class="content">
<form method="post" action="">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Student Profile</h3>
        </div>
        <div class="card-body">
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Name</th>
			<th>Roll No.</th>
			<th>DOB</th>
			<th>Course</th>
			<th>Section</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT ss.* FROM student ss WHERE ss.status != '' ";
	if(isset($_SESSION['schoolheadmasterid']))
	{
		$sql = $sql . " AND ss.schoolid='$_SESSION[schoolid]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlcourse = "SELECT * FROM course where course_id='$rs[course_id]'";
		$qsqlcourse = mysqli_query($con,$sqlcourse);
		$rscourse = mysqli_fetch_array($qsqlcourse);
		echo "<tr>
				<td>$rs[studentname]</td>
				<td>$rs[rollno]</td>
				<td>" . date("d-M-Y",strtotime($rs['dateofbirth'])) ."</td>
				<td>" . $rscourse['course_title'] . "</td>
				<td>$rs[section]</td>
				<td>$rs[status]</td>
				<td style='width: 75px;'><a href='student.php?editid=$rs[0]' class='btn btn-info' style='width: 75px;'>Edit</a>  <a href='viewstudent.php?delid=$rs[0]' onclick='return validatedel()'  class='btn btn-danger' style='width: 75px;' >Delete</a></td>
			</tr>";
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
</body>
</html>
<script src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
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