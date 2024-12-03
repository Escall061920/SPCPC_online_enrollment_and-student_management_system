<?php

if (!isset($_GET['IDNO'])) {
   redirect("index.php");
}
$sem = new Semester();
$resSem = $sem->single_semester();
$_SESSION['SEMESTER'] = $resSem->SEMESTER;

$currentyear = date('Y');
$nextyear =  date('Y') + 1;
$sy = $currentyear . '-' . $nextyear;
$_SESSION['SY'] = $sy;

$student = new Student();
$studres = $student->single_student($_GET['IDNO']);
?>
<form action="index.php?q=payment" method="POST">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container">
 <!-- Main content -->
 <?php // check_message(); ?> 
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
              <img src="<?php echo web_root; ?>img/SPCPC-logo.png" alt="SPCPC_logo.png" style="height: 50px; margin-right: 10px;">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-7 invoice-col"> 
          <address>
            <b>Name : <?php echo htmlspecialchars($studres->LNAME) . ', ' . htmlspecialchars($studres->FNAME) . ' ' . htmlspecialchars($studres->MNAME); ?></b><br>
            <b>Address : <?php echo htmlspecialchars($studres->HOME_ADD); ?></b><br>
            <b>Contact No.: <?php echo htmlspecialchars($studres->CONTACT_NO); ?></b><br>
            <b>OR Number: ___________________</b><br>
            <b>Academic Status: 
            <input type="checkbox" name="student_type" value="regular"> Regular
            <input type="checkbox" name="student_type" value="irregular"> Irregular
            </b>
          </address>
        </div>
    
        <div class="col-sm-5 invoice-col">
          <b>Course/Year:  <?php 
            $course = new Course();
            $singlecourse = $course->single_course($studres->COURSE_ID); 

            $course_year = htmlspecialchars($singlecourse->COURSE_NAME . '-' . $studres->YEARLEVEL);
            echo $_SESSION['COURSE_YEAR'] = $course_year;
            ?></b><br>
          <b>Section : <?php echo htmlspecialchars($studres->SECTION); ?></b><br>
          <b>Semester : <?php echo htmlspecialchars($_SESSION['SEMESTER']); ?></b> <br/>
          <b>Academic Year : <?php echo htmlspecialchars($_SESSION['SY']); ?></b> <br/>
          <b>Student No.: <div style="border: 2px solid #000; padding: 5px; display: inline-block;"><?php echo htmlspecialchars($studres->STUDENT_NUMBER); ?></div></b><br/>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <i class="fa fa-book"></i> List of Subjects
          </h3>
        </div>
        <!-- /.col -->
      </div>

<?php 
if (isset($_SESSION['admingvCart'])){
?>
<!-- Table row -->
<div class="row">
  <div class="col-xs-12 table-responsive">
    <table class="table table-bordered" style="border: 2px solid #000;">
      <thead>
      <tr>
        <th style="border: 2px solid #000;">Subject</th>
        <th style="border: 2px solid #000;">Description</th>
        <th style="border: 2px solid #000;">Unit</th>  
        <th style="text-align: center; border: 2px solid #000;">ASSESSMENT</th>  
      </tr>
      </thead>
      <tbody>
      <?php  
        $totunit = 0;
        $assessment_shown = false;
        if (isset($_SESSION['admingvCart'])){
            $count_cart = count($_SESSION['admingvCart']);

            for ($i = 0; $i < $count_cart; $i++) {  
                $query = "SELECT * FROM `subject` s, `course` c WHERE s.COURSE_ID=c.COURSE_ID AND SUBJ_ID=" . intval($_SESSION['admingvCart'][$i]['subjectid']);
                $mydb->setQuery($query);
                $cur = $mydb->loadResultList(); 
                foreach ($cur as $result) { 
                    echo '<tr>';
                    echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->SUBJ_CODE) . '</td>';
                    echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->SUBJ_DESCRIPTION) . '</td>';
                    echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->UNIT) . '</td>';
                    if (!$assessment_shown) {
                      echo '<td style="text-align: center;" rowspan="'.$count_cart.'">'
                           . '<div style="display: flex; justify-content: space-between;"><span>Miscellaneous</span><span>₱500.00</span></div>'
                           . '<div style="display: flex; justify-content: space-between;"><span>Development Fee</span><span>₱<input type="number" name="dev_fee" value="2500.00" style="width: 100px; text-align: right;" class="no-print"></span></div>'
                           . '<hr style="border-top: 1px solid #000;">'
                           . '<div style="display: flex; justify-content: space-between;"><span><b>Total Fee</b></span><span><b>₱<span id="total_fee">3,000.00</span></b></span></div><br>'
                           . '<hr style="border-top: 2px solid #000;">'
                           . '<div style="text-align: left;">Certified by:</div><br>'
                           . '<div style="width: 200px; margin: 0 auto;"><hr style="border-top: 2px solid #000; margin: 5px 0;"></div>'
                           . 'SPCPC Staff'
                           . '</td>';
                      $assessment_shown = true;
                    }
                    echo '</tr>';

                    $totunit += floatval($result->UNIT);
                }  
            }  
        } 
      ?>
      <tr>
        <td colspan="2" align="right" style="border: 2px solid #000;">Total Units</td>
        <td style="border: 2px solid #000;"><?php echo $totunit; ?></td>
      </tr>
      </tbody>
     </table>  
