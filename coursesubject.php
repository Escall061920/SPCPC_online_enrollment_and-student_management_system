<?php

if (isset($_POST['btnCartSubmit'])) {
    $query = "SELECT DISTINCT * FROM tblstudent s, course c WHERE s.COURSE_ID = c.COURSE_ID AND IDNO = " . $_SESSION['IDNO'];
    $result = mysqli_query($mydb->conn, $query) or die(mysqli_error($mydb->conn));
    $row = mysqli_fetch_assoc($result);

    $sql = "SELECT DISTINCT SUM(UNIT) AS 'Unit' FROM subject WHERE COURSE_ID = " . $row['COURSE_ID'] . " AND SEMESTER = '" . $_SESSION['SEMESTER'] . "'";
    $result = mysqli_query($mydb->conn, $sql) or die(mysqli_error($mydb->conn));
    $totunits = mysqli_fetch_assoc($result);

    // Echo $totunits['Unit']; 
    // units to be taken
    $totunit = 0;

    $query = "SELECT DISTINCT * FROM tblstudent s, course c WHERE s.COURSE_ID = c.COURSE_ID AND IDNO = " . $_SESSION['IDNO'];
    $result = mysqli_query($mydb->conn, $query) or die(mysqli_error($mydb->conn));
    $row = mysqli_fetch_assoc($result);

    $query = "SELECT DISTINCT *
              FROM subject s, course c WHERE s.COURSE_ID = c.COURSE_ID
              AND COURSE_NAME = '" . $row['COURSE_NAME'] . "' AND COURSE_LEVEL = " . $row['YEARLEVEL'] . "
              AND SEMESTER = '" . $_SESSION['SEMESTER'] . "' AND
              NOT FIND_IN_SET(`PRE_REQUISITE`, (
                  SELECT GROUP_CONCAT(SUBJ_CODE SEPARATOR ',') FROM tblstudent s, grades g, subject sub
                  WHERE s.IDNO = g.IDNO AND g.SUBJ_ID = sub.SUBJ_ID AND AVE <= 74.5 
                  AND s.IDNO = " . $_SESSION['IDNO'] . ")
              )";

    $mydb->setQuery($query);
    $cur = $mydb->loadResultList(); 
    foreach ($cur as $result) {  
        $totunit += $result->UNIT;
    }

    if (isset($_SESSION['gvCart'])) { 
        $count_cart = count($_SESSION['gvCart']);

        for ($i = 0; $i < $count_cart; $i++) {  
            $query = "SELECT DISTINCT * FROM subject s, course c 
                      WHERE s.COURSE_ID = c.COURSE_ID AND SUBJ_ID = " . $_SESSION['gvCart'][$i]['subjectid'];
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList(); 
            foreach ($cur as $result) {   
                $totunit += $result->UNIT;
            }  
        }
    }

    if ($totunit > $totunits['Unit']) {
        message("Warning....! Your total units have exceeded, " . $totunits['Unit'] . " units are only allowed to be taken.", "error");
        redirect("index.php?q=cart"); 
    } 
}

// The rest of your code remains unchanged
?>

