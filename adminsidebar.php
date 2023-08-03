  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<?php
if($sidemenu == "admin")
{
?>
    <a href="admindashboard.php" class="brand-link">
<?php
}
?>
      <img src="dist/img/ietracker.png" 
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Feedback Portal</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			   
          <li class="nav-item has-treeview">
            <a href="admindashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  		
		  	
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Feedback
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="feedbacktopicadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Feedback Topic</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewfeedbacktopicadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Feedbacks Topics</p>
                </a>
              </li>
            </ul>
          </li>
		  		
		  	
            
				  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add  Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewstudent.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View  Student</p>
                </a>
              </li>
            </ul>
          </li>
								  		

				
				  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Faulty
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="faculty.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add  Faculty</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewfaculty.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View  Faculty</p>
                </a>
              </li>
            </ul>
          </li>
						
				  			
				  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="course.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add  Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewcourse.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View  Course</p>
                </a>
              </li>
            </ul>
          </li>
						
				  		
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add  Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View  Admin</p>
                </a>
              </li>
            </ul>
          </li>
		
		  </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>