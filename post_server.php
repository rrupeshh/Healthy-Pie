<?php include 'connect.php'; ?>


<?php 
    $item_name = $_GET['item_name'];

    $query = "SELECT * FROM ingredients WHERE item_name = '$item_name'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $amount_unit = $row['amount_unit'];
        
        $std = new stdClass();
        $std->amount_unit = $amount_unit;
        $std->amount_value = 'true';
        
        echo json_encode($std);
    } else {
        $std = new stdClass();
        $std->amount_unit = 'N/A';
        $std->amount_value = 'false';
        
        echo json_encode($std);
    }
?>