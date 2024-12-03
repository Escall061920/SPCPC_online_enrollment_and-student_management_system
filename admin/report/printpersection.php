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
  <title>San Pedro City Polytechnic College </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet" media="all">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet" media="all">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet" media="all">

    <!-- Morris Charts CSS -->
    <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet" media="all">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

    <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet" media="all">
 
    <!-- datetime picker CSS -->
    <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="all">
    <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="all">
 
    <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet" media="all">

    <style type="text/css" media="print">
      body {
        font-size: 12pt;
      }
      .table {
        border: 2px solid #000;
      }
      .table th, .table td {
        border: 2px solid #000;
        padding: 4px;
      }
      .table thead th {
        background-color: #098744 !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
      }
      .table tbody {
        background-color: #098744 !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
      }
      .table tr {
        border: 2px solid #000;
      }
    </style>
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
    <div class="row"><h2 align="center">List Of Students Enrolled per Section</h2>
    <h4 align="center"><?php echo isset($_POST['Course']) ? "Course/Section :". $_POST['Course'] : ''; ?></h4></div>
    <!-- info row --> 
     <!-- Table row --> 
          <table class="table table-bordered" style="font-size:16px; border: 2px solid #000;" cellspacing="0">
            <thead style="background-color: #098744; color: white;">
            <tr style="border: 2px solid #000;">
              <th>Student Number</th>
              <th>Name</th> 
              <!-- <th>Address</th> -->
              <th>Sex</th> 
              <th>AGE</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Course/Section</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody style="background-color: #098744; color: white;">
            <?php
                $tot = 0; 
          
                if(isset($_POST['Course'])) {
                  // Split Course into COURSE_NAME and SECTION
                  $courseInfo = explode('-', $_POST['Course']);
                  if(count($courseInfo) >= 2) {
                    $courseName = trim($courseInfo[0]); // Remove any whitespace
                    $section = trim($courseInfo[1]); // Remove any whitespace
           
                    $sql ="SELECT * FROM course c,`tblstudent` s 
                          WHERE c.COURSE_ID=s.COURSE_ID 
                          AND c.COURSE_NAME = '{$courseName}'
                          AND s.SECTION = '{$section}'";

                    $mydb->setQuery($sql);
                    $res = $mydb->executeQuery();
                    $row_count = $mydb->num_rows($res);
                    $cur = $mydb->loadResultList();
               
                    if ($row_count > 0){
                      foreach ($cur as $result) {
                        $dbirth =  date($result->BDAY);
                        $today = date('Y-M-d'); 
              ?>
                      <tr style="border: 2px solid #000;"> 
                        <td><?php echo $result->STUDENT_NUMBER;?></td>
                        <td><?php echo $result->FNAME . ' ' .  $result->MNAME . '  ' .  $result->LNAME;?></td>
                       <!-- <td><?php echo $result->HOME_ADD;?></td> -->
                        <td><?php echo $result->SEX;?></td>
                        <td><?php echo  date_diff(date_create($dbirth),date_create($today))->y;?></td>
                        <td><?php echo $result->CONTACT_NO;?></td>
                        <td><?php echo $result->STATUS;?></td>
                        <td><?php echo $result->COURSE_NAME .'-'.$result->SECTION;?></td>
                        <td><?php echo $result->student_status;?></td>
                      </tr>
              <?php  
                         $tot =  count($cur);
                        
                      } 
                    } else {
                      echo "<tr><td colspan='9' align='center'>No students found</td></tr>";
                    }
                  } else {
                    echo "<tr><td colspan='9' align='center'>Invalid course format</td></tr>";
                  }
                } else {
                  echo "<tr><td colspan='9' align='center'>Course not provided</td></tr>";
                }
              ?>
            </tbody>
              <tfoot>
              <tr style="border: 2px solid #000;">
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