<form action="index.php?q=payment" method="POST">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <?php //check_message(); ?> 
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header">
                    <i class="fa fa-user"></i> Student Information
                    <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
                </h3>
            </div>
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-8 invoice-col"> 
                <address>
                    <b>Name: <?php echo $_SESSION['LNAME'] . ', ' . $_SESSION['FNAME'] . ' ' . $_SESSION['MI']; ?></b><br>
                    Address: <?php echo $_SESSION['PADDRESS']; ?><br> 
                    Contact No.: <?php echo $_SESSION['CONTACT']; ?><br>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Course/Year: <?php 
                    $course = new Course();
                    $singlecourse = $course->single_course($_SESSION['COURSEID']);
                    $_SESSION['Course_name'] = $singlecourse->COURSE_NAME;

                    if (isset($_SESSION['STUDID'])) {
                        $_SESSION['COURSELEVEL'] = $singlecourse->COURSE_LEVEL;
                    } elseif (isset($_SESSION['IDNO'])) {
                        $stud = new Student();
                        $singleStud = $stud->single_student($_SESSION['IDNO']);
                        $_SESSION['COURSELEVEL'] = $singleStud->YEARLEVEL;
                    }

                    echo $_SESSION['COURSE_YEAR'] = $singlecourse->COURSE_NAME . '-' . $_SESSION['COURSELEVEL'];
                ?></b><br>
                <b>Semester: <?php echo $_SESSION['SEMESTER']; ?></b><br/>
                <b>Academic Year: <?php echo $_SESSION['SY']; ?></b>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header">
                    <i class="fa fa-book"></i> List of Subjects
                </h3>
            </div>
        </div>
 
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr> 
                            <th>Id</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Unit</th>  
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    $query = "SELECT DISTINCT * FROM tblstudent s, course c WHERE s.COURSE_ID = c.COURSE_ID AND IDNO = " . $_SESSION['IDNO'];
                    $result = mysqli_query($mydb->conn, $query) or die(mysqli_error($mydb->conn));
                    $row = mysqli_fetch_assoc($result);

                    if ($row['student_status'] == 'Irregular') {
                        $totunit = 0;

                        $query = "SELECT DISTINCT *
                                  FROM subject s, course c WHERE s.COURSE_ID = c.COURSE_ID
                                  AND COURSE_NAME = '" . $row['COURSE_NAME'] . "' AND COURSE_LEVEL = " . $row['YEARLEVEL'] . "
                                  AND SEMESTER = '" . $_SESSION['SEMESTER'] . "' AND
                                  NOT FIND_IN_SET(`PRE_REQUISITE`, (
                                      SELECT GROUP_CONCAT(SUBJ_CODE SEPARATOR ',') FROM tblstudent s, grades g, subject sub
                                      WHERE s.IDNO = g.IDNO AND g.SUBJ_ID = sub.SUBJ_ID AND AVE <= 74.5 
                                      AND s.IDNO = " . $_SESSION['IDNO'] . ")
                                  )";

                        $mydb->setQuery($query);
                        $cur = $mydb->loadResultList(); 
                        foreach ($cur as $result) { 
                            echo '<tr>';
                            echo '<td>' . $result->SUBJ_ID . '</td>';
                            echo '<td>' . $result->SUBJ_CODE . '</td>';
                            echo '<td>' . $result->SUBJ_DESCRIPTION . '</td>';
                            echo '<td>' . $result->UNIT . '</td>';
                            echo '</tr>';
                            $totunit += $result->UNIT;
                        }

                        if (isset($_SESSION['gvCart'])) {
                            $count_cart = count($_SESSION['gvCart']);

                            for ($i = 0; $i < $count_cart; $i++) {  
                                $query = "SELECT DISTINCT * FROM subject s, course c WHERE s.COURSE_ID = c.COURSE_ID AND SUBJ_ID = " . $_SESSION['gvCart'][$i]['subjectid'];
                                $mydb->setQuery($query);
                                $cur = $mydb->loadResultList(); 
                                foreach ($cur as $result) { 
                                    echo '<tr>';
                                    echo '<td>' . $result->SUBJ_ID . '</td>';
                                    echo '<td>' . $result->SUBJ_CODE . '</td>';
                                    echo '<td>' . $result->SUBJ_DESCRIPTION . '</td>';
                                    echo '<td>' . $result->UNIT . '</td>';
                                    echo '</tr>';
                                    $totunit += $result->UNIT; 
                                }  
                            }  
                        } 

                    } else {
                        $totunit = '';
                        $mydb->setQuery("SELECT DISTINCT * FROM subject s, course c 
                                         WHERE s.COURSE_ID = c.COURSE_ID AND CONCAT(`COURSE_NAME`, '-', `COURSE_LEVEL`) = '" . $_SESSION['COURSE_YEAR'] . "' AND SEMESTER = '" . $_SESSION['SEMESTER'] . "'");

                        $cur = $mydb->loadResultList();

                        foreach ($cur as $result) {
                            echo '<tr>';
                            echo '<td>' . $result->SUBJ_ID . '</td>';
                            echo '<td>' . $result->SUBJ_CODE . '</td>';
                            echo '<td>' . $result->SUBJ_DESCRIPTION . '</td>';
                            echo '<td>' . $result->UNIT . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
        <div class="row no-print">
        <div class="col-xs-9">
          <a href="statementaccnt.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <a href="index.php?q=profile" target="_blank" class="btn btn-default"><i class="fa fa-user"></i> Go to your profile</a>
         <!--  <button type="hidden" name="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button> -->
      </div>
     
         </form>
         <?php
         

         ?>
       
         
          <?php

          ?>
        </div>
      </div>
    </section> 
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<!--  "
