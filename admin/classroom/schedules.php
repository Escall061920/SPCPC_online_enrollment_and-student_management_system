 <!-- Main content --> 
        <!-- title row -->
    <form action="" method="POST"> 
       
      <!-- info row -->
      <div class="row invoice-info">
      <div class="col-sm-3 invoice-col">
        
      </div>

        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
         Semester
          <address> 
		         <select name="Semester" class="form-control">
              <option value="First">First</option>
              <option value="Second">Second</option> 
            </select>
          </address>
        </div>

        <div class="col-sm-3 invoice-col">
         Room
          <address>
            <div class="form-group">
			  <select name="sched_room" class="form-control">  
			  	 <?php 
                $mydb->setQuery("SELECT distinct(sched_room) FROM `tblschedule` ");
                $cur = $mydb->loadResultList();

                foreach ($cur as $result) {
                  echo '<option value="'.$result->sched_room.'">'.$result->sched_room.'</option>';
                }
                ?>
			  </select>
		  </div>
          </address>
        </div>

       
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe">List Of Schedules</i>
              <small class="pull-right">
               <?php echo (isset($_POST['Semester'])) ? 'Semester: '.$_POST['Semester'] : ''; ?>
               <?php echo (isset($_POST['sched_room'])) ? ' | Room: '.$_POST['sched_room'] : ''; ?>
              </small>
          </h2>
        </div> 
      </div> 
    
      
       
	 		  <table class="table table-bordered table-responsive" style="font-size:15px" cellspacing="0">
				
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
				  	</tr>	
				  </thead> 
				  <tbody style="background-color: #098744; color: white;">
				  	<?php   
				  		if (isset($_POST['submit'])) {
								$sql="SELECT DISTINCT s.sched_time, s.sched_day, subj.SUBJ_CODE, s.sched_semester, 
                    s.sched_sy, c.COURSE_NAME, c.COURSE_LEVEL, st.SECTION, s.sched_room 
                    FROM `tblschedule` s 
                    LEFT JOIN `course` c ON s.`COURSE_ID`=c.`COURSE_ID` 
                    LEFT JOIN subject subj ON s.SUBJ_ID=subj.SUBJ_ID
                    LEFT JOIN tblstudent st ON c.COURSE_ID=st.COURSE_ID
								WHERE sched_room = '" . $_POST['sched_room'] ."'
								AND sched_semester = '" . $_POST['Semester'] ."'";
                if(!empty($_POST['SECTION'])) {
                  $sql .= " AND st.SECTION = '" . $_POST['SECTION'] ."'";
                }
                // Modified ORDER BY to handle AM/PM times correctly
                $sql .= " ORDER BY 
                           CASE LOWER(sched_day)
                             WHEN 'monday' THEN 1
                             WHEN 'tuesday' THEN 2
                             WHEN 'wednesday' THEN 3
                             WHEN 'thursday' THEN 4
                             WHEN 'friday' THEN 5
                             WHEN 'saturday' THEN 6
                             WHEN 'sunday' THEN 7
                           END,
                           CASE 
                             WHEN sched_time LIKE '%AM%' THEN 1 
                             WHEN sched_time LIKE '%PM%' THEN 2
                           END,
                           CAST(SUBSTRING_INDEX(sched_time, ':', 1) AS UNSIGNED)";
								$mydb->setQuery($sql);
								$cur = $mydb->loadResultList();

								foreach ($cur as $result) {
								echo '<tr>';
								echo '<td>'. $result->sched_time.'</td>';
								// Format day to proper case
								$days = explode(',', $result->sched_day);
								$formatted_days = array_map(function($day) {
								    return ucfirst(strtolower(trim($day)));
								}, $days);
								echo '<td>'. implode(', ', $formatted_days).'</td>';
								echo '<td>' . $result->SUBJ_CODE.'</td>';
								echo '<td>'. $result->sched_semester.'</td>';
								echo '<td>'. $result->sched_sy.'</td>';
								echo '<td>' . $result->COURSE_NAME.'-' . $result->COURSE_LEVEL.'</td>';
                echo '<td>'. $result->SECTION.'</td>';
								echo '<td>'. $result->sched_room.'</td>';
								echo '</tr>'; 
					  		} 
				  		} 
				  	?>
				  </tbody>
				</table>
	</form>
	<form action="schedulesPrint.php" method="POST" target="_blank">
	<input type="hidden" name="Semester" value="<?php echo (isset($_POST['Semester'])) ? $_POST['Semester'] : ''; ?>"> 
	<input type="hidden" name="sched_room" value="<?php echo (isset($_POST['sched_room'])) ? $_POST['sched_room'] : ''; ?>">
  <input type="hidden" name="SECTION" value="<?php echo (isset($_POST['SECTION'])) ? $_POST['SECTION'] : ''; ?>">
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
         <span class="pull-right"> <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></span>  
        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>