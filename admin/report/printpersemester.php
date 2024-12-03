<?php
require_once("../../include/initialize.php");
  if(!isset($_SESSION['ACCOUNT_ID'])){
  redirect(web_root."admin/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>San Pedro City Polytechnic College</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
 
   <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h4 class="page-header ">
          <i class="fa fa-globe"></i> San Pedro City Polytechnic College
           <small class="pull-right">Printed Date: <?php echo date('m/d/Y'); ?></small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <div class="row"><h2 align="center">List Of Students Enrolled per Semester</h2>
    <h5 align="center"><?php echo isset($_POST['Course']) ? "Course/Year :". $_POST['Course'] ." || Semester :". $_POST['Semester']: ''; ?></h5></div>
    <!-- info row --> 
     <!-- Table row --> 
          <table class="table table-bordered  table-striped" style="font-size:11px" cellspacing="0" >
            <thead>
            <tr>
              <th>Student Number</th>
              <th>Name</th> 
              <th>Address</th>
              <th>Sex</th> 
              <th>AGE</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Course/Year</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
$tot = 0;  // Initialize total count

if ($_POST['Course'] == 'All') {
    // Query for all courses with specific semester
    $sql = "SELECT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, 
                   c.COURSE_NAME, c.COURSE_LEVEL, s.student_status 
            FROM schoolyr sy
            JOIN tblstudent s ON sy.IDNO = s.IDNO
            JOIN course c ON s.COURSE_ID = c.COURSE_ID
            WHERE sy.SEMESTER = '" . $_POST['Semester'] . "'
            GROUP BY s.IDNO";  // Group by student ID to avoid duplicates

} else {
    // Query for specific course and specific semester
    $sql = "SELECT s.STUDENT_NUMBER, s.FNAME, s.MNAME, s.LNAME, s.HOME_ADD, s.SEX, s.BDAY, s.CONTACT_NO, s.STATUS, 
                   c.COURSE_NAME, c.COURSE_LEVEL, s.student_status 
            FROM schoolyr sy
            JOIN tblstudent s ON sy.IDNO = s.IDNO
            JOIN course c ON s.COURSE_ID = c.COURSE_ID
            WHERE CONCAT(c.COURSE_NAME, '-', c.COURSE_LEVEL) = '" . $_POST['Course'] . "'
            AND sy.SEMESTER = '" . $_POST['Semester'] . "'
            GROUP BY s.IDNO";  // Group by student ID to avoid duplicates
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
            <td><?php echo $result->student_status; ?></td>
        </tr>
<?php
        $tot++;  // Increment total number of unique students
    }
}
?>

            </tbody>
              <tfoot>
              <tr>
                <td colspan="8" align="right"><h2>Total Number of Student/s : </h2></td><td><h2><?php echo   $tot ; ?></h2></td>
              </tr>
            </tfoot>
          </table> 
        <!-- /.col --> 
      <!-- /.row -->
  
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
