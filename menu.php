 
  <div class="panel-group" id="accordion">
  <ul>

  <style>
    .hoverable {
      transition: background-color 0.2s ease, border 0.2s ease; /* Add border transition for smooth effect */
    }

    .hoverable:hover {
      background-color: white; /* Change background color to white on hover */
      border: 2px solid #0ba25f; /* Add a 2px solid border with color */
      cursor: pointer; /* Add a pointer cursor to indicate it's clickable */
    }
</style>


 
<?php 

$mydb->setQuery("SELECT * FROM `department`");

              $cur = $mydb->loadResultList();

            foreach ($cur as $result) {

?>
<li class="hoverable">
  <!-- <div class="panel panel-default"> -->
    <div class="panel-heading"  style="background-color: #098744; color: white;">
      <h4 class="panel-title">
        <a id="load"  data-toggle="collapse" data-parent="#accordion" href="#<?php echo $result->DEPT_ID; ?>" data-id="<?php echo $result->DEPT_ID; ?>">
          <?php echo $result->DEPARTMENT_DESC . ' [ ' .$result->DEPARTMENT_NAME . ' ] '; ?>
        </a>
      </h4>
    </div>

 <div id="<?php echo $result->DEPT_ID; ?>" class="panel-collapse collapse out">
      <div class="panel-body">
      <div id="loaddata<?php echo $result->DEPT_ID; ?>">
        
      </div>
      </div>
    </div>
 
 </li>
<!-- </div> -->

<?php } ?>
</ul> 

  
</div>
 
    
