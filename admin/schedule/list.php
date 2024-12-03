<?php
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <h1 class="page-header">List of Schedule  
                <a href="index.php?view=add" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus-circle fw-fa"></i> Set New Schedule
                </a>  
            </h1>
        </div>
        <div class="col-lg-6">
            <img style="float:right;" src="<?php echo web_root; ?>img/spcpc_seal_100x100.jpg">
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form action="controller.php?action=delete" method="POST">  
    <div class="table-responsive">			
        <table id="dash-table" class="table table-bordered table-responsive" style="font-size:15px" cellspacing="0">
            <thead style="background-color: #098744; color: white;">
                <tr>
                    <th>Time</th>
                    <th>Days</th> 
                    <th>Subject</th>
                    <th>Semester</th>
                    <th>School Year</th>
                    <th>Course and Year</th>
                    <th>Section</th>
                    <th>Room</th>
                    <th>Instructor</th>
                    <th width="10%" style="text-align:center">Action</th>
                </tr>	
            </thead> 
            <tbody style="background-color: #098744; color: white;">
                <?php 
                // Define the order of days
                $day_order = array(
                    "Monday"    => 1,
                    "Tuesday"   => 2,
                    "Wednesday" => 3,
                    "Thursday"  => 4,
                    "Friday"    => 5,
                    "Saturday"  => 6,
                    "Sunday"    => 7
                );

                // Fetch the schedule records from the database
                $sql = "SELECT * FROM tblinstructor i, `tblschedule` s, `course` c, subject subj 
                        WHERE i.INST_ID = s.INST_ID AND s.`COURSE_ID` = c.`COURSE_ID` AND s.SUBJ_ID = subj.SUBJ_ID";
                $mydb->setQuery($sql);
                $cur = $mydb->loadResultList();

                // Create an array to store schedules by day
                $schedules_by_day = array();
                foreach($day_order as $day => $order) {
                    $schedules_by_day[$day] = array();
                }

                // Group schedules by day
                foreach($cur as $schedule) {
                    $schedules_by_day[$schedule->sched_day][] = $schedule;
                }

                // Sort each day's schedules by time
                foreach($schedules_by_day as $day => &$day_schedules) {
                    usort($day_schedules, function($a, $b) {
                        $a_time = strtotime(trim(explode('-', $a->sched_time)[0]));
                        $b_time = strtotime(trim(explode('-', $b->sched_time)[0]));
                        
                        // Get AM/PM for both times
                        $a_is_am = date('A', $a_time) == 'AM';
                        $b_is_am = date('A', $b_time) == 'AM';
                        
                        // If one is AM and other is PM, AM comes first
                        if ($a_is_am && !$b_is_am) return -1;
                        if (!$a_is_am && $b_is_am) return 1;
                        
                        // If both are AM or both are PM, sort by actual time
                        return $a_time - $b_time;
                    });
                }

                // Display schedules day by day
                foreach($day_order as $day => $order) {
                    foreach($schedules_by_day[$day] as $result) {
                        // Convert time format to 12-hour format
                        $time_parts = explode('-', $result->sched_time);
                        $start_time = date("g:i A", strtotime(trim($time_parts[0])));
                        $end_time = date("g:i A", strtotime(trim($time_parts[1])));
                        $formatted_time = $start_time . ' - ' . $end_time;

                        echo '<tr>';
                        echo '<td>' . $formatted_time . '</td>';
                        echo '<td>' . $day . '</td>';
                        echo '<td>' . $result->SUBJ_CODE . '</td>';
                        echo '<td>' . $result->sched_semester . '</td>';
                        echo '<td>' . $result->sched_sy . '</td>';
                        echo '<td>' . $result->COURSE_NAME . '-' . $result->COURSE_LEVEL . '</td>';
                        echo '<td>' . $result->SECTION . '</td>';
                        echo '<td>' . $result->sched_room . '</td>';
                        echo '<td>' . $result->INST_NAME . '</td>';
                        echo '<td align="center">
                                <a title="Edit" href="index.php?view=edit&id=' . $result->schedID . '" class="btn btn-primary btn-xs">
                                    <span class="fa fa-edit fw-fa"></span>
                                </a>
                                <a title="Delete" href="controller.php?action=delete&id=' . $result->schedID . '" class="btn btn-danger btn-xs">
                                    <span class="fa fa-trash-o fw-fa"></span>
                                </a>
                              </td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</form>

</div> <!---End of container-->
