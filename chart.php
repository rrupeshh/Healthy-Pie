<?php 
	include 'connect.php';

	$points = []; //empty array
	$reg_id = $_GET['reg_id'];
	$portfolio_id = mysqli_fetch_assoc(mysqli_query($con,"SELECT portfolio_id FROM portfolio_profile WHERE reg_id='$reg_id'"))['portfolio_id'];

	$sql = "SELECT bmi_points FROM portfolio_userbmi WHERE portfolio_id='$portfolio_id' ORDER BY id DESC LIMIT 5";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result) == 5) {
		while($row = mysqli_fetch_assoc($result)) {
			$points[] = $row['bmi_points'];
		}

		echo json_encode($points);
	} elseif(mysqli_num_rows($result) == 4) {
		$points[] = '0';
		while($row = mysqli_fetch_assoc($result)) {
			$points[] = $row['bmi_points'];
		}

		echo json_encode($points);
	} elseif(mysqli_num_rows($result) == 3) {
		$points[] = '0';
		$points[] = '0';
		while($row = mysqli_fetch_assoc($result)) {
			$points[] = $row['bmi_points'];
		}

		echo json_encode($points);
	} elseif(mysqli_num_rows($result) == 2) {
		$points[] = '0';
		$points[] = '0';
		$points[] = '0';
		while($row = mysqli_fetch_assoc($result)) {
			$points[] = $row['bmi_points'];
		}

		echo json_encode($points);
	} elseif(mysqli_num_rows($result) == 1) {
		$points[] = '0';
		$points[] = '0';
		$points[] = '0';
		$points[] = '0';
		while($row = mysqli_fetch_assoc($result)) {
			$points[] = $row['bmi_points'];
		}

		echo json_encode($points);
	} else {
		$std = new stdClass();
		$std->msg = 'false';

		echo json_encode($std);
	}

?>