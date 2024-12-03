<?php  
if (!isset($_SESSION['IDNO'])) {
    redirect("index.php");
}

$student = new Student();
$res = $student->single_student($_SESSION['IDNO']);

$course = new Course();
$resCourse = $course->single_course($res->COURSE_ID);
?>

<style type="text/css">
    #img_profile {
        width: 100%;
        height: auto;
    }
    #img_profile > a > img {
        width: 100%;
        height: auto;
    }

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

<div class="col-sm-3">
    <div class="panel">            
        <div id="img_profile" class="panel-body">
            <a href="" data-target="#myModal" data-toggle="modal">
                <img title="profile image" class="img-hover" src="<?php echo web_root . 'student/' . $res->STUDPHOTO; ?>">
            </a>
        </div>
        <ul class="list-group">
            <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> <?php echo $res->FNAME . ' ' . $res->LNAME; ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Course</strong></span> <?php echo $resCourse->COURSE_NAME . '-' . $resCourse->COURSE_LEVEL; ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Status</strong></span> <?php echo $res->student_status; ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Section</strong></span> <?php echo $res->SECTION; ?></li>
        </ul> 
    </div>
</div>

<div class="col-sm-9"> 
    <div class="panel">            
        <div class="panel-body">
            <?php
            check_message();   
            ?>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#home" data-toggle="tab">List of Subjects</a></li> 
                <li><a href="#grades" data-toggle="tab">Grades</a></li>
                <?php 
                if ($res->student_status == 'Irregular' || ($res->student_status == 'Transferee' && $res->NewEnrollees == 0)) {
                    
                }
                ?>
            </ul>
              
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <br/>
                    <div class="col-md-12">
                        <h3>Enrolled Subjects</h3> 
                    </div>
                    <div class="table-responsive" style="margin-top:5%;"> 
                        <form action="customer/controller.php?action=delete" method="POST">  					
                            <table class="table table-bordered table-hover" style="font-size:12px" cellspacing="0"> 
                                <thead>
                                    <tr> 
                                        <th rowspan="2">Course Code</th>
                                        <th rowspan="2">Course Description</th>  
                                        <th rowspan="2">Unit</th>
                                        <th colspan="4">Schedule</th> 
                                    </tr>	
                                    <tr> 
                                        <th>Day</th> 
                                        <th>Time</th>
                                        <th>Room</th> 
                                    
                                    </tr>
                                </thead> 	 
                                <tbody>
                                    <?php
                                    // Define day order array
                                    $day_order = array(
                                        "Monday" => 1,
                                        "Tuesday" => 2, 
                                        "Wednesday" => 3,
                                        "Thursday" => 4,
                                        "Friday" => 5,
                                        "Saturday" => 6,
                                        "Sunday" => 7
                                    );

                                    // Revised SQL query to retrieve subjects
                                    $sql = "SELECT DISTINCT sub.SUBJ_ID, sub.SUBJ_CODE, sub.SUBJ_DESCRIPTION, sub.UNIT, 
                                    s.sched_day, s.sched_time, s.sched_room, s.SECTION
                           FROM tblstudent st
                           JOIN studentsubjects ss ON st.IDNO = ss.IDNO
                           JOIN subject sub ON ss.SUBJ_ID = sub.SUBJ_ID
                           JOIN tblschedule s ON sub.SUBJ_ID = s.SUBJ_ID
                           WHERE ss.IDNO = " . $_SESSION['IDNO'] . "
                             AND s.SECTION = '" . $res->SECTION . "'
                             AND s.COURSE_ID = '" . $res->COURSE_ID . "' 
                             AND s.sched_semester = '" . $_SESSION['SEMESTER'] . "'";
                   
                                    
                                    $mydb->setQuery($sql);
                                    $cur = $mydb->loadResultList();

                                    if (empty($cur)) {
                                        echo '<tr><td colspan="7">No subjects found.</td></tr>';
                                    } else {
                                        // Sort results by day and time
                                        usort($cur, function($a, $b) use ($day_order) {
                                            // First sort by day
                                            $day_a = $day_order[$a->sched_day] ?? 0;
                                            $day_b = $day_order[$b->sched_day] ?? 0;
                                            if ($day_a !== $day_b) {
                                                return $day_a - $day_b;
                                            }
                                            
                                            // Then sort by time, prioritizing AM over PM
                                            $time_a = strtotime(trim(explode('-', $a->sched_time)[0]));
                                            $time_b = strtotime(trim(explode('-', $b->sched_time)[0]));
                                            
                                            $a_is_am = date('A', $time_a) == 'AM';
                                            $b_is_am = date('A', $time_b) == 'AM';
                                            
                                            if ($a_is_am && !$b_is_am) return -1;
                                            if (!$a_is_am && $b_is_am) return 1;
                                            
                                            return $time_a - $time_b;
                                        });

                                        foreach ($cur as $result) {
                                            // Format time to 12-hour format
                                            $times = explode('-', $result->sched_time);
                                            $start_time = date("h:i A", strtotime(trim($times[0])));
                                            $end_time = date("h:i A", strtotime(trim($times[1])));
                                            $formatted_time = $start_time . ' - ' . $end_time;

                                            echo '<tr>'; 
                                            echo '<td>' . $result->SUBJ_CODE . '</td>';
                                            echo '<td>' . $result->SUBJ_DESCRIPTION . '</td>';
                                            echo '<td>' . $result->UNIT . '</td>';
                                            echo '<td>' . $result->sched_day . '</td>';
                                            echo '<td>' . $formatted_time . '</td>';
                                            echo '<td>' . $result->sched_room . '</td>';
                                       
                                            echo '</tr>';
                                        }
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </form>
                        <form action="student/printschedule.php" method="POST" target="_blank">
                            <input type="hidden" name="Course" value="<?php echo $resCourse->COURSE_LEVEL; ?>">
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <span class="pull-right"> <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></span>  
                                </div>
                            </div> 
                        </form>       
                    </div><!--/table-resp-->
                </div><!--/tab-pane-->

                <div class="tab-pane" id="grades">
                    <?php require_once("studentgrades.php"); ?>
                </div>

                <div class="tab-pane" id="adddrop">
                    <?php // require_once("changingdropping.php"); ?>
                </div>

                <div class="tab-pane" id="settings">
                    <?php require_once("updateyearlevel.php"); ?>
                </div><!--/tab-pane-->
            </div><!--/tab-content-->
        </div><!--/panel-body-->
    </div><!--/panel-->
</div><!--/col-9--> 

<!-- Modal for photo upload -->
<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">×</button>
                <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
            </div>
            <form action="student/controller.php?action=photos" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <div class="rows">
                                    <div class="col-md-8">
                                        <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> 
                                        <input id="photo" name="photo" type="file">
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button> 
                    <button class="btn btn-primary" name="savephoto" type="submit">Upload Photo</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
