      <?php foreach ($msges as $msg) {
        $query = "SELECT * FROM staff WHERE email='{$msg['fromm']}' ";
        $staff = mysqli_fetch_assoc(mysqli_query($connection, $query));
      ?>
                       <div class="desc">
                       	<div class="thumb">
                       		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                       	</div>
                       	<div class="details">
                       		<p><muted><?php echo ' '.$date1;?></muted><br/>
                       		   <a href="staffdetails.php?username=<?php echo $staff['username']?>"><?php echo ucwords($staff['first_name'].' '. $staff['last_name']) ; ?></a>  <?php echo ' ' .$msg['message']; ?><br/>
                       		</p>
                       	</div>
                      </div><hr>

          <?php  } ?>
