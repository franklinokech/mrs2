<?php

require_once '../functions.php';
include 'header.php';
?>

<?php
  if(isset($_GET['page'])){
    $current_page = $_GET['page'] - 1;
  }else{
    $current_page = 0;
  }
?>

<div class="container">


  <div class="row">
    <div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Patient </h3>
      </div>
      <div class="panel-body" style="height:auto">
       
         
      <div class="clearfix"></div>                  
					<?php echo messages(); ?>
			<div class="table-responsive">
				  <table class="table table-striped table-hover table-bordered ">
					<tbody><tr>
						<th>Visit No</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action </th>
					  </tr>
					  
						  <?php
							$patient_set = find_laboratory_test(1, $current_page);
						  // pre($patient_set);
							while ($lab = mysqli_fetch_assoc($patient_set)){

								  $pat = find_patient($lab["reg_no"]);
								  $pati = mysqli_fetch_assoc($pat);
						  ?>
						  <tr>
						  <td style="text-align: center;"><?php echo $lab["visit_no"]; ?></td>

								  <td><?php echo ucwords($pati["first_name"]. " ". $pati['last_name']); ?></td>
								 
								  <td><?php  if($lab["attended"]==0){
								  		echo " Just Submited, Still unread..";
								  }elseif ($lab["attended"]==1) {
								  	echo "Being Processed, Please wait..";
								  }elseif ($lab["attended"]==2) {
								  	echo "Ready";
								  } ?>
								</td>
						 
							  <td><?php  if($lab["attended"]==0){ ?>
							  	<a href=""><button class="btn btn-sm btn-info disabled"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
							<?php }elseif ($lab["attended"]==1) { ?>
							  	<a  href=""><button class="btn btn-sm btn-info disabled"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
							<?php }elseif ($lab["attended"]==2) { ?>
							  	<a  href="view_patients_result.php?reg_no=<?php echo $lab["reg_no"]; ?> && visit_no=<?php echo $lab["visit_no"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
							<?php }; ?> 
							
						  </td>
						</tr>
						<?php }; ?>
					</tbody></table>
			</div>
			
			<div class="col-lg-12 center">
					  <ul class="pagination pagination-sm">
							  <?php
								$pages = ceil(mysqli_num_rows(find_laboratory_test(0, $current_page)) / 15);
								for($page=1;$page<=$pages;$page++){
							  ?>
								<a href="labresults.php?page=<?php echo $page?>" class="links" ><?php echo $page; ?></a>
							  <?php
								}
							  ?>
					  </ul>
			</div>

      </div>
    </div>
   </div>

    <div class="col-md-4">
				    <div class="panel panel-primary">
						  <div class="panel-heading">
							<h3 class="panel-title"> Navigation </h3>
						  </div>
						  <div class="panel-body" style="height:auto">
						  			<?php
						  			$labresult_wait = mysqli_fetch_assoc(find_laboratory_test_waiting(1, $current_page));
						  			$labresult = mysqli_fetch_assoc(find_laboratory_test_ready(1, $current_page));	
						  			?>
						  
						                <ul class="nav nav-pills nav-stacked">
											  <li><a href="index.php"> Home  <span class="glyphicon glyphicon-home pull-right"></a></li>
											  <li class="active"><a href="labresults.php"> Laboratory results  <span class="badge pull-right"><?php echo (count($labresult)); ?></span></a></li>
											  <li><a href="lab_result_wait.php"> Waiting Result  <span class="badge pull-right"><?php echo (count($labresult_wait)); ?></span></a></li>
											  <li><a href="cleared.php"> Cleared Patients  <span class="badge pull-right">7</span></a></li>
											  <li><a href="statistics.php">Statistics</a></li>
										</ul>
						  </div>
					</div>
    </div>
  </div>
  </div>

      <?php
      include 'footer.php';
      ?>