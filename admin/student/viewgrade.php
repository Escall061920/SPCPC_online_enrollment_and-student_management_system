<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$IDNO = $_GET['id'];
    if($IDNO==''){
  redirect("index.php");
}
  $student = New Student();
  $res = $student->single_student($IDNO);
  
?>

<div class="row">
 <div class="col-lg-12">
 <div class="col-md-6">
 	<h2 ><?php echo   $res->LNAME.','. $res->FNAME.' '. $res->MNAME; ?></h2>
       <hr/>  
 </div>

 <?php 
$sql = "SELECT DISTINCT sy.COURSE_ID, c.COURSE_NAME, d.DEPARTMENT_NAME, d.DEPARTMENT_DESC 
FROM `schoolyr` sy 
JOIN `course` c ON sy.COURSE_ID = c.COURSE_ID 
JOIN `department` d ON c.DEPT_ID = d.DEPT_ID 
WHERE sy.IDNO = ".$IDNO;
$mydb->setQuery($sql);
$cur = $mydb->loadSingleResult();


$cur = $mydb->loadSingleResult(); 
 ?>
              
  </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
  	<div class="col-md-6">
  		<h4>Course/Year :<?php echo $cur->COURSE_NAME.'-'.$res->YEARLEVEL;?> </h4>
  	</div>
  	<div class="col-md-6">
  		<h4>Department :<?php echo $cur->DEPARTMENT_NAME . ' [ '. $cur->DEPARTMENT_DESC. ' ]';?> </h4>
  	</div>
  </div>
	
</div>
<div class="row">
    <div class="col-lg-3">
        <h3 class="page-header">Student Subjects</h3>
    </div>
    <!-- /.col-lg-12 -->
    <form action="controller.php?action=delete" method="POST">
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Midterms</th>
                        <th>Finals</th>
                        <th>Average</th>
                        <th>Remarks</th>
                        <th>Semester</th>
                        <th width="10%">Action</th> <!-- Ensure this is the last column -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT DISTINCT g.GRADE_ID, g.IDNO, s.SUBJ_ID, s.SUBJ_CODE, s.SUBJ_DESCRIPTION, s.UNIT, g.FIRST, g.SECOND, g.AVE, ss.SEMESTER, g.REMARKS
                            FROM `tblstudent` st 
                            JOIN `grades` g ON st.IDNO = g.IDNO
                            JOIN `subject` s ON g.SUBJ_ID = s.SUBJ_ID
                            JOIN `studentsubjects` ss ON g.IDNO = ss.IDNO AND g.SUBJ_ID = ss.SUBJ_ID
                            WHERE st.IDNO = " . $IDNO . "
                            GROUP BY g.SUBJ_ID";

                    $mydb->setQuery($sql);
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<tr>';
                        echo '<td>' . $result->SUBJ_ID . '</td>'; // Student ID
                        echo '<td>' . $result->SUBJ_CODE . '</td>'; // Subject Code
                        echo '<td>' . $result->SUBJ_DESCRIPTION . '</td>'; // Subject Description
                        echo '<td>' . $result->UNIT . '</td>'; // Unit
                        echo '<td>' . $result->FIRST . '</td>'; // Midterms
                        echo '<td>' . $result->SECOND . '</td>'; // Finals
                        echo '<td>' . $result->AVE . '</td>'; // Average
                        echo '<td>' . $result->REMARKS . '</td>'; // Remarks
                        echo '<td>' . $result->SEMESTER . '</td>'; // Semester (you may need to fetch this if it’s not in the current query)
                        echo '<td align="center"><a title="Edit" href="addmodalgrades.php?id=' . $result->SUBJ_ID . '&IDNO=' . $result->IDNO . '&gid=' . $result->GRADE_ID . '" data-toggle="lightbox"><span class="fa fa-plus fw-fa"></span> Add grades</a></td>'; // Action
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

