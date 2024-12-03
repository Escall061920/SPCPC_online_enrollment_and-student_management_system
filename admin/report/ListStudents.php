<div class="wrapper">
  <form action="" method="POST">
    <!-- Main content --> 
    <!-- Title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> San Pedro City Polytechnic College
          <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
        </h2>
      </div>
    </div>
    <!-- Info row -->
    <div class="row invoice-info">
      <div class="col-sm-2 invoice-col"></div>
      <div class="col-sm-2 invoice-col">
        Course and Year
        <address>
          <div class="form-group">
            <select name="Course" class="form-control"> 
              <option value="All">All</option>
              <?php 
                $mydb->setQuery("SELECT * FROM `course` ");
                $cur = $mydb->loadResultList();
                foreach ($cur as $result) {
                  echo '<option value="'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'">'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'</option>';
                }
              ?>
            </select>
          </div>
        </address>
      </div>

      <div class="col-sm-2 invoice-col">
        Semester
        <address> 
          <select name="Semester" class="form-control">
            <option value="First">First</option>
            <option value="Second">Second</option> 
          </select>
        </address>
      </div>

      <div class="col-sm-2 invoice-col">
        <label for="student_status">Student Status</label>
        <address>
          <select name="student_status" id="student_status" class="form-control">
            <option value="">Select Status</option>
            <option value="Regular">Regular</option>
            <option value="Irregular">Irregular</option> 
          </select>
        </address>
      </div>

      <div class="col-sm-2 invoice-col">
        Academic Year
        <address> 
          <select name="SY" class="form-control">
            <?php 
              $mydb->setQuery("SELECT DISTINCT(`AY`) FROM `schoolyr`");
              $cur = $mydb->loadResultList();
              foreach ($cur as $result) {
                echo '<option>'.$result->AY.'</option>';
              }
            ?>
          </select>
        </address>
      </div>

      <div class="col-sm-2 invoice-col"> 
        <br/>
        <address>
          <div class="form-group"> 
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </address>
      </div>
    </div>
    <!-- Title row for student list -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> List Of Students
          <small class="pull-right"> 
            <?php 
              echo (isset($_POST['Course']) && $_POST['Course'] !== 'All') ? 'Course/Year :' .$_POST['Course'] .' ||' : ''; 
              echo (isset($_POST['Semester'])) ? ' Semester :' .$_POST['Semester'] .' ||' : ''; 
              echo (isset($_POST['student_status'])) ? ' Student Status :' .$_POST['student_status'] .' ||' : ''; 
              echo (isset($_POST['SY'])) ? ' SY :' .$_POST['SY'] : ''; 
            ?> 
          </small>
        </h2>
      </div> 
    </div> 

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 col-md-12 table-responsive">
        <table class="table table-bordered " style="font-size:15px" cellspacing="0">
          <thead style="background-color: #098744; color: white;">
            <tr>
              <th>Student Number</th>
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
          <tbody style="background-color: #098744; color: white;">
            <?php
              $tot = 0;
              if(isset($_POST['submit'])) {
                $course = $_POST['Course'];
                $semester = $_POST['Semester'];
                $status = $_POST['student_status'];
                $sy = $_POST['SY'];

                // Base query
                $sql = "SELECT DISTINCT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, c.COURSE_NAME, c.COURSE_LEVEL, sy.SEMESTER, sy.AY, s.student_status 
                        FROM schoolyr sy
                        JOIN tblstudent s ON sy.IDNO = s.IDNO
                        JOIN course c ON s.COURSE_ID = c.COURSE_ID
                        WHERE sy.SEMESTER = '$semester'
                        AND sy.AY = '$sy'";
                
                // Adding Course filter if not 'All'
                if ($course !== 'All') {
                  $sql .= " AND CONCAT(c.COURSE_NAME, '-', c.COURSE_LEVEL) = '$course'";
                }

                // Adding student status filter
                if (!empty($status)) {
                  $sql .= " AND s.student_status = '$status'";
                }

                // Execute query
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
                      <td><?php echo htmlspecialchars($result->FNAME . ' ' . $result->MNAME . ' ' . $result->LNAME); ?></td>
                      <td><?php echo htmlspecialchars($result->HOME_ADD); ?></td>
                      <td><?php echo htmlspecialchars($result->SEX); ?></td>
                      <td><?php echo date_diff(date_create($dbirth), date_create($today))->y; ?></td>
                      <td><?php echo htmlspecialchars($result->CONTACT_NO); ?></td>
                      <td><?php echo htmlspecialchars($result->STATUS); ?></td>
                      <td><?php echo htmlspecialchars($result->COURSE_NAME . '-' . $result->COURSE_LEVEL); ?></td>
                      <td><?php echo htmlspecialchars($result->student_status); ?></td>
                    </tr>
                    <?php  
                    $tot++;
                  } 
                } else {
                  echo '<tr><td colspan="9" align="center">No students found for the selected criteria.</td></tr>';
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

  <!-- Print form -->
  <form action="ListStudentPrint.php" method="POST" target="_blank">
    <input type="hidden" name="Course" value="<?php echo isset($_POST['Course']) ? $_POST['Course'] : ''; ?>">
    <input type="hidden" name="Semester" value="<?php echo isset($_POST['Semester']) ? $_POST['Semester'] : ''; ?>">
    <input type="hidden" name="student_status" value="<?php echo isset($_POST['student_status']) ? $_POST['student_status'] : ''; ?>">
    <input type="hidden" name="SY" value="<?php echo isset($_POST['SY']) ? $_POST['SY'] : ''; ?>">

    <div class="row no-print">
      <div class="col-xs-12">
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
      </div>
    </div>
  </form>
</div>
