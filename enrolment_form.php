<?php
$q = $_GET['q'];
if ($q == 'enrol') {
    if (isset($_SESSION['IDNO'])) {
        $student = new Student();
        $stud = $student->single_student($_SESSION['IDNO']);

        if ($stud->NewEnrollees == 1) {
            redirect('index.php?q=profile');
        } else {
            if ($stud->student_status == 'Regular') {
                redirect('index.php?q=subject');
            } elseif ($stud->student_status == 'Irregular') {
                redirect('index.php?q=cart');
            } else {
                redirect('index.php?q=profile');
            }
        }
    } else {
        ?>
        <div class="container">
            <div class="row">
                <!-- Pre-registration Form Column -->
                <div class="col-md-12">
                    
                    <div class="tab-content"><br/>
                        <div class="tab-pane active" id="New">
                            <?php include "regform.php"; ?>
                        </div><!--/tab-pane-->
                        <div class="tab-pane" id="Old">
                            <!-- The following content is in the Old tab -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="well well-sm" style="background-color:#098744;color:#fff;"><b>Login Student</b></div>
                                    <form class="form-horizontal span6" action="login.php" method="POST">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label" for="U_USERNAME">Username:</label>
                                                <input id="U_USERNAME" name="U_USERNAME" placeholder="Username" type="text" class="form-control input">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="control-label" for="U_PASS">Password:</label>
                                                <div class="input-group">
                                                    <input name="U_PASS" id="U_PASS" placeholder="Password" type="password" class="form-control input">
                                                    <div class="input-group-addon" style="cursor: pointer;" onclick="togglePassword()">
                                                        <i class="fa fa-eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" id="sidebarLogin" name="sidebarLogin" style="background-color:#098744;color:#fff;" class="btn btn-primary btn-sm">
                                                    Login
                                                </button>
                                                <a href="#" style="margin-left: 15px; font-size: 14px; text-decoration: underline; color: #098744;">Forgot Password?</a>
                                                <a href="http://localhost/onlineenrolmentsystem/admin/login.php" style="margin-left: 15px; font-size: 14px; text-decoration: underline; color: #098744;" target="_blank">Login as Admin</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!--/tab-pane-->
                        <div class="tab-pane" id="Transferees">
                            <!-- Content for the Transferees tab -->
                            <?php include "regform.php"; ?>
                        </div><!--/tab-pane-->
                    </div>
                </div><!--/col-md-12-->
            </div><!--/row-->
        </div><!--/container-->
        <?php
    }
} else {
    include 'coursesubject.php';
}
?>
<script>
    function togglePassword() {
        var passwordField = document.getElementById("U_PASS");
        var eyeIcon = document.querySelector(".input-group-addon i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
