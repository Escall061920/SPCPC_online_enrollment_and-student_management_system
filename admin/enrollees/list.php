<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>

<div class="row">
      <div class="col-lg-12">
       	 <div class="col-lg-6">
            <h1 class="page-header">New Enrollees</h1>
       		</div>
       		<div class="col-lg-6" >
       			<img style="float:right;" src="<?php echo web_root; ?>img/spcpc_seal_100x100.jpg" >
       		</div>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table  table-bordered  table-responsive" style="font-size:15px" cellspacing="0">
				
				<thead style="background-color: #098744; color: white;">
				  	<tr>
				  		<th>Student Number</th>
				  		<th>Name</th>
				  		<th>Sex</th> 
				  		<th>Age</th>
				  		<th>Address</th>
				  		<th>Contact No.</th>
				  		<th>Status</th>
				  		<th>Course / Year</th>
                        <th>Section</th>
				  		<th width="14%" style="text-align:center;">Action</th>
				 
				  	</tr>	
				  </thead> 
				   <tbody style="background-color: #098744; color: white;">
				  	<?php  //`IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`,
				  	// `STATUS`, `AGE`, `NATIONALITY`, `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `EMAIL`, `student_status`
				  		$mydb->setQuery("SELECT * FROM `tblstudent` s, course c WHERE s.COURSE_ID=c.COURSE_ID AND NewEnrollees=1");

				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
							
							if($result->BDAY!='0000-00-00'){
								$age = date_diff(date_create($result->BDAY),date_create('today'))->y;
							}else{
								$age='None';
							}
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->STUDENT_NUMBER.'</a></td>';
				  		echo '<td>'. $result->LNAME.','. $result->FNAME.' '. $result->MNAME.'</td>';
				  		echo '<td>'. $result->SEX.'</td>';
				  		echo '<td>' .$age.'</td>';
				  		echo '<td>'. $result->HOME_ADD.'</td>';
				  		echo '<td>'. $result->CONTACT_NO.'</td>';
				  		// echo '<td>' . $result->EMAIL.'</a></td>';
				  		echo '<td>'. $result->student_status.'</td>'; 
				  		echo '<td>' . $result->COURSE_NAME . '-' . $result->COURSE_LEVEL . '</td>';
                        echo '<td>'. $result->SECTION.'</td>';

				  		 if($result->student_status=='New'){
				  		 	echo '<td align="center" > 
				  		             <a title="Confirm" href="controller.php?action=confirm&IDNO='.$result->IDNO.'"  class="btn btn-info btn-xs" style="background-color: yellow; color: black;"> 
									 Confirm <span class="fa fa-info-circle fw-fa"></span></a>
				  			      </td>';

								} elseif ($result->student_status == 'Old' || $result->student_status == 'Transferee') {
									echo '<td align="center">
											<a title="Add Subject" href="index.php?view=addCredit&IDNO='.$result->IDNO.'" class="btn btn-xs" style="background-color: yellow; color: black;">
												Confirm <span class="fa fa-info-circle fw-fa"></span>
											</a>
										  </td>';
								
				  		// echo '<td align="center" > <a title="View Grades" href="index.php?view=grades&id='.$result->IDNO.'" class="btn btn-primary btn-xs" >Grades <span class="fa fa-info-circle fw-fa"></span> </a>
				  		// 			 </td>';
				  		 }else{
				  		 	echo '<td align="center" > 
				  		             <a title="Add Subject" href="index.php?view=addCredit&IDNO='.$result->IDNO.'"  class="btn btn-info btn-xs  ">Confirm <span class="fa fa-info-circle fw-fa"></span></a>
				  			      </td>';
				  		 }
				  		
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
 
				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>
				</div>
 -->
			</div>
				</form>
	

</div> <!---End of container-->