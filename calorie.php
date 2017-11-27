<?php include 'connect.php'; ?>
<?php 

    
    if (@$_POST['submit'] == "Calculate Calorie"){
        $gender = $_POST['gender'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $age = $_POST['age'];
        $activity = $_POST['activity'];
        
        if ($gender == "Male"){
            $bmr =  (66.4730+(13.7516 * $weight)+(5.0033 * $height)-(6.7550 * $age));
            if($activity == "1"){
               $act = 1.2;
            }elseif($activity == "2"){
                 $act = 1.375;
            }elseif($activity == "3"){
                 $act = 1.55;
            }elseif($activity == "4"){
                 $act = 1.725;
            }elseif($activity == "5"){
                 $act = 1.9;
            }
            $bmr_cal = $bmr *$act;
            $bmr_res = round($bmr_cal);
           
        }elseif ($gender == "Female"){
             $bmr =  (655.0955+(9.5634 * $weight)+(1.8496 * $height)-(4.6756 * $age));
            if($activity == "1"){
               $act = 1.2;
            }elseif($activity == "2"){
                 $act = 1.375;
            }elseif($activity == "3"){
                 $act = 1.55;
            }elseif($activity == "4"){
                 $act = 1.725;
            }elseif($activity == "5"){
                 $act = 1.9;
            }
            $bmr_cal = $bmr *$act;
            $bmr_res = round($bmr_cal);
           
            
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
            <div id = "calorie_main" >
                <h2>Calorie Calculator</h2>
                  <div id = "form">
			<form id = "form_cal" method="post" action="calorie.php" >
			<table>
                <tr>
					<td>Gender:</td>
					<td><input  class = "input_radio" type="radio" name="gender" value = "Male">Male <input class = "input_radio"   type="radio" name="gender" value = "Female">Female</td>
				</tr>
				<tr>
					<td>Weight:</td>
					<td><input  class = "input_form" type="text" name="weight" placeholder="Weight in KG"></td>
				</tr>
				<tr>
					<td>Height:</td>
					<td><input  class = "input_form"  type="text" name="height" placeholder="Height in cm"></td>
				</tr>
                <tr>
					<td>Age:</td>
					<td><input  class = "input_form"  type="text" name="age" placeholder="Age in years"></td>
				</tr>
                <tr>
					<td>Activity:</td>
					<td><select class = "input_form"  name="activity"><option value = "1">Little or no exercise</option><option value = "2">Light exercise (1–3 days per week)</option><option value = "3">Moderate exercise (3–5 days per week)</option><option value = "4">Heavy exercise (6–7 days per week)</option><option value = "5">Very heavy exercise (twice per day, extra heavy workouts)</option></select></td>
				</tr>
			</table>
			<input id="sub_btn" type="submit" name="submit" value="Calculate Calorie">
			</form>
                </div>
            <div id ="result">
                
                <?php
                if (@$_POST['submit'] == "Calculate Calorie"){
                    echo "Result:".$bmr_res;
                }
                ?>
            </div>
            </div>
            
        </div>