<?php
include("header.php");
include("sidebar.php");
unset($_SESSION['feedbacktopicid']);
unset($_SESSION['date']);
if(isset($_GET['feedbacktopicid']))
{
	$sqledit = "SELECT * FROM feedbacktopic where feedbacktopicid='$_GET[feedbacktopicid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	//######		
	$sqlstudent = "SELECT * FROM student WHERE studentid='$_GET[studentid]'";
	$qsqlstudent = mysqli_query($con,$sqlstudent);
	$rsstudent = mysqli_fetch_array($qsqlstudent);
	//######
}
?>
<style>
.answercomment {
    background-color: rgba(0, 0, 0, 0.2);
    color: white;
    white-space: nowrap;
    position: absolute;
    right: 10px;
    top: 10px;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

<br>
       <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php $sidemenu; ?> Student Detail</h3>
        </div>
        <div class="card-body">
	
<div class="row">
	<div class="col-md-12">
<table class="table table-bordered">

	<tr>
		<th style="width: 250px;">Student Name:</th><td><?php echo $rsstudent['studentname']; ?></td>
	</tr>	
	<tr>
		<th>Email - :</th><td><?php echo $rsstudent['rollno']; ?></td>
	</tr>
	<tr>
		<th>Class:</th><td><?php
$sqlcourse = "SELECT * FROM course where course_id='$rsstudent[course_id]'";
$qsqlcourse = mysqli_query($con,$sqlcourse);
$rscourse = mysqli_fetch_array($qsqlcourse);
echo $rscourse['course_title']; ?> (<?php echo $rsstudent['section']; ?>)	</td>
	</tr>
</table>
	</div>
</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- Main content -->
       <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Feedback Detail</h3>
        </div>
        <div class="card-body">
		
<?php
if(isset($_GET['feedbacktopicid']))
{
?>
<div class="row">
	<div class="col-md-12">
<table class="table table-bordered">

	<tr>
		<th style="width: 250px;">FeedBack Topic:</th><td><?php echo $rsedit['feedback_topic']; ?></td>
	</tr>
	<?php
	if($rsedit['course_id'] != 0)
	{
	?>
	<tr>
		<th>Course:</th><td><?php echo $rscourse['course_title']; ?></td>
	</tr>
	<?php
	}
	if($rsedit['faculty_id'] != 0)
	{
	?>
	<tr>
		<th>Guide:</th><td><?php echo $rsfaculty['faculty_name']; ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<th>FeedBack Detail:</th><td><?php echo $rsedit['feedbacktopic_detail']; ?></td>
	</tr>
</table>
	</div>
</div>
<?php
}
?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->
    <!-- /.content -->
	
<?php
if(isset($_GET['feedbacktopicid']))
{
?>
	
    <!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation2()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View FeedBack Question and Answers</h3>
        </div>
        <div class="card-body">
	
<table id="tblquestionviewer"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th style="height: 0px;">
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$sqlqz ="SELECT feedbackquestion_result.*, feedbackquestion.question,feedbackquestion.option1,feedbackquestion.option2,feedbackquestion.option3,feedbackquestion.option4,feedbackquestion.option5,feedbackquestion.option6,feedbackquestion.option7,feedbackquestion.option8,feedbackquestion.option9,feedbackquestion.option10,feedbackquestion.img FROM `feedbackquestion_result` LEFT JOIN feedbackquestion ON feedbackquestion_result.feedbackquestionid=feedbackquestion.feedbackquestionid WHERE feedbackquestion_result.feedbacktopicid='$_GET[feedbacktopicid]' AND  feedbackquestion_result.studentid='$_GET[studentid]' ORDER BY feedbackquestion_result.feedbackquestion_resultid";
$qsqlqz  = mysqli_query($con,$sqlqz);
$qno=1;
while($rsqz = mysqli_fetch_array($qsqlqz))
{
?>
	<tr>
		<td>
		
<input type="hidden" name="edtestseriesid" id="edtestseriesid" value="<?php echo $rsqz[0]; ?>">
		
		<table style='width: 100%;'>
			<tr>
				<td>
				
				<b>Question No. <?php echo $qno; ?>: </b>
				<?php echo $rsqz['question']; ?>			
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
?>			
			<tr>
				<td>
					<b>Answer:</b> <?php 
					if($rsqz['selectedanswer'] == "")
					{
					echo "Unanswered";
					}
					else
					{
					echo $rsqz['selectedanswer'];
					}
					?>
				</td>
			</tr>
		</table>


		</td>
	</tr>
<?php
$qno = $qno +1;
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



       <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">FeedBack detail</h3>
        </div>
        <div class="card-body">

<div class="row">
	<div class="col-md-12">
<table class="table table-bordered">

	<tr>
		<th style="width: 250px;">Total Questions:</th><td><?php echo mysqli_num_rows($qsqlqz); ?></td>
	</tr>
	<tr>
		<th>Answered Questions:</th><td><?php 
$sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_GET[feedbacktopicid]' AND studentid='$_GET[studentid]' and selectedanswer != ''";
$qsqlqz  = mysqli_query($con,$sqlqz);
echo mysqli_num_rows($qsqlqz);
		?></td>
	</tr>
	<tr>
		<th>UnAnswered Questions:</th><td><?php 
$sqlqz ="SELECT * FROM feedbackquestion_result WHERE feedbacktopicid='$_GET[feedbacktopicid]' AND studentid='$_GET[studentid]' and selectedanswer = ''";
$qsqlqz  = mysqli_query($con,$sqlqz);
echo mysqli_num_rows($qsqlqz);
		?></td>
	</tr>
</table>
	</div>
</div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->


       <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
<center><input type="button" name="button" class="btn btn-info" value="Print" onclick="window.print()" ></center>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

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
	"pageLength": 1000,
	"bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
	"sortb" : x,
});
} );
</script>

</body>
</html>