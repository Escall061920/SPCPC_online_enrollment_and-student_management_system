 
 <form action="" method="POST" >
    <!-- Main content --> 
        <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i>San Pedro City Polytechnic College
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
       
      </div>
        
        <div class="col-sm-4 invoice-col">
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

        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
         Semester
          <address> 
		         <select name="Semester" class="form-control">
              <option value="First">First</option>
              <option value="Second">Second</option> 
            </select>
          </address>
        </div>
          
           <!-- /.col -->
        <div class="col-sm-2 invoice-col"> 
        <br/>
        <address>
        <div class="form-group"> 
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
		  </div>
		  
        </address>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- title row -->
  
   <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i  class="fa fa-globe">List Of Students Enrolled per Semester</i>
              <small class="pull-right"> <?php echo (isset($_POST['Course'])) ? 'Course/Year :' .$_POST['Course'] .' ||': ''; ?>
                <?php echo (isset($_POST['Semester'])) ? ' Semester :' .$_POST['Semester'] : ''; ?> 
                  </small>
          </h2>
        </div> 
      </div> 
   

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
          <table class="table table-bordered" style="font-size:15px" cellspacing="0" >
            <thead style="background-color: #098744; color: white;">
            <tr>
              <th>Student Number</th>
              <th>Name</th> 
              <th>Address</th>
              <th>Sex</th> 
              <th>AGE</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Course/Year</th>
              <th>Section</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody style="background-color: #098744; color: white;">
            <?php
$tot = 0;  // Initialize total count

if (isset($_POST['submit'])) {

    if ($_POST['Course'] == 'All') {
        // Query for all courses and filtering by semester
        $sql = "SELECT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, 
                       c.COURSE_NAME, c.COURSE_LEVEL, s.student_status, s.SECTION
                FROM `schoolyr` sy
                JOIN `tblstudent` s ON sy.IDNO = s.IDNO
                JOIN `course` c ON s.COURSE_ID = c.COURSE_ID
                WHERE sy.SEMESTER LIKE '%" . $_POST['Semester'] . "%'
                GROUP BY s.IDNO";  // Group by student ID to eliminate duplicates

    } else {
        // Query for a specific course and filtering by semester
        $sql = "SELECT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, 
                       c.COURSE_NAME, c.COURSE_LEVEL, s.student_status, s.SECTION
                FROM `schoolyr` sy
                JOIN `tblstudent` s ON sy.IDNO = s.IDNO
                JOIN `course` c ON s.COURSE_ID = c.COURSE_ID
                WHERE CONCAT(c.COURSE_NAME, '-', c.COURSE_LEVEL) LIKE '%" . $_POST['Course'] . "%'
                AND sy.SEMESTER LIKE '%" . $_POST['Semester'] . "%'
                GROUP BY s.IDNO";  // Group by student ID to eliminate duplicates
    }

    $mydb->setQuery($sql);
    $res = $mydb->executeQuery();
    $row_count = $mydb->num_rows($res);
    $cur = $mydb->loadResultList();

    if ($row_count > 0) {
        foreach ($cur as $result) {
            $dbirth = date($result->BDAY);
            $today = date('Y-M-d');
?>
            <tr>
                <td><?php echo $result->STUDENT_NUMBER; ?></td>
                <td><?php echo $result->FNAME . ' ' . $result->MNAME . ' ' . $result->LNAME; ?></td>
                <td><?php echo $result->HOME_ADD; ?></td>
                <td><?php echo $result->SEX; ?></td>
                <td><?php echo date_diff(date_create($dbirth), date_create($today))->y; ?></td>
                <td><?php echo $result->CONTACT_NO; ?></td>
                <td><?php echo $result->STATUS; ?></td>
                <td><?php echo $result->COURSE_NAME . '-' . $result->COURSE_LEVEL; ?></td>
                <td><?php echo $result->SECTION; ?></td>
                <td><?php echo $result->student_status; ?></td>
            </tr>
<?php
            $tot++;  // Increment the total number of students manually
        }
    }
}
?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="9" align="right"><h2>Total Number of Student/s : </h2></td><td><h2><?php echo $tot ; ?></h2></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 
</form>
    <form action="printpersemester.php" method="POST" target="_blank">
    <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>">
     <input type="hidden" name="Semester" value="<?php echo (isset($_POST['Semester'])) ? $_POST['Semester'] : ''; ?> ">  
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
             <span class="pull-right"> <button type="submit" class="btn btn-primary"  ><i class="fa fa-print"></i> Print</button></span>  
          </div>
          </div> 
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>
 
</div>
<!-- ./wrapper -->  
