	
<?php
	include_once('database_connection.php');
    include_once('functions.php');
	function find_data(){
		global $connection;
		
		$query = "SELECT * FROM visit";
	
		$p_set = mysqli_query($connection, $query);
		confirm_query($p_set);

		if($row = mysqli_fetch_assoc($p_set)){

		return $row;}
	}

?>	
<script type="text/javascript">


	function loader(){

		var data = <?php
		 
		 $data_arr = find_data();
		 echo json_encode($data_arr); 

		 ?>;
		
		for (var i = 0; i <= data.length;  i++) {
			alert(data[i]);

		};
		alert(data["date"]);
	}

	loader();
</script>