<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['date_start']) && isset($_POST['date_end']) && $_POST['function'] == "fetch_activity"){
			$date_start = $_POST['date_start'];
			$date_end = $_POST['date_end'];

			$fetch_activity = new fetch();
			$res_fetch_activity = $fetch_activity->fetchActivity($date_start,$date_end);
			if($res_fetch_activity->rowCount()){
				while ($fetch = $res_fetch_activity->fetch()) {
					?>
						<tr>
							<td><?=$fetch['logs_activity']?></td>
							<td><?=date("M-d-Y",strtotime($fetch['logs_date']))?></td>
						</tr>

					<?php
				}
			}else{
				echo"<tr><td colspan='2' class='text-center' >No Data Found</td></tr>";
			}
		
	}else{
		ob_end_flush(header("Location: index.php"));
	}
}else{
	return false;
}

?>