<?php
} else { 
?>
<!-- Table row -->
<div class="row">
  <div class="col-xs-12 table-responsive">
    <table class="table table-bordered" style="border: 2px solid #000;">
      <thead>
      <tr>
        <th style="border: 2px solid #000;">Subject</th>
        <th style="border: 2px solid #000;">Description</th>
        <th style="border: 2px solid #000;">Unit</th>  
        <th style="text-align: center; border: 2px solid #000;">ASSESSMENT</th>  
      </tr>
      </thead>
      <tbody> 
      <?php 
       $totunit = 0;
       $assessment_shown = false;
       $mydb->setQuery("SELECT * FROM `subject` s, `course` c WHERE s.COURSE_ID=c.COURSE_ID AND CONCAT(`COURSE_NAME`, '-', `COURSE_LEVEL`) ='" . htmlspecialchars($_SESSION['COURSE_YEAR']) . "' AND SEMESTER='" . htmlspecialchars($_SESSION['SEMESTER']) . "'");
       $cur = $mydb->loadResultList();

       foreach ($cur as $result) {
         echo '<tr>';
         echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->SUBJ_CODE) . '</td>'; 
         echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->SUBJ_DESCRIPTION) . '</td>';
         echo '<td style="border: 2px solid #000;">' . htmlspecialchars($result->UNIT) . '</td>';
         if (!$assessment_shown) {
          echo '<td style="text-align: center;" rowspan="'.count($cur).'">'
               . '<div style="display: flex; justify-content: space-between;"><span>Miscellaneous</span><span>₱500.00</span></div>'
               . '<div style="display: flex; justify-content: space-between;"><span>Development Fee</span><span>₱<input type="number" name="dev_fee" value="2500.00" style="width: 100px; text-align: right;" class="no-print"></span></div>'
               . '<hr style="border-top: 1px solid #000;">'
               . '<div style="display: flex; justify-content: space-between;"><span><b>Total Fee</b></span><span><b>₱<span id="total_fee">3,000.00</span></b></span></div><br>'
               . '<hr style="border-top: 2px solid #000;">'
               . '<div style="text-align: left;">Certified by:</div><br>'
               . '<div style="width: 200px; margin: 0 auto;"><hr style="border-top: 2px solid #000; margin: 5px 0;"></div>'
               . 'SPCPC Staff'
               . '</td>';
          $assessment_shown = true;
        }
         echo '</tr>';

         $totunit += floatval($result->UNIT);
       }
      ?>
      <tr>
      <td colspan="2" align="right" style="border: 2px solid #000;">Total Units</td>
      <td style="border: 2px solid #000;"><?php echo $totunit; ?></td>
      </tr> 
      </tbody>
    </table>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<?php
}
?>
   
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-9">
          <a href="statementaccnt.php?IDNO=<?php echo htmlspecialchars($_GET['IDNO']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section> 
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
 <?php
  unset($_SESSION['SEMESTER']);
  unset($_SESSION['SY']);
  // unset($_SESSION['admingvCart']);
 ?>

<style>
@media print {
  .no-print {
    border: none;
    background: transparent;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('input[name="dev_fee"]').forEach(input => {
    input.addEventListener('input', function() {
      const misc = 500;
      const dev = parseFloat(this.value) || 0;
      const total = misc + dev;
      const totalElements = document.querySelectorAll('#total_fee');
      totalElements.forEach(element => {
        element.textContent = total.toFixed(2);
      });
    });
  });
});
</script>