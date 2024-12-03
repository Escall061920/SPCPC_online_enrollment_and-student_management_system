<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}
?>



<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <h1 class="page-header">
                List of Users  
                <a href="index.php?view=add" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus-circle fw-fa"></i> New
                </a>  
            </h1>
        </div>
        <div class="col-lg-6">
            <img style="float:right;" src="<?php echo web_root; ?>img/spcpc_seal_100x100.jpg">
        </div>
    </div>
</div>

<form action="controller.php?action=delete" method="POST">  
    <div class="table-responsive">			
        <table id="dash-table" class="table table-bordered table-responsive" style="font-size:15px" cellspacing="0">
            <thead style="background-color: #098744; color: white;">
                <tr>
                    <th>Account Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th width="10%">Action</th>
                </tr>	
            </thead> 
            <tbody style="background-color: #098744; color: white;">
                <?php 
                    $mydb->setQuery("SELECT * FROM `useraccounts`");
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<tr>';
                        echo '<td>' . $result->ACCOUNT_NAME . '</td>';
                        echo '<td>' . $result->ACCOUNT_USERNAME . '</td>';
                        echo '<td>' . $result->ACCOUNT_TYPE . '</td>';
                        
                        $active = ($result->ACCOUNT_ID == $_SESSION['ACCOUNT_ID'] || $result->ACCOUNT_TYPE == 'MainAdministrator') ? "disabled" : "";

                        echo '<td align="center">
                                <a title="Edit" href="index.php?view=edit&id=' . $result->ACCOUNT_ID . '" class="btn btn-primary btn-xs">
                                    <span class="fa fa-edit fw-fa"></span>
                                </a>
                                <button type="button" onclick="openDeleteModal(' . $result->ACCOUNT_ID . ');" class="btn btn-danger btn-xs" ' . $active . '>
                                    <span class="fa fa-trash-o fw-fa"></span>
                                </button>
                              </td>';
                        echo '</tr>';
                    } 
                ?>
            </tbody>
        </table>
    </div>
</form>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); z-index: 1050; background-color: rgba(9, 136, 68, 0.85); border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); padding: 30px; width: 400px;">
    <h5 style="margin-bottom: 15px; color: white; font-size: 20px;">Confirm Deletion</h5>
    <p style="color: white; font-size: 18px;">Are you sure you want to delete this user?</p>
    <div style="text-align: right;">
        <button class="btn btn-secondary" style="font-size: 18px;"  onclick="closeDeleteModal()">Cancel</button>
        <a id="confirmDeleteBtn" href="#" style="font-size: 18px;" class="btn btn-danger">Delete</a>
    </div>
</div>

<div id="overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1049;"></div>

<script>
function openDeleteModal(accountId) {
    // Set the delete URL in the confirmation button
    document.getElementById('confirmDeleteBtn').href = "controller.php?action=delete&id=" + accountId;
    // Show the modal and overlay
    document.getElementById('deleteModal').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closeDeleteModal() {
    // Hide the modal and overlay
    document.getElementById('deleteModal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}
</script>

