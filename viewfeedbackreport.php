<?php
include("header.php");
include("sidebar.php");
$sqlfeedbacktopic = "SELECT * FROM feedbacktopic where feedbacktopicid='$_GET[feedbacktopicid]'";
$qsqlfeedbacktopic = mysqli_query($con,$sqlfeedbacktopic);
$rsfeedbacktopic = mysqli_fetch_array($qsqlfeedbacktopic);
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
          <h3 class="card-title">View Feedback - <?php echo $rsfeedbacktopic['feedback_topic']; ?></h3>
        </div>
        <div class="card-body">
<table id="myTable"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>Student</th>
			<th>Class</th>
			<th>Feedback Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM feedbackquestion_result GROUP BY studentid";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		//######		
		$sqlstudent = "SELECT * FROM student WHERE studentid='$rs[studentid]'";
		$qsqlstudent = mysqli_query($con,$sqlstudent);
		$rsstudent = mysqli_fetch_array($qsqlstudent);
		//######
/*		
$sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$rs[feedbacktopicid]' AND studentid='$rs[studentid]' and selectedanswer = correctanswer ";
$qsqlqz  = mysqli_query($con,$sqlqz);
echo mysqli_error($con);
$correctanswer= mysqli_num_rows($qsqlqz);
*/

$sqlfeedbackquestion_result ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$rs[feedbacktopicid]' AND studentid='$rs[studentid]'";
$qsqlfeedbackquestion_result  = mysqli_query($con,$sqlfeedbackquestion_result);
$rsfeedbackquestion_result = mysqli_fetch_array($qsqlfeedbackquestion_result);

		echo "<tr>
				<td>";
	?>
<b><?php echo $rsstudent['studentname']; ?></b><br><b>Email - </b> <?php echo $rsstudent['rollno']; ?>
	<?php
		echo "</td>
				<td>";
				?>
<?php
$sqlcourse = "SELECT * FROM course where course_id='$rsstudent[course_id]'";
$qsqlcourse = mysqli_query($con,$sqlcourse);
$rscourse = mysqli_fetch_array($qsqlcourse);
echo $rscourse['course_title']; ?> (<?php echo $rsstudent['section']; ?>)				
				<?php
				echo "</td>
				<td>". date("d-M-Y",strtotime($rs['date'])) ."</td>";
		if(isset($_SESSION['adminid']))
		{
			echo "<td><a href='admin_feedbackquestion_success.php?feedbacktopicid=$rs[feedbacktopicid]&studentid=$rs[studentid]' class='btn btn-info'>View</a> </td>";
		}
		else
		{
			echo "<td><a href='feedbackquestion_success.php?feedbacktopicid=$rs[feedbacktopicid]&studentid=$rs[studentid]' class='btn btn-info'>View</a> </td>";
		}	
			echo "</tr>";
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