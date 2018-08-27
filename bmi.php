<?php include 'connect.php'; ?>

<?php 

    $com ="";
    $bmi = "";
    if (@$_POST['submit'] == "Submit"){
        $weight = $_POST['weight'];
        $height = $_POST['height']*0.01;
        
        $bmi_res = $weight/($height * $height);
        $bmi = round($bmi_res,2);
        if ($bmi <= 18.5){
           $com = "Under Weight";
        } elseif ($bmi >= 18.5 and $bmi <25){
            $com = "Normal Weight";
        } elseif ($bmi >=25 and $bmi < 30){
            $com = "Over Weight";
        }else {
            $com = "Obese";
        }
        
        
        
    }


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
        <div id="wrapper">
             <?php include "includes/headernew.php"; ?>
            
            <!-- Main section-->
            <div id = "bmi_main" >
                <h2>BMI Calculator</h2>
                  <div id = "form">
			<form id = "form_bmi" method="post" action="bmi.php" >
			<table>
				<tr>
					<td>Weight:</td>
					<td><input  class = "input_form" type="text" name="weight" placeholder="Weight in KG"></td>
				</tr>
				<tr>
					<td>Height:</td>
					<td><input class = "input_form"   type="text" name="height" placeholder="Height in cm"></td>
				</tr>
			</table>
			<input id="sub_btn" type="submit" name="submit" value="Submit">
			</form>
                </div>
            <div id ="result">
                <?php
                if (@$_POST['submit'] == "Submit"){
                    echo $bmi . "($com)";
                }
                ?>
            </div>
            </div>
            
        </div>