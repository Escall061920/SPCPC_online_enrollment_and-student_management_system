<?php
require_once("../../include/initialize.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>San Pedro City Polytechnic College</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
  <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
  <style>
    .copy-section {
      page-break-after: always;
      margin-bottom: 10px;
      position: relative;
      border: 1px dashed #000;
      padding: 10px;
      margin: 10px;
    }
    .copy-header {
      text-align: center;
      font-weight: bold;
      margin: 10px 0;
      font-size: 18px;
    }
    
    /* Cut line styles */
    .cut-line-vertical {
      border-left: 1px dashed #000;
      height: 100%;
      position: absolute;
      right: -10px;
      top: 0;
    }
    
    .cut-line-horizontal {
      border-top: 1px dashed #000;
      width: 100%;
      position: absolute;
      bottom: -10px;
      left: 0;
    }
    
    .scissors-icon {
      position: absolute;
      font-size: 16px;
      color: #666;
    }
    
    .scissors-right {
      right: -20px;
      top: 50%;
      transform: translateY(-50%);
    }
    
    .scissors-bottom {
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%) rotate(90deg);
    }
    
    /* Enhanced styles for darker table content */
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

    .dev-fee-input {
      border: none;
      border-bottom: 1px solid #000;
      width: 50px;
      text-align: right;
      outline: none;
      background: transparent;
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
      
      .cut-line-vertical,
      .cut-line-horizontal {
        border-style: dashed !important;
        border-width: 1px !important;
        border-color: #000 !important;
        -webkit-print-color-adjust: exact;
      }
      
      .scissors-icon {
        color: #666 !important;
        -webkit-print-color-adjust: exact;
      }
      
      .copy-section {
        border: 1px dashed #000 !important;
        -webkit-print-color-adjust: exact;
      }

      .dev-fee-input {
        border: none !important;
        border-bottom: 1px solid #000 !important;
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
</head>
<body onload="window.print();">

<?php
$copies = array(
    str_pad("STUDENT'S COPY", 50, " ", STR_PAD_BOTH),
    str_pad("REGISTRAR'S COPY", 50, " ", STR_PAD_BOTH), 
    str_pad("ACCOUNTANT'S COPY", 50, " ", STR_PAD_BOTH)
);

foreach($copies as $index => $copy) {
?>

<div class="wrapper copy-section"> 
    <div class="cut-line-vertical"></div>
    <div class="cut-line-horizontal"></div>
    <div class="scissors-icon scissors-right">✂</div>
    <div class="scissors-icon scissors-bottom">✂</div>
    
    <div class="col-xs-12">
        <img src="<?php echo web_root; ?>/img/SPCPC-logo.png" class="pull-left" alt="Logo" style="width: 90px; height: auto;">
    </div>
    
    <section class="invoice">
      <div class="copy-header"><?php echo $copy; ?></div>
      
      <!-- Rest of the code remains exactly the same until the assessment parts -->
      <div class="row">
        <h4 align="center">SAN PEDRO CITY POLYTECHNIC COLLEGE CERTIFICATION OF REGISTRATION</h4>
        <div align="center">San Pedro City Polytechnic College (formerly San Pedro Technological Institute), Crismor Ave, Elvinda, Laguna 4023 Tel No. (02)87777-352</div>
        
        <h3 style="text-align: center;" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Form</h3>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h4 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h4>
        </div>
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
      $stud = $student->single_student($_GET['IDNO']); 
      ?>
      <table>
        <tr>
          <td width="75%" colspan="2" >
            <address>
            <b>Name : <?php echo htmlspecialchars($stud->LNAME. ', ' .$stud->FNAME .' ' .$stud->MNAME);?></b><br>
            <b>Address : <?php echo htmlspecialchars($stud->HOME_ADD);?><br> 
            <b>Contact No.: <?php echo htmlspecialchars($stud->CONTACT_NO);?><br>
            <b>OR Number: ___________________<br>
            <b>Academic Status: <input type="radio" name="student_type" value="regular"> Regular <input type="radio" name="student_type" value="irregular"> Irregular</b>
          </address>
          </td>
          <td >
            
             <b>Course/Year:  <?php 
              $course = New Course();
              $singlecourse = $course->single_course($stud->COURSE_ID);
              echo $_SESSION['COURSE_YEAR'] = htmlspecialchars($singlecourse->COURSE_NAME.'-'.$singlecourse->COURSE_LEVEL);
              $_SESSION['COURSEID'] =$stud->COURSE_ID;
              $_SESSION['COURSELEVEL'] = $stud->YEARLEVEL;
            ?></b><br>
            <b>Section : <?php echo htmlspecialchars($stud->SECTION); ?></b><br>
            <b>Semester : <?php echo htmlspecialchars($_SESSION['SEMESTER']); ?></b> <br/>
            <b>Academic Year : <?php echo htmlspecialchars($_SESSION['SY']); ?></b> <br/>
            <b>Student No.: <div style="border: 2px solid #000; padding: 5px; display: inline-block;"><?php echo htmlspecialchars($stud->STUDENT_NUMBER); ?></div></b>
          </td>
        </tr>
      </table>
<?php 
  if (isset($_SESSION['admingvCart'])) {
?>
<div class="row">
  <div class="col-xs-12 table-responsive">
    <table class="table table-bordered">
      <thead>
     <tr>
        <th style="border: 2px solid #000;">Subject</th>
        <th style="border: 2px solid #000;">Description</th>
        <th style="border: 2px solid #000;">Unit</th>  
        <?php if ($index > 0) { // For Registrar's and Accountant's copy ?>
        <th style="text-align: center; border: 2px solid #000;"></th>  
        <th style="text-align: center; border: 2px solid #000;">ASSESSMENT</th>
        <?php } else { // For Student's copy ?>
        <th style="text-align: center; border: 2px solid #000;">ASSESSMENT</th>
        <?php } ?>
      </tr>
      </thead>
      <tbody>
      <?php  
        $totunit = 0;
        $count_cart = count($_SESSION['admingvCart']);
        for ($i=0; $i < $count_cart; $i++) {  
            $query = "SELECT * FROM `subject` s, `course` c WHERE s.COURSE_ID=c.COURSE_ID AND SUBJ_ID=" . intval($_SESSION['admingvCart'][$i]['subjectid']);
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList(); 
            foreach ($cur as $result) { 
                echo '<tr>';
                echo '<td>'. htmlspecialchars($result->SUBJ_CODE).'</td>';
                echo '<td>'. htmlspecialchars($result->SUBJ_DESCRIPTION).'</td>';
                echo '<td>' . htmlspecialchars($result->UNIT).'</td>';
                echo '</tr>';
                $totunit +=  floatval($result->UNIT); 
            }      
            
        }  
      ?>
      <tr>
        <td colspan="2" align="right">Total Units</td>
        <td><?php echo $totunit;?></td>
      </tr>
      </tbody>
     </table>
<?php
} else { 
?>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Course Code</th>
        <th>Course Description</th>
        <th>Unit</th>  
        <?php if ($index > 0) { // For Registrar's and Accountant's copy ?>
        <th style="text-align: center;"></th>
        <th style="text-align: center;">ASSESSMENT</th>
        <?php } else { // For Student's copy ?>
        <th style="text-align: center;">ASSESSMENT</th>
        <?php } ?>
      </tr>
      </thead>
      <tbody> 
      <?php 
      $totunit = 0;

      $assessment_shown = false;
      $certified_shown = false;
      $mydb->setQuery("SELECT * FROM `subject` s, `course` c 
        WHERE s.COURSE_ID=c.COURSE_ID AND s.COURSE_ID=".$_SESSION['COURSEID']." AND SEMESTER='".htmlspecialchars($_SESSION['SEMESTER'])."'");
      $cur = $mydb->loadResultList();
      foreach ($cur as $result) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($result->SUBJ_CODE).'</td>'; 
        echo '<td>'.htmlspecialchars($result->SUBJ_DESCRIPTION).'</td>';
        echo '<td>'.htmlspecialchars($result->UNIT).'</td>';
        
        if ($index == 0 && !$assessment_shown) {
          $dev_fee = isset($_GET['dev_fee']) ? (float)$_GET['dev_fee'] : 2500.00;             
          $misc_fee = 500.00;
          $total = $misc_fee + $dev_fee;
          echo '<td style="text-align: center;" rowspan="'.count($cur).'">'
               . '<div style="display: flex; justify-content: space-between;"><span>Miscellaneous</span><span>₱'.number_format($misc_fee, 2).'</span></div>'
               . '<div style="display: flex; justify-content: space-between;"><span>Development Fee</span><span>₱<input type="number" name="dev_fee" class="dev-fee-input dev-fee-sync" value="'.$dev_fee.'" data-group="1"></span></div>'
               . '<hr style="border-top: 1px solid #000;">'
               . '<div style="display: flex; justify-content: space-between;"><span><b>Total Fee</b></span><span><b>₱<span class="total_fee">'.number_format($total, 2).'</span></b></span></div><br>'
               . '<hr style="border-top: 2px solid #000;">'
               . '<div style="text-align: left;">Certified by:</div><br>'
               . '<div style="width: 200px; margin: 0 auto;"><hr style="border-top: 2px solid #000; margin: 5px 0;"></div>'
               . 'SPCPC Staff <br>'
               . '<div style="text-align: left;">(Amount paid for tuition and other fees)</div><br>'
               . '<div style="width: 150px; margin: 0 auto;"><hr style="border-top: 1px solid #000; margin: 5px 0;"></div>'
               . 'Collected by:'
               . '</td>';
          $assessment_shown = true;
        }
        
        if ($index > 0) {
          if (!$certified_shown) {
            echo '<td style="text-align: center;" rowspan="'.count($cur).'">'
                 . '<div style="text-align: left;">Certified by:</div><br>'
                 . '<div style="width: 150px; margin: 0 auto;"><hr style="border-top: 1px solid #000; margin: 5px 0;"></div>'
                 . '(SPCPC Staff)<br>'
                 . '<hr style="border-top: 2px solid #000;">'
                 . '<div style="text-align: left;">Assessed by:</div><br>'
                 . '<div style="width: 150px; margin: 0 auto;"><hr style="border-top: 1px solid #000; margin: 5px 0;"></div>'
                 . '(College Accountant)'
                 . '</td>';
            echo '<td style="text-align: center;" rowspan="'.count($cur).'">'
               . '<div style="display: flex; justify-content: space-between;"><span>Miscellaneous</span><span>₱'.number_format($misc_fee, 2).'</span></div>'
               . '<div style="display: flex; justify-content: space-between;"><span>Development Fee</span><span>₱<input type="number" name="dev_fee" class="dev-fee-input dev-fee-sync" value="'.$dev_fee.'" data-group="1"></span></div>'
               . '<hr style="border-top: 1px solid #000;">'
               . '<div style="display: flex; justify-content: space-between;"><span><b>Total Fee</b></span><span><b>₱<span class="total_fee">'.number_format($total, 2).'</span></b></span></div><br>'
               . '<hr style="border-top: 2px solid #000;">'
               . '<div style="text-align: center;">(Amount paid for tuition and other fees)</div><br>'
               . '<div style="width: 200px; margin: 0 auto;"><hr style="border-top: 2px solid #000; margin: 5px 0;"></div>'
               . 'Collected by:'
               . '</td>';
            $certified_shown = true;
          }
        }
        
        echo '</tr>';
        $totunit +=  floatval($result->UNIT);
      }
      ?>
      <tr>
        <td colspan="2" align="right">Total Units</td>
        <td><?php echo $totunit;?></td>
        <td></td>
        <?php if ($index > 0) { // Only show for Registrar's and Accountant's copy ?>
        <td></td>
        <?php } ?>
      </tr>
      </tbody>
    </table>
<?php
}
?>
    </section>
</div>

<?php
} // End foreach copy
?>

</body>
</html>
<?php
unset($_SESSION['COURSEID']);
unset($_SESSION['COURSELEVEL']); 
unset($_SESSION['SEMESTER']);
unset($_SESSION['SY']); 
unset($_SESSION['admingvCart']);
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Get all dev fee inputs with the sync class
  const devFeeInputs = document.querySelectorAll('.dev-fee-sync');
  
  devFeeInputs.forEach(input => {
    input.addEventListener('input', function() {
      const misc = 500;
      const dev = parseFloat(this.value) || 0;
      const total = misc + dev;
      
      // Update all dev fee inputs with the same value
      devFeeInputs.forEach(otherInput => {
        otherInput.value = this.value;
      });
      
      // Update all total fee displays
      const totalElements = document.querySelectorAll('.total_fee');
      totalElements.forEach(element => {
        element.textContent = total.toFixed(2);
      });
    });
  });
});
</script>