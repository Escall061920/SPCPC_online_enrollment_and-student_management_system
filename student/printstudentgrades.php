<?php 
require_once ("../include/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>San Pedro City Polytechnic College</title>

     <!-- Bootstrap Core CSS -->
 <link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>css/modern.css" rel="stylesheet">
 <link href="<?php echo web_root; ?>css/costum.css" rel="stylesheet">

 <style>
  .table-bordered {
      border: 3px solid #000 !important;
    }
    
    .table-bordered > thead > tr > th {
      font-weight: 900 !important;
      color: #000 !important;
      border: 2px solid #000 !important;
      background-color: #fff !important;
      -webkit-print-color-adjust: exact;
    }
    
    .table-bordered > tbody > tr > td {
      font-weight: normal !important;
      color: #000 !important;
      border: 2px solid #000 !important;
      background-color: #fff !important;
      -webkit-print-color-adjust: exact;
    }

    @media print {
      .table-bordered > thead > tr > th {
        font-weight: 900 !important;
        color: #000 !important;
        border: 2px solid #000 !important;
        background-color: #fff !important;
        -webkit-print-color-adjust: exact;
      }
      
      .table-bordered > tbody > tr > td {
        font-weight: normal !important;
        color: #000 !important;
        border: 2px solid #000 !important;
        background-color: #fff !important;
        -webkit-print-color-adjust: exact;
      }
    }
 </style>
  <body onload="window.print();">

  

  <div class="row">
        <div class="col-xs-12">
          <h4 class="page-header">
          <img src="<?php echo web_root; ?>img/SPCPC-logo.png" alt="SPCPC_logo.png" style="height: 50px; margin-right: 10px;">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h4>
        </div>
        <!-- /.col -->
      </div> 
      <?php
      $sem = new Semester();
      $resSem = $sem->single_semester();
      $_SESSION['SEMESTER'] = $resSem->SEMESTER; 


      $currentyear = date('Y');
      $nextyear =  date('Y') + 1;
      $sy = $currentyear .'-'.$nextyear;
      $_SESSION['SY'] = $sy;


      $student = New Student();
      $stud = $student->single_student($_SESSION['IDNO']);

      ?>
      <table>
        <tr>
          <td width="75%" colspan="2" >
            <address>
            <b>Name : <?php echo $stud->LNAME. ', ' .$stud->FNAME .' ' .$stud->MNAME;?></b><br>
            Address : <?php echo $stud->HOME_ADD;?><br> 
            Contact No.: <?php echo $stud->CONTACT_NO;?><br>
            
          </address>
          </td>
          <td >
             <b>Course/Year:  
              
              <?php 

            $course = New Course();
            $singlecourse = $course->single_course($stud->COURSE_ID);
            echo $_SESSION['COURSE_YEAR'] = $singlecourse->COURSE_NAME.'-'.$singlecourse->COURSE_LEVEL;
            $_SESSION['COURSEID'] =$stud->COURSE_ID;
            $_SESSION['COURSELEVEL'] = $stud->YEARLEVEL;
            ?></b><br>
          <b>Semester : <?php echo $_SESSION['SEMESTER']; ?></b> <br/>
          <b>Academic Year : <?php echo $_SESSION['SY']; ?></b>
          </td>
        </tr>
      </table>

  <div class="row">
    <h1  align="center">Student Subjects</h1>
    <hr/>
  </div>
                    <table  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0"  > 
                    <thead>
				  	<tr>
				  	<th>#</th>
				  		 <th>
				  		  Subject</th>
				  		<th>Description</th> 
				  		<th>Unit</th> 
				  		<th>Average</th>
				  		<th>Remarks</th>
				  		<th>Year Level</th>
				  		<th>Semester</th> 
				 
				  	</tr>	
				  </thead>   
                  <tbody>
<?php
$tot = 0;
$counter = 1; // Initialize counter

$sql = "SELECT DISTINCT * 
        FROM `tblstudent` st, `grades` g, `subject` s, `studentsubjects` ss
        WHERE st.`IDNO` = g.`IDNO` 
        AND g.`SUBJ_ID` = s.`SUBJ_ID` 
        AND s.`SUBJ_ID` = ss.`SUBJ_ID` 
        AND g.`IDNO` = ss.`IDNO` 
        AND g.`REMARKS` NOT IN ('Drop') 
        AND st.`IDNO` = ".$_SESSION['IDNO'];

$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

foreach ($cur as $result) {
    switch ($result->LEVEL) {
        case 1:
            $Level = 'First Year';
            break;
        case 2:
            $Level = 'Second Year';
            break;
        case 3:
            $Level = 'Third Year';
            break;
        case 4:
            $Level = 'Fourth Year';
            break;
        default:
            $Level = 'First Year';
            break;
    }

    $tot += $result->UNIT; // Accumulate units

    echo '<tr>';
    echo '<td>' . $counter++ . '</td>';
    echo '<td>'. $result->SUBJ_CODE.'</td>';
    echo '<td>'. $result->SUBJ_DESCRIPTION.'</td>';
    echo '<td>' . $result->UNIT.'</td>';
    echo '<td>'. $result->AVE.'</td>';
    echo '<td>'. $result->REMARKS.'</td>';
    echo '<td>'. $Level.'</td>';
    echo '<td>'. $result->SEMESTER.'</td>';
    echo '</tr>';
}

// After the loop, display the total units
echo '<tr>';
echo '<td colspan="3" align="right"><strong>Total Units</strong></td>';
echo '<td colspan="5">' . $tot . '</td>';
echo '</tr>';
?>
</tbody>

                      <footer>
                        <tr>
                        <td colspan="2" align="right">Total Units</td>
                          <td colspan="6" ><?php echo $tot; ?></td>
                        </tr>     
                      </footer>
                      
                    </table>
                      
  </body>
</html>