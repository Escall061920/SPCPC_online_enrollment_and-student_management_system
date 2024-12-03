<?php
session_start();
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

// Assuming you've included your database connection and functions

// Fetch the schedule data
$sql = "SELECT * FROM tblinstructor i, `tblschedule` s, `course` c, subject subj WHERE i.INST_ID=s.INST_ID AND s.`COURSE_ID`=c.`COURSE_ID` AND s.SUBJ_ID=subj.SUBJ_ID";
$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Schedule</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Include your CSS file -->
    <style>
        /* Add any additional styles here for print view */
        @media print {
            body {
                font-size: 12px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-header">List of Schedule</h1>
        <img src="<?php echo web_root; ?>img/spcpc_seal_100x100.jpg" style="float:right;">

        <table class="table table-bordered" style="width: 100%; font-size: 15px;">
            <thead style="background-color: #098744; color: white;">
                <tr>
                    <th>Time</th>
                    <th>Days</th>
                    <th>Subject</th>
                    <th>Semester</th>
                    <th>School Year</th>
                    <th>Course and Year</th>
                    <th>Room</th>
                    <th>Section</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cur as $result) : ?>
                    <tr>
                        <td><?php echo $result->sched_time; ?></td>
                        <td><?php echo $result->sched_day; ?></td>
                        <td><?php echo $result->SUBJ_CODE; ?></td>
                        <td><?php echo $result->sched_semester; ?></td>
                        <td><?php echo $result->sched_sy; ?></td>
                        <td><?php echo $result->COURSE_NAME . '-' . $result->COURSE_LEVEL; ?></td>
                        <td><?php echo $result->sched_room; ?></td>
                        <td><?php echo $result->SECTION; ?></td>
                        <td><?php echo $result->INST_NAME; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="no-print">
            <button onclick="window.print();">Print this page</button>
            <a href="index.php?view=add" class="btn btn-primary">Set New Schedule</a>
        </div>
    </div>
</body>
</html>
