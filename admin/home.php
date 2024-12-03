<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
<div class="row">
         <div class="col-lg-12">
         
       			<img style="float:right;" src="<?php echo web_root; ?>img/spcpc_seal_100x100.jpg" >
       		</div>
            <h1 class="page-header">Welcome to the <?php echo $_SESSION['ACCOUNT_TYPE'] ?> Panel</h1>
          
       		
          </div>
          
          
          <!-- /.col-lg-12 -->

 </div>
 
 <div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-user-plus box-icon"></i>
                    <h3 class="box-title"><b>New Enrollees</b></h3>
                </div>
                <div class="box-body">
                              
                </div>
                <div class="box-footer">
                    <a href="enrollees/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-book box-icon"></i>
                    <h3 class="box-title"><b>Subjects</b></h3>
                </div>
                <div class="box-body">
                 
                </div>
                <div class="box-footer">
                    <a href="subject/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-building box-icon"></i>
                    <h3 class="box-title"><b>Departments</b></h3>
                </div>
                <div class="box-body">
        
                </div>
                <div class="box-footer">
                    <a href="department/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-graduation-cap box-icon"></i>
                    <h3 class="box-title"><b>Courses</b></h3>
                </div>
                <div class="box-body">
                    
                </div>
                <div class="box-footer">
                    <a href="course/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-calendar-alt box-icon"></i>
                    <h3 class="box-title"><b>Schedules</b></h3>
                </div>
                <div class="box-body">

                </div>
                <div class="box-footer">
                    <a href="schedule/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-user-graduate box-icon"></i>
                    <h3 class="box-title"><b>Students</b></h3>
                </div>
                <div class="box-body">
           
                </div>
                <div class="box-footer">
                    <a href="student/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-chalkboard-teacher box-icon"></i>
                    <h3 class="box-title"><b>Instructors</b></h3>
                </div>
                <div class="box-body">
                  
                </div>
                <div class="box-footer">
                    <a href="instructor/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-cog box-icon"></i>
                    <h3 class="box-title"><b>Set a Semester</b></h3>
                </div>
                <div class="box-body">
                  
                </div>
                <div class="box-footer">
                    <a href="maintenance/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-clipboard-list box-icon"></i>
                    <h3 class="box-title"><b>Organize the rooms</b></h3>
                </div>
                <div class="box-body">
                  
                </div>
                <div class="box-footer">
                    <a href="classroom/index.php">More info</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fas fa-users box-icon"></i>
                    <h3 class="box-title"><b>Student Lists</b></h3>
                </div>
                <div class="box-body">
             
                </div>
                <div class="box-footer">
                    <a href="report/index.php">More info</a>
                </div>
            </div>
        </div>

        
       
         <?php if (isset($_SESSION['ACCOUNT_TYPE']) && $_SESSION['ACCOUNT_TYPE'] == 'Administrator') { ?>

            <div class="col-lg-3 col-md-6">
                 <div class="box">
                      <div class="box-header with-border">
                    <i class="fas fa-history box-icon"></i>
                    <h3 class="box-title"><b>User History Logs</b></h3>
                </div>
                <div class="box-body">
                       
                </div>
                <div class="box-footer">
                    <a href="report/index.php?view=log">More info</a>
                </div>
            </div>
        </div>

    <div class="col-lg-3 col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <i class="fas fa-user box-icon"></i>
                <h3 class="box-title"><b>System Users</b></h3>
            </div>
            <div class="box-body">
                <!-- Additional content here if needed -->
            </div>
            <div class="box-footer">
                <a href="user/index.php">More info</a>
            </div>
        </div>
    </div>
<?php } ?>
    </div>
</div>



   
<style>

    
     .box {
            border: 2px solid #404040; /* Gray border */
            border-radius: 10px; /* More rounded corners */
            background-color: #098744; /* Light green background */
            padding: 15px; /* Padding inside the box */
            margin-bottom: 20px; /* Space between boxes */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional shadow for depth */
        }
        
        .box-header {
            background-color: #098744; /* Slightly darker green for header */
            border-bottom: 1px solid #d3d3d3; /* Border below header */
            padding: 10px;
            margin-bottom: 10px;
            font-weight: bold;
            position: relative; /* For positioning the icon */
        }
        
        .box-title {
            color: white;
            font-size: 18px; /* Larger title font size */
            margin-left: 40px; /* Space for the icon */
        }
        
        .box-icon {
            position: absolute; /* Position the icon to the left */
            left: 10px; /* Distance from the left */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust to align properly */
            font-size: 24px; /* Icon size */
            color: white; /* Icon color */
        }
        
        .box-body {
            font-size: 16px; /* Larger font size for better readability */
        }
        
        .box-footer {
            background-color: #b2ebf2; /* Match footer background with header */
            border-top: 1px solid #d3d3d3; /* Border above footer */
            padding: 10px;
            text-align: right; /* Align footer text to the right */
        }

        .box-footer a {
    color: black; /* Change this to your desired color */
    text-decoration: none; /* Remove underline (optional) */
}


        /* Optional: increase the size of the boxes */
        .col-lg-3, .col-md-6 {
            padding: 10px; /* Extra padding around each box */
        }

</style>

  