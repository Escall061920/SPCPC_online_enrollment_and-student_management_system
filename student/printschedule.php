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
          <b>Academic Year : <?php echo $_SESSION['SY']; ?></b> <br/>
          <b>Section : <?php echo $stud->SECTION; ?></b>
          </td>
        </tr>
      </table>

  <div class="row">
    <h1  align="center">Schedules</h1>
    <hr/>
  </div>
                    <table  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0"  > 
                      <thead>
                        <tr> 
                          <th rowspan="2">Subject</th>
                          <th rowspan="2">Description</th>  
                          <th rowspan="2">Unit</th>
                          <th colspan="5">Schedule</th> 
                        </tr> 
                        <tr> 
                          <th>Day</th> 
                          <th>Time</th>
                          <th>Room</th> 
                        
                          <th>Instructor</th> 
                        </tr>
                      </thead>   
                    <tbody>
                    <?php
                    $tot = 0;
                      $sql ="SELECT * 
                          FROM  tblstudent st, studentsubjects ss, `subject` sub, `tblschedule` s, tblinstructor i
                          WHERE  st.IDNO=ss.IDNO AND ss.`SUBJ_ID` = sub.`SUBJ_ID` AND sub.`SUBJ_ID` = s.`SUBJ_ID`
                          AND s.INST_ID=i.INST_ID AND st.SECTION=s.SECTION AND OUTCOME !='Drop'  
                          AND ss.`IDNO`=" .$_SESSION['IDNO']." 
                          AND s.sched_semester = '".$_SESSION['SEMESTER']."' AND LEVEL='".$_POST['Course']."'
                          ORDER BY FIELD(s.sched_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";

                      $mydb->setQuery($sql);
                      $cur = $mydb->loadResultList();

                      // Sort the results by day and time
                      usort($cur, function($a, $b) {
                          // First compare days
                          $days = array('Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6);
                          $day_compare = $days[$a->sched_day] - $days[$b->sched_day];
                          
                          if ($day_compare !== 0) {
                              return $day_compare;
                          }
                          
                          // If same day, compare times
                          $a_time = explode('-', $a->sched_time)[0];
                          $b_time = explode('-', $b->sched_time)[0];
                          
                          return strtotime(trim($a_time)) - strtotime(trim($b_time));
                      });

                      foreach ($cur as $result) {
                        echo '<tr>'; 
                        echo '<td>'.$result->SUBJ_CODE.'</td>';
                        echo '<td>'.$result->SUBJ_DESCRIPTION.'</td>';
                        echo '<td>'.$result->UNIT.'</td>';
                        echo '<td>'.$result->sched_day.'</td>';
                        
                        // Format time to 12-hour format
                        $times = explode('-', $result->sched_time);
                        $start_time = strtotime(trim($times[0]));
                        $end_time = strtotime(trim($times[1]));
                        
                        // Convert to 12-hour format
                        $start_format = date("h:i A", $start_time); 
                        $end_format = date("h:i A", $end_time);
                        $formatted_time = $start_format . ' - ' . $end_format;
                        
                        echo '<td>'.$formatted_time.'</td>';
                        echo '<td>'.$result->sched_room.'</td>';
                        echo '<td>'.$result->INST_NAME.'</td>';
                      
                        echo '</tr>';

                        $tot += $result->UNIT;
                      }
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