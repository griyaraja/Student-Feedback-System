<?php
include("database.php");
?>  
<!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation1()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Test series Questions</h3>
        </div>
        <div class="card-body">
<?php
	$sqledit = "SELECT * FROM testseriestopic where testseriestopicid='$_GET[testseriestopicid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
?>	
<table class="table table-striped table-bordered" >
	<tbody>
	<tr>
		<th>Test series Topic</th><td><?php echo $rsedit['testseries_topic']; ?></td>
	</tr>
	<tr>
		<th>Marks per Question</th><td><?php echo $rsedit['marksperquestion']; ?></td>
	</tr>
	<tr>
		<th>Negative mark</th><td><?php echo $rsedit['negativemarks']; ?></td>
	</tr>
	<tr>
		<th>Number of Questions</th><td>
			<?php
			$sqlqz ="SELECT * FROM testseries WHERE testseriestopicid='$_GET[testseriestopicid]'";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?>
		</td>
	</tr>
	</tbody>
</table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</form>
    </section>
    <!-- /.content -->


	<!-- Main content -->
    <section class="content">
<form method="post" action="" onsubmit="return confirmvalidation1()" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Test series Questions</h3>
        </div>
        <div class="card-body">
<table id="tblquestionviewer"  class="table table-striped table-bordered" >
	<thead>
		<tr>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$qno = 1;
while($rsqz = mysqli_fetch_array($qsqlqz))
{
?>
	<tr>
		<td>
<form method="post" action="" onsubmit="return confirmvalidation2()" enctype="multipart/form-data">
<input type="hidden" name="edtestseriesid" id="edtestseriesid" value="<?php echo $rsqz['testseriesid']; ?>">
<div class="row">
	<div class="col-md-12">
		<b>Question No. <?php echo $qno; ?></b><br>
		<?php echo $rsqz['question']; ?>
	</div>   
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<b>Option 1</b> :- <?php echo $rsqz['option1']; ?><br>
	</div>
	<div class="col-md-12">
		<b>Option 2</b> :- <?php echo $rsqz['option2']; ?>
	</div>

	<div class="col-md-12">
		<b>Option 3</b> :- <?php echo $rsqz['option3']; ?>
	</div>
	<div class="col-md-12">
		<b>Option 4</b> :- <?php echo $rsqz['option4']; ?><br>
	</div>
</div>    
<br>	

<div class="row">
	<div class="col-md-12">
		<b>Correct Answer </b> :-	<?php echo $rsqz['correctanswer']; ?>
	</div>
	<div class="col-md-12">
	<b>Image</b> :- <?php
if(isset($_GET['testseriestopicid']))
{
	if(file_exists("imgquestion/".$rsqz['img']))
	{
?>
<a href="imgquestion/<?php echo $rsqz['img']; ?>" class="btn btn-info" download >Download file</a>
<?php
	}
}
?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<b>Status</b> :- <?php echo $rsqz['status']; ?>
	</div>
</div>
<br>

</form>
		</td>
	</tr>
<?php
	$qno = $qno + 1;
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