<?php
include("header.php");
include("sidebar.php");
?>
<style>
    .bs-example{
    	margin: 20px;
    }
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>
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
          <h3 class="card-title">View  Test Series</h3>
        </div>
        <div class="card-body">
<table id="example"  class="table table-striped table-bordered" >
	<thead>
		<tr>	
			<th>Student</th>		
			<th>Category</th>
			<th>Publish date</th>
			<th>Test series Title</th>
			<th>View</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM testseriestopic WHERE testseriestopicid!='0' ";
	if(isset($_SESSION['studentid']) && $_GET['qtype'] == "Single")
	{
		$sql = $sql . " AND studentid='$_SESSION[studentid]'";
	}
	if($_GET['qtype'] == "All")
	{
		$sql = $sql . " AND testseries_status='Approved'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
//######		
$sqlcategory = "SELECT * FROM category WHERE categoryid='$rs[categoryid]'";
$qsqlcategory = mysqli_query($con,$sqlcategory);
$rscategory = mysqli_fetch_array($qsqlcategory);
//######		
//######		
$sqlstudent = "SELECT * FROM student WHERE studentid='$rs[studentid]'";
$qsqlstudent = mysqli_query($con,$sqlstudent);
$rsstudent = mysqli_fetch_array($qsqlstudent);
//######
//######		
$sqladmin = "SELECT * FROM admin WHERE adminid='$rs[adminid]'";
$qsqladmin = mysqli_query($con,$sqladmin);
$rsadmin = mysqli_fetch_array($qsqladmin);
//######
		echo "<tr>";
		echo "<td>";
?>
<?php
if($rsadmin['adminid'] == 0)
{
?>
<b><?php echo $rsstudent['studentname']; ?></b><br><b>Email - </b> <?php echo $rsstudent['rollno']; ?><br><b>Class- </b><?php echo $rsstudent['studentclass']; ?> (<?php echo $rsstudent['section']; ?>)
<?php
}
else
{
?>
<b >Admin Post</b><br><b>Name-</b> <?php echo $rsadmin['adminname']; ?>
<?php
}
?>
<?php
		echo "</td>";

		echo "<td>$rscategory[category]</td>";
		echo "<td>" . date("d-M-Y",strtotime($rs['qpaper_date'])) ."<br>". date("h:i A",strtotime($rs['qpaper_date'])) . "</td>";
		echo "<td>$rs[testseries_topic]</td>";
?>
		<td style='width:70px;'><a href="" onclick="funloadtestseries('<?php echo $rs[0]; ?>','<?php echo $rs['testseries_topic']; ?>')" data-toggle="modal" data-target="#exampleModal" class="btn btn-warning">View <br>&nbsp;(<?php
			$sqlqz ="SELECT * FROM testseries WHERE testseriestopicid='$rs[0]'";
			$qsqlqz  = mysqli_query($con,$sqlqz);
			echo mysqli_num_rows($qsqlqz);
			?>)
		</a></td>
<?php
		echo "<td>$rs[testseries_status]</td>";
		echo "<td style='width:70px;'><a href='testseriestopic.php?testseriestopicid=$rs[0]' class='btn btn-primary' >View<br>More</a></td>";
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <h5 class="modal-title" id="iexampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id="idocspaper"></div>
    </div>
  </div>
</div>
<script>
function funloadtestseries(testseriestopicid,qpaper_title)
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
      if (this.readyState == 4 && this.status == 200) 
	  {
		document.getElementById("iexampleModalLabel").innerHTML = qpaper_title;
		document.getElementById("idocspaper").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","ajaxtestserieslist.php?testseriestopicid="+testseriestopicid,true);
    xmlhttp.send();
	return false;
}
</script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(0) th').each( function (i) {
		if(i ==  0 || i ==  1 || i ==  3)
		{
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control" />' );
	 
			$( 'input', this ).on( 'keyup change', function () {
				if ( table.column(i).search() !== this.value ) {
					table
						.column(i)
						.search( this.value )
						.draw();
				}
			} );
		}
		else
		{
			
			var title = $(this).text();
			$(this).html( '' );
	 
			$( 'input', this ).on( 'keyup change', function () {
				if ( table.column(i).search() !== this.value ) {
					table
						.column(i)
						.search( this.value )
						.draw();
				}
			} );
		}
    } );
 
    var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );
</script>