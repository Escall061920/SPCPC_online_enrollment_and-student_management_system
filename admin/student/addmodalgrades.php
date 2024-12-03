<?php  
require_once("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])){
  redirect(web_root."admin/index.php");
}

@$SUBJ_ID = $_GET['id'];
if($SUBJ_ID==''){
  redirect("index.php");
}
if($_GET['IDNO']==''){
  redirect("index.php");
}

if($_GET['gid']==''){
  redirect("index.php");
}

$subject = New Subject();
$res = $subject->single_subject($SUBJ_ID);

$grades = New Grade();
$resgrades = $grades->single_grade($_GET['gid']);

?> 
<table>
    <tr>
       <td width="87%" align="center">
         <h3>Add Grades</h3>
        </td>
    </tr>
</table>

<form class="form-horizontal span6 ekko-lightbox-container" action="<?php echo web_root.'admin/student/'; ?>controller.php?action=addgrade" method="POST">
      
<input class="form-control input-sm" id="IDNO" name="IDNO" type="Hidden" value="<?php echo $_GET['IDNO']; ?>">

<input class="form-control input-sm" id="SUBJ_ID" name="SUBJ_ID" type="Hidden" value="<?php echo $res->SUBJ_ID; ?>">

<input class="form-control input-sm" id="GRADEID" name="GRADEID" type="Hidden" value="<?php echo $_GET['gid']; ?>">

<div class="form-group">
  <div class="col-md-12">
    <label class="col-md-4 control-label" for="SUBJ_CODE">Subject:</label>
    <div class="col-md-6">
      <textarea class="form-control input-sm" id="SUBJ_CODE" name="SUBJ_CODE" readonly="true" rows="4" cols="32"><?php echo $res->SUBJ_CODE .'['. $res->SUBJ_DESCRIPTION.']';?></textarea>
    </div>
  </div>
</div>
      
<div class="form-group">
  <div class="col-md-12">
    <label class="col-md-4 control-label" for="FIRSTGRADING">Midterms:</label>
    <div class="col-md-6">
      <input class="form-control input-sm" id="FIRSTGRADING" name="FIRSTGRADING" placeholder="Midterm Grade" type="text" value="<?php echo $resgrades->FIRST; ?>" autocomplete="off" required>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    <label class="col-md-4 control-label" for="SECONDGRADING">Finals:</label>
    <div class="col-md-6">
      <input class="form-control input-sm" id="SECONDGRADING" name="SECONDGRADING" placeholder="Final Grade" type="text" value="<?php echo $resgrades->SECOND; ?>" autocomplete="off" required>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-md-12">
    <label class="col-md-4 control-label" for="AVERAGE">Average:</label>
    <div class="col-md-6">
      <input class="form-control input-sm" id="AVERAGE" name="AVERAGE" placeholder="0" type="text" value="<?php echo $resgrades->AVE; ?>" readonly="true" required>
    </div>
  </div>
</div>
   
<div class="form-group">
  <div class="col-md-12">
    <div class="col-md-6 col-md-offset-4">
      <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Save</button>
    </div>
  </div>
</div>
</form>

<script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $("#FIRSTGRADING, #SECONDGRADING").keyup(function() {
        var first = parseFloat(document.getElementById('FIRSTGRADING').value) || 0;
        var second = parseFloat(document.getElementById('SECONDGRADING').value) || 0;

        // Calculate average as per college grading system
        var average = (first + second) / 2;

        // Always display the average, but mark as failed if it exceeds 3
        document.getElementById('AVERAGE').value = average.toFixed(2);

        // Optional: If you want to show a message instead of changing the input
        if (average > 3) {
            // You could display a warning message elsewhere on the page
            // Example: document.getElementById('grade-warning').innerText = 'Warning: Average exceeds passing grade.';
        } else {
            // Clear warning if average is within passing range
            // Example: document.getElementById('grade-warning').innerText = '';
        }
    });

    $("input").click(function() {
        this.select();
    });
</script>
