<?php  
require_once("../../include/initialize.php");

if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root."admin/index.php");
}

@$SUBJ_ID = $_GET['id'];
if ($SUBJ_ID == '') {
    redirect("index.php");
}

if ($_GET['IDNO'] == '') {
    redirect("index.php");
}

if (isset($_GET['gid'])) {
    $grades = New Grade();
    $resgrades = $grades->single_grade($_GET['gid']);
}

$subject = New Subject();
$res = $subject->single_subject($SUBJ_ID);

if (!isset($_GET['SEMESTER'])) {
    redirect("index.php");
}

$subject = New Subject();
$subj = $subject->single_subject($_GET['id']); 

// Use MySQLi for database queries
$mysqli = new mysqli("localhost", "root", "", "dbgreenvalley");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Pre-requisite check query
$sql = "SELECT * FROM `grades` g, `subject` s WHERE g.`SUBJ_ID` = s.`SUBJ_ID` AND `SUBJ_CODE` = ? AND AVE < 75 AND IDNO = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $subj->PRE_REQUISITE, $_GET['IDNO']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($row['SUBJ_CODE'])) {
    message("You must take the pre-requisite first before taking up this subject.", "error");
    redirect('index.php?view=addCredit&IDNO=' . $_GET['IDNO']);
} else {
    // Grades check query
    $sql = "SELECT * FROM `grades` WHERE REMARKS != 'Drop' AND `SUBJ_ID` = ? AND IDNO = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $_GET['id'], $_GET['IDNO']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (isset($row['SUBJ_ID'])) {
        if ($row['AVE'] > 0 && $row['AVE'] < 75) {
            message("This subject is undertaken.", "error");
            redirect('index.php?view=addCredit&IDNO=' . $_GET['IDNO']);
        } elseif ($row['AVE'] == 0) {
            message("This subject is undertaken.", "error");
            redirect('index.php?view=addCredit&IDNO=' . $_GET['IDNO']);
        } elseif ($row['AVE'] > 74) {
            message("You have already taken this subject.", "error");
            redirect('index.php?view=addCredit&IDNO=' . $_GET['IDNO']);
        }
    } else {
        ?>
        <table>
            <tr>
                <td width="87%" align="center">
                    <h3>Add Grades</h3>
                </td>
            </tr>
        </table>
        <form class="form-horizontal span6 ekko-lightbox-container" action="<?php echo web_root.'admin/enrollees/'; ?>controller.php?action=addcreditsubject" method="POST">
            <input class="form-control input-sm" id="IDNO" name="IDNO" type="hidden" value="<?php echo $_GET['IDNO']; ?>">
            <input class="form-control input-sm" id="SUBJ_ID" name="SUBJ_ID" type="hidden" value="<?php echo $res->SUBJ_ID; ?>">
            <input class="form-control input-sm" id="SEMESTER" name="SEMESTER" type="hidden" value="<?php echo $_GET['SEMESTER']; ?>">
            <input class="form-control input-sm" id="GRADEID" name="GRADEID" type="hidden" value="<?php echo isset($_GET['gid']) ? $_GET['gid'] : ''; ?>">

            <div class="form-group">
                <div class="col-md-12">
                    <label class="col-md-4 control-label" for="SUBJ_CODE">Subject:</label>
                    <div class="col-md-6">
                        <textarea class="form-control input-sm" id="SUBJ_CODE" name="SUBJ_CODE" readonly="true" rows="4" cols="32"><?php echo $res->SUBJ_CODE . '[' . $res->SUBJ_DESCRIPTION . ']'; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="col-md-4 control-label" for="TAKEN">Subject Taken:</label>
                    <div class="col-md-6">
                        <input type="checkbox" id="TAKEN" name="TAKEN" onchange="handleTakenChange(this)">
                        <span id="takenStatus" style="margin-left: 10px;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="col-md-4 control-label" for="idno"></label>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Save</button> 
                    </div>
                </div>
            </div>
        </form>
        <?php 
    }
}

$mysqli->close();
?>

<script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>
<script type="text/javascript">
    function handleTakenChange(checkbox) {
        var takenStatus = document.getElementById('takenStatus');
        var studentTypeRadios = window.parent.document.getElementsByName('student_type');
        
        if (checkbox.checked) {
            takenStatus.style.color = 'red';
            takenStatus.textContent = 'Taken';
            
            // Set student type to irregular
            for(var i = 0; i < studentTypeRadios.length; i++) {
                if(studentTypeRadios[i].value === 'irregular') {
                    studentTypeRadios[i].checked = true;
                }
            }
        } else {
            takenStatus.textContent = '';
        }
    }
</script>
