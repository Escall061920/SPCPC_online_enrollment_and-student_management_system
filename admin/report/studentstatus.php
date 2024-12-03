<div class="wrapper">
  <form action="" method="POST">
    <!-- Main content --> 
    <!-- Title Row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> San Pedro City Polytechnic College
          <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
        </h2>
      </div>
    </div>

    <div class="row invoice-info">
      <div class="col-sm-2 invoice-col"></div>
      <div class="col-sm-2 invoice-col">
        Course and Year
        <address>
          <div class="form-group">
            <select name="Course" class="form-control"> 
              <option>All</option>
              <?php 
                $mydb->setQuery("SELECT * FROM `course` ");
                $cur = $mydb->loadResultList();
                foreach ($cur as $result) {
                  echo '<option value="'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'" >'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.' </option>';
                }
              ?>
            </select>
          </div>
        </address>
      </div>

    <!-- Info Row -->
    <div class="row invoice-info">
      <div class="col-sm-2 invoice-col"></div>

      <div class="col-sm-2 invoice-col">
        <label for="student_status">Student Status</label>
        <select name="student_status" id="student_status" class="form-control">
          <option value="">Select Status</option>
          <option value="Regular">Regular</option>
          <option value="Irregular">Irregular</option> 
        </select>
      </div>

      <div class="col-sm-2 invoice-col"> 
        <br/>
        <div class="form-group"> 
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
    
    <!-- List of Students Title Row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> List Of Students
          <small class="pull-right"> 
            <?php 
             echo (isset($_POST['Course'])) ? 'Course/Year :' .$_POST['Course'] .' ||': ''; 
              echo (isset($_POST['student_status']) && $_POST['student_status'] != "") ? ' Student Status: ' . htmlspecialchars($_POST['student_status']) . ' ||': ''; 
            ?> 
          </small>
        </h2>
      </div> 
    </div> 

    <!-- Table Row -->
    <div class="row">
      <div class="col-xs-12 col-md-12 table-responsive">
        <table class="table table-bordered table-striped" style="font-size:11px" cellspacing="0">
          <thead>
            <tr>
              <th>Sudent Number</th>
              <th>Name</th> 
              <th>Address</th>
              <th>Sex</th> 
              <th>Age</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Course/Year</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $tot = 0;
              if (isset($_POST['submit']) && $_POST['student_status'] != "" && isset($_POST['Course'])) {
                $student_status = htmlspecialchars($_POST['student_status']); // Sanitize input
                $course = htmlspecialchars($_POST['Course']); // Sanitize input for Course
                // Your SQL query should also include the course filter here
            
            // Sanitize input
            $sql = "SELECT DISTINCT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, c.COURSE_NAME, c.COURSE_LEVEL, s.student_status 
            FROM tblstudent s 
            JOIN course c ON s.COURSE_ID = c.COURSE_ID
            WHERE s.student_status = '$student_status'";
    
    if ($course !== "All") { // Check if a specific course is selected
        $sql .= " AND CONCAT(c.COURSE_NAME, '-', c.COURSE_LEVEL) = '$course'";
    }
    

                $mydb->setQuery($sql);
                $res = $mydb->executeQuery();
                $row_count = $mydb->num_rows($res);
                $cur = $mydb->loadResultList();

                if ($row_count > 0) {
                  foreach ($cur as $result) {
                    $dbirth = date($result->BDAY);
                    $today = date('Y-m-d'); 
                    ?>
                    <tr> 
                      <td><?php echo htmlspecialchars($result->STUDENT_NUMBER); ?></td>
                      <td><?php echo htmlspecialchars($result->FNAME . ' ' .  $result->MNAME . ' ' .  $result->LNAME); ?></td>
                      <td><?php echo htmlspecialchars($result->HOME_ADD); ?></td>
                      <td><?php echo htmlspecialchars($result->SEX); ?></td>
                      <td><?php echo date_diff(date_create($dbirth), date_create($today))->y; ?></td>
                      <td><?php echo htmlspecialchars($result->CONTACT_NO); ?></td>
                      <td><?php echo htmlspecialchars($result->STATUS); ?></td>
                      <td><?php echo htmlspecialchars($result->COURSE_NAME . ' - ' . $result->COURSE_LEVEL); ?></td>
                      <td><?php echo htmlspecialchars($result->student_status); ?></td>
                    </tr>
                    <?php  
                    $tot++;
                  } 
                } else {
                  echo '<tr><td colspan="9" align="center">No students found for the selected status.</td></tr>';
                }
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="8" align="right"><h2>Total Number of Student/s:</h2></td>
              <td><h2><?php echo $tot; ?></h2></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </form>
  
  <form action="ListStudentPrint.php" method="POST" target="_blank">
    <input type="hidden" name="student_status" value="<?php echo (isset($_POST['student_status'])) ? htmlspecialchars($_POST['student_status']) : ''; ?>">

    <!-- This row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
      </div>
    </div>
  </form>
</div>
