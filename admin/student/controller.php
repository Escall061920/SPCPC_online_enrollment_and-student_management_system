<?php
require_once ("../../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;

	case 'addgrade' :
	doUpdateGrades();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){


		if ($_POST['SUBJ_CODE'] == "" OR $_POST['SUBJ_DESCRIPTION'] == "" OR $_POST['UNIT'] == ""
			OR $_POST['PRE_REQUISITE'] == "" OR $_POST['COURSE_ID'] == "none"  OR $_POST['AY'] == ""  
			OR $_POST['SEMESTER'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$subj = New Subject();
			// $subj->USERID 		= $_POST['user_id'];
			$subj->SUBJ_CODE 		= $_POST['SUBJ_CODE'];
			$subj->SUBJ_DESCRIPTION	= $_POST['SUBJ_DESCRIPTION']; 
			$subj->UNIT				= $_POST['UNIT'];
			$subj->PRE_REQUISITE 	= $_POST['PRE_REQUISITE'];
			$subj->COURSE_ID		= $_POST['COURSE_ID']; 
			$subj->AY				= $_POST['AY']; 
			$subj->SEMESTER			= $_POST['SEMESTER'];
			$subj->create();

						// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
						// $autonum->auto_update(2);

			message("New [". $_POST['SUBJ_CODE'] ."] created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		global $mydb;

	if(isset($_POST['save'])){

// $sql="SELECT * FROM tblstudent WHERE ACC_USERNAME='" . $_POST['USER_NAME'] . "'";
// $userresult = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
// $userStud  = mysqli_fetch_assoc($userresult);

// if($userStud){
// 	message("Username is already in used.", "error");
//     redirect(web_root."admin/student/index.php?view=view&id=".$_POST['IDNO']);
// }else{
	$age = date_diff(date_create($_POST['BIRTHDATE']),date_create('today'))->y;
 if ($age < 15){
       message("Invalid age. 15 years old and above is allowed.", "error");
       redirect("index.php?view=view&id=".$_POST['IDNO']);

    }else{
    	$stud = New Student();
		$stud->FNAME 				= $_POST['FNAME'];
		$stud->LNAME 				= $_POST['LNAME'];
		$stud->MNAME 				= $_POST['MI'];
		$stud->SEX 					= $_POST['optionsRadios'];
		$stud->BDAY 				= date_format(date_create($_POST['BIRTHDATE']),'Y-m-d');
		$stud->BPLACE 				= $_POST['BIRTHPLACE'];
		$stud->STATUS 				= $_POST['CIVILSTATUS'];
		$stud->NATIONALITY			= $_POST['NATIONALITY'];
		$stud->RELIGION 			= $_POST['RELIGION'];
		$stud->CONTACT_NO 			= $_POST['CONTACT'];
		$stud->HOME_ADD 			= $_POST['PADDRESS'];
		// $stud->ACC_USERNAME 		= $_POST['USER_NAME']; 
		$stud->update($_POST['IDNO']);


		$studetails = New StudentDetails();
		$studetails->GUARDIAN	 	= $_POST['GUARDIAN'];
		$studetails->GCONTACT 		= $_POST['GCONTACT'];
		$studetails->update($_POST['IDNO']);

		message("Student has been updated!", "success");
		redirect("index.php?view=view&id=".$_POST['IDNO']);
    }
			
	 
// }

		}
	}


	function doDelete(){
		global $mydb;
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$subj = New User();
		// 	$subj->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$subj = New Subject();
	 		 	$subj->delete($id);
			 
			message("User already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doUpdateGrades(){
		global $mydb;
	
		if (isset($_POST['save'])) {
			// Initialize the remark based on the average
			$remark = '';
			
			// If the average is 3 or greater, the student has failed
			if ($_POST['AVERAGE'] >= 3) {
				$remark = 'Failed';
			} else {
				$remark = 'Passed';
			}
	
			// Update the grades table
			$grade = New Grade();
			$grade->FIRST = $_POST['FIRSTGRADING'];
			$grade->SECOND = $_POST['SECONDGRADING'];
			$grade->AVE = $_POST['AVERAGE'];
			$grade->REMARKS = $remark;
			$grade->update($_POST['GRADEID']);
	
			// Update the student's subject record
			$studentsubject = New StudentSubjects();
			$studentsubject->AVERAGE = $_POST['AVERAGE'];
			$studentsubject->OUTCOME = $remark;
			$studentsubject->updateSubject($_POST['SUBJ_ID'], $_POST['IDNO']);
	
			// Check all subjects the student is enrolled in to determine overall status
			$sql = "SELECT AVERAGE FROM studentsubjects WHERE IDNO = " . $_POST['IDNO'];
			$result = mysqli_query($mydb->conn, $sql);
	
			$hasFailed = false;
	
			// Loop through the results to check if the student has failed any subject
			while ($row = mysqli_fetch_assoc($result)) {
				if ($row['AVERAGE'] >= 3) {
					$hasFailed = true;
					break; // Exit loop on the first failure
				}
			}
	
			// Update the student's status based on failure
			$student = New Student();
			if ($hasFailed) {
				$student->student_status = 'Irregular';
			} else {
				$student->student_status = 'Regular';
			}
			$student->update($_POST['IDNO']);
	
			// Validate year level progression if needed
			// (You may retain or adjust the rest of the logic here)
	
			// Display a success message
			message("[" . $_POST['SUBJ_CODE'] . "] has been updated!", "success");
			redirect("index.php?view=grades&id=" . $_POST['IDNO']);
		}
	}
	

 
?>