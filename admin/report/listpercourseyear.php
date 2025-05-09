 
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
      <div class="col-sm-6 invoice-col">
       
      </div>
        
     

        <div class="col-sm-4 invoice-col">
          Course/Year and Section
          <address>
            <div class="form-group">

            
			  <select name="Course" class="form-control">
              <option value="">Select a Course/Year and Section</option>  
      <?php 
        $mydb->setQuery("SELECT DISTINCT c.COURSE_NAME, c.COURSE_LEVEL, s.SECTION FROM course c JOIN tblstudent s ON c.COURSE_ID = s.COURSE_ID ORDER BY c.COURSE_NAME, c.COURSE_LEVEL, s.SECTION");
        $cur = $mydb->loadResultList();

        foreach ($cur as $result) {
          echo '<option value="'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'-'.$result->SECTION.'" >'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'-'.$result->SECTION.' </option>';
        }
      ?>
			  </select>
		  </div>
          </address>
        </div> 
        <!-- /.col -->
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
            <i  class="fa fa-globe">List Of Students Enrolled per Course/Year and Section</i>
              <small class="pull-right"> <?php 
              echo (isset($_POST['Course'])) ? 'Course/Year/Section :' .$_POST['Course'] : ''; 
               ?>
              
                 
                  </small>
                  
                  
          </h2>
        </div> 
      </div> 
   

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
          <table class="table table-bordered " style="font-size:15px" cellspacing="0" >
            <thead style="background-color: #098744; color: white;">
            <tr>
              <th>Student Number</th>
              <th>Name</th> 
              <th>Address</th>
              <th>Sex</th> 
              <th>AGE</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Course</th>
              <th>Year Level</th>
              <th>Section</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody style="background-color: #098744; color: white;">
            <?php
$tot = 0;

if (isset($_POST['submit'])) {
  
    $course = explode('-', $_POST['Course']);
    
    // Check if all required parts exist
    if(count($course) >= 3) {
        $courseName = $course[0];
        $courseLevel = $course[1]; 
        $section = $course[2];

        $sql = "SELECT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, 
                       c.COURSE_NAME, c.COURSE_LEVEL, s.SECTION, s.student_status
                FROM schoolyr sy
                JOIN tblstudent s ON sy.IDNO = s.IDNO
                JOIN course c ON s.COURSE_ID = c.COURSE_ID
                WHERE c.COURSE_NAME = '{$courseName}' 
                AND c.COURSE_LEVEL = '{$courseLevel}'
                AND s.SECTION = '{$section}'
                GROUP BY s.IDNO";  // Group by IDNO to avoid duplication

        if (!empty($status)) {
            $sql .= " AND s.student_status = '$status'";
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
                <td><?php echo $result->COURSE_NAME; ?></td>
                <td><?php echo $result->COURSE_LEVEL; ?></td>
                <td><?php echo $result->SECTION; ?></td>
                <td><?php echo $result->student_status; ?></td>
            </tr>
<?php
                $tot++;
            }
        }
    }
}
?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="10" align="right"><h2>Total Number of Student/s : </h2></td><td><h2><?php echo $tot ; ?></h2></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 
</form>
    <form action="printcourseyear.php" method="POST" target="_blank">
    <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>"> 

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