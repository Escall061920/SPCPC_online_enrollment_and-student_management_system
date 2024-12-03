<?php
date_default_timezone_set('Asia/Manila');
// Other initial setup code...
?>


<?php
require_once("../../include/initialize.php");

if(isset($_POST['Users'])) {
    $userRole = $_POST['Users'];

    if ($userRole == "All") {
        $sql = "SELECT * FROM `tbllogs` l, `useraccounts` u WHERE l.`USERID`=u.`ACCOUNT_ID`";
    } else {
        // Adjust table and query according to your database schema
        $sql = "SELECT * FROM `tbllogs` l, `useraccounts` u WHERE l.`USERID`=u.`ACCOUNT_ID` AND LOGROLE LIKE '%" . $userRole . "%'";
    }

    $mydb->setQuery($sql);
    $res = $mydb->executeQuery();
    $row_count = $mydb->num_rows($res);
    $cur = $mydb->loadResultList();

    $output = ''; // Initialize output variable
    if ($row_count > 0) {
        foreach ($cur as $result) {
            $output .= '<tr>';
            $output .= '<td>' . ($userRole == "Student" ? $result->FNAME . ' ' . $result->LNAME : $result->ACCOUNT_NAME) . '</td>';
            $output .= '<td>' . date('m/d/Y h:i:s A', strtotime($result->LOGDATETIME)) . '</td>';
            $output .= '<td>' . $result->LOGROLE . '</td>';
            $output .= '<td>' . $result->LOGMODE . '</td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="4">No logs found</td></tr>'; // Message if no logs found
    }
    
    echo $output; // Return the output
}
?>
