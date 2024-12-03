<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;

    case 'delete':
        doDelete();
        break;

    case 'photos':
        doupdateimage();
        break;
}

function doInsert() {
    global $mydb;
    if (isset($_POST['save'])) {
        // Check if required fields are set
        if (empty($_POST['TIME_FROM']) || empty($_POST['TIME_TO']) ||
            empty($_POST['sched_day']) || empty($_POST['sched_semester']) ||
            empty($_POST['COURSE_ID']) || empty($_POST['sched_room']) || 
            empty($_POST['SUBJ_ID']) || empty($_POST['INST_ID'])) {
            
            message("All fields are required!", "error");
            redirect('index.php?view=add');
        }

        // Sanitize inputs to prevent SQL injection
        $subjId = intval($_POST['SUBJ_ID']);
        $courseId = intval($_POST['COURSE_ID']);
        $schedSemester = mysqli_real_escape_string($mydb->conn, $_POST['sched_semester']);
        $timeFrom = mysqli_real_escape_string($mydb->conn, $_POST['TIME_FROM']);
        $timeTo = mysqli_real_escape_string($mydb->conn, $_POST['TIME_TO']);
        $schedDay = mysqli_real_escape_string($mydb->conn, $_POST['sched_day']);
        $schedRoom = mysqli_real_escape_string($mydb->conn, $_POST['sched_room']);
        $instId = intval($_POST['INST_ID']);

        // Check if the subject already has a schedule
        $sql = "SELECT * FROM `tblschedule` 
                WHERE `SUBJ_ID` = $subjId AND `COURSE_ID` = $courseId AND sched_semester = '$schedSemester'";
        $result = mysqli_query($mydb->conn, $sql) or die(mysqli_error($mydb->conn));
        $maxrows = mysqli_num_rows($result);

        if ($maxrows > 0) {
            message("The subject already has a schedule.", "error");
            redirect('index.php?view=add');
        }

        // Check for time conflicts
        $query = "SELECT * FROM `tblschedule` 
                  WHERE (
                        (TIME('$timeFrom') >= TIME(`TIME_FROM`) AND TIME('$timeTo') <= TIME(`TIME_FROM`)) OR
                        (TIME('$timeFrom') >= TIME(`TIME_TO`) AND TIME('$timeTo') <= TIME(`TIME_TO`)) OR
                        (TIME(`TIME_FROM`) <= TIME('$timeFrom') AND TIME(`TIME_TO`) >= TIME('$timeTo'))
                  )
                  AND `sched_day` = '$schedDay' 
                  AND `sched_room` = '$schedRoom'";

        $result = mysqli_query($mydb->conn, $query) or die(mysqli_error($mydb->conn));
        $numrow = mysqli_num_rows($result);

        if ($numrow > 0) {
            message("Instructor is not available or room is already occupied with the time you have set.", "error");
            redirect('index.php?view=add');
        } else {
            $nextyear = date("Y") + 1;
            $currentyear = date("Y");

            $sched = new Schedule();
            $sched->sched_time = "$timeFrom-$timeTo";
            $sched->TIME_FROM = $timeFrom;
            $sched->TIME_TO = $timeTo;
            $sched->sched_day = $schedDay;
            $sched->sched_semester = $schedSemester;
            $sched->sched_sy = "$currentyear-$nextyear";
            $sched->sched_room = $schedRoom;
            $sched->SUBJ_ID = $subjId;
            $sched->SECTION = mysqli_real_escape_string($mydb->conn, $_POST['SECTION']); // Ensure this field is in your form
            $sched->COURSE_ID = $courseId;
            $sched->INST_ID = $instId;
            $sched->create();

            message("New schedule has been created successfully!", "success");
            redirect("index.php");
        }
    }
}

function doEdit() {
    global $mydb;

    if (isset($_POST['save'])) {
        $nextyear = date("Y") + 1;
        $currentyear = date("Y");

        $sched = new Schedule();
        $sched->sched_time = $_POST['TIME_FROM'] . '-' . $_POST['TIME_TO'];
        $sched->TIME_FROM = $_POST['TIME_FROM'];
        $sched->TIME_TO = $_POST['TIME_TO'];
        $sched->sched_day = $_POST['sched_day'];
        $sched->sched_semester = $_POST['sched_semester'];
        $sched->sched_room = $_POST['sched_room'];
        $sched->SECTION = $_POST['SECTION'];
        $sched->SUBJ_ID = $_POST['SUBJ_ID'];
        $sched->COURSE_ID = $_POST['COURSE_ID'];
        $sched->INST_ID = $_POST['INST_ID'];
        $sched->update($_POST['schedID']);

        message("Schedule has been updated!", "success");
        redirect("index.php");
    }
}

function doDelete() {
    global $mydb;

    $id = $_GET['id'];

    $sched = new Schedule();
    $sched->delete($id);

    message("Schedule has been deleted!", "info");
    redirect('index.php');
}
?>
