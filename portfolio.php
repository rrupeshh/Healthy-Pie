<?php 
    session_start();

    if (!isset($_SESSION['username'])){
        echo '<script>alert("Unauthorised access! Login To continue")</script>';
        header('refresh:0,url=Index.php');
    } 
?>
<?php 
    include 'connect.php';
    $reg_id = $_SESSION['user_id'];
?>
<?php 
    if(isset($_POST['portfolio_submit'])) {
        $user_height = $_POST['user_height'];
        $user_weight = $_POST['user_weight'];
        $user_age = $_POST['user_age'];
        $user_sex = $_POST['user_sex'];
        $user_activity = $_POST['user_activity'];

        if($user_sex == 'male') {
            $bmr =  (66.4730+(13.7516 * $user_weight)+(5.0033 * $user_height)-(6.7550 * $user_age));
            if($user_activity == "1"){
               $act = 1.2;
            }elseif($user_activity == "2"){
                 $act = 1.375;
            }elseif($user_activity == "3"){
                 $act = 1.55;
            }elseif($user_activity == "4"){
                 $act = 1.725;
            }elseif($user_activity == "5"){
                 $act = 1.9;
            }

            $bmr_cal = $bmr * $act;
            $bmr_res = round($bmr_cal);
        } elseif ($user_sex == 'female') {
            $bmr =  (655.0955+(9.5634 * $weight)+(1.8496 * $height)-(4.6756 * $age));
            if($user_activity == "1"){
               $act = 1.2;
            }elseif($user_activity == "2"){
                 $act = 1.375;
            }elseif($user_activity == "3"){
                 $act = 1.55;
            }elseif($user_activity == "4"){
                 $act = 1.725;
            }elseif($user_activity == "5"){
                 $act = 1.9;
            }
            $bmr_cal = $bmr * $act;
            $bmr_res = round($bmr_cal);
        }

        //to calculate bmi
        $weight_bmi = $user_weight;
        $height_bmi = $user_height * 0.01;
        $bmi_res = $weight_bmi/($height_bmi * $height_bmi);
        $bmi = round($bmi_res,2);

        //inserting into the profile
        $sql = "INSERT INTO portfolio_profile VALUES (NULL, '$reg_id', '$user_height', '$user_weight', '$user_age', '$user_sex', '$user_activity', '$bmr_res', '$bmi')";
        mysqli_query($con, $sql) or die("Error!");

        $portfolio_id = mysqli_fetch_assoc(mysqli_query($con,"SELECT portfolio_id FROM portfolio_profile WHERE reg_id='$reg_id'"))['portfolio_id'];

        mysqli_query($con,"INSERT INTO portfolio_userbmi VALUES (NULL, '$portfolio_id', '$bmi')") or die("Error in inserting into userbmi!");
    }

    if(isset($_POST['portfolio_update'])) {
        $reg_id = $_SESSION['user_id'];
        $user_height = $_POST['user_height'];
        $user_weight = $_POST['user_weight'];
        $user_age = $_POST['user_age'];
        $user_sex = $_POST['user_sex'];
        $user_activity = $_POST['user_activity'];

        if($user_sex == 'male') {
            $bmr =  (66.4730+(13.7516 * $user_weight)+(5.0033 * $user_height)-(6.7550 * $user_age));
            if($user_activity == "1"){
               $act = 1.2;
            }elseif($user_activity == "2"){
                 $act = 1.375;
            }elseif($user_activity == "3"){
                 $act = 1.55;
            }elseif($user_activity == "4"){
                 $act = 1.725;
            }elseif($user_activity == "5"){
                 $act = 1.9;
            }

            $bmr_cal = $bmr * $act;
            $bmr_res = round($bmr_cal);
        } elseif ($user_sex == 'female') {
            $bmr =  (655.0955+(9.5634 * $weight)+(1.8496 * $height)-(4.6756 * $age));
            if($user_activity == "1"){
               $act = 1.2;
            }elseif($user_activity == "2"){
                 $act = 1.375;
            }elseif($user_activity == "3"){
                 $act = 1.55;
            }elseif($user_activity == "4"){
                 $act = 1.725;
            }elseif($user_activity == "5"){
                 $act = 1.9;
            }
            $bmr_cal = $bmr * $act;
            $bmr_res = round($bmr_cal);
        }

        //to calculate bmi
        $weight_bmi = $user_weight;
        $height_bmi = $user_height * 0.01;
        $bmi_res = $weight_bmi/($height_bmi * $height_bmi);
        $bmi = round($bmi_res,2);

        $sqlupdate = "
            UPDATE portfolio_profile 
            SET 
            user_height = '$user_height',
            user_weight = '$user_weight',
            user_age = '$user_age',
            user_activity = '$user_activity',
            calorie_needed = '$bmr_res',
            user_bmi = '$bmi'
            WHERE reg_id = '$reg_id'
        ";
        mysqli_query($con, $sqlupdate) or die("Error In Updating!");

        $portfolio_id = mysqli_fetch_assoc(mysqli_query($con,"SELECT portfolio_id FROM portfolio_profile WHERE reg_id='$reg_id'"))['portfolio_id'];

        mysqli_query($con,"INSERT INTO portfolio_userbmi VALUES (NULL, '$portfolio_id', '$bmi')") or die("Error in inserting into userbmi!");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" type="text/css" href="styles/portfolio.css">
    </head>
    <body onload="doSomething(<?php echo $reg_id; ?>)">
        <div id="wrapper">
            <?php include "includes/headernew.php"; ?>
            
            <div id="main_section">
              <div id="main_section_wrapper">

                <div id="main_section_left">
                    <div id="port_folio">
                    <?php 
                        if( isset($_GET['edit']) && $_GET['edit']=='portfolio_edit') {
                            ?>
                                <fieldset style="padding: 10px;">
                                    <legend>Edit Your Portfolio</legend>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        Height: <input type="text" name="user_height" placeholder="in cm" required> <br><br>
                                        Weight: <input type="text" name="user_weight" placeholder="in kg" required> <br><br>
                                        Age: <input type="text" name="user_age" placeholder="in years" required> <br><br>
                                        Sex: 
                                        <select name="user_sex"> 
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <br><br>
                                        Your Activity:
                                         <select name="user_activity">
                                            <option value = "1" selected>Little or no exercise</option>
                                            <option value = "2">Light exercise (1–3 days per week)</option>
                                            <option value = "3">Moderate exercise (3–5 days per week)</option>
                                            <option value = "4">Heavy exercise (6–7 days per week)</option>
                                            <option value = "5">Very heavy exercise (twice per day, extra heavy workouts)</option>
                                        </select>
                                        <br><br>
                                        
                                        <?php 
                                            $result = mysqli_query($con, "SELECT * FROM portfolio_profile WHERE reg_id='$reg_id'");

                                            if(mysqli_num_rows($result) == 0) {
                                                ?>
                                                    <input type="submit" name="portfolio_submit" value="Submit">
                                                <?php
                                            } else {
                                                ?>
                                                    <input type="submit" name="portfolio_update" value="Update">
                                                    <div style="clear: both;"></div>
                                                <?php
                                            }
                                        ?> 
                                         <a class="portfolio_link" href="portfolio.php">Done!</a>
                                    </form>
                                </fieldset>
                            <?php
                        } else {
                            ?>
                                <h3>Edit: </h3>
                                <a class="portfolio_link" href="portfolio.php?edit=portfolio_edit">Edit Your Portfolio</a>
                            <?php
                        }
                    ?>

                    

                    <div id="suggestion_section" style="margin-top: 10px;">
                        <?php 
                            $cal_needed = mysqli_fetch_assoc(mysqli_query($con, "SELECT calorie_needed FROM portfolio_profile WHERE reg_id='$reg_id'"))['calorie_needed'];
                        ?>

                        <h2>How much calorie should I get Daily ? </h2>
                        <p>Ans: <?php echo $cal_needed; ?> / day</p>
                        <br><br>
                        <h2>Hey, <?php echo $_SESSION['username']; ?> ! We got some suggestion for you :</h2>
                        <br>

                        <?php 
                            $start = $cal_needed - 200;
                            $end = $cal_needed + 200;

                            $result = mysqli_query($con, "SELECT * FROM recipe WHERE total_calorie BETWEEN $start AND $end");

                            if(mysqli_num_rows($result) == 0) {
                                ?>
                                    <div>
                                        <h3>Sorry, Today we got no suggestion! Come Back Later!</h3>
                                    </div>
                                <?php
                            } else {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $recipe_id = $row['id'];
                                    ?>
                                        <div class="suggestion_each" style="cursor: pointer;" onclick="location.href='view.php?id=<?php echo $recipe_id; ?>'">
                                            <div class="suggestion_each_title">
                                                <?php echo $row['title']; ?>
                                            </div>
                                            <div class="suggestion_each_image">
                                                <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 20%;">
                                            </div>
                                            <div class="suggestion_each_info">
                                                Calorie: <?php echo $row['total_calorie']; ?>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        ?>

                        
                    </div>

                    <div id="user_bmi_section" style="margin-top: 10px;">
                        <?php 
                            $u_bmi = mysqli_fetch_assoc(mysqli_query($con, "SELECT user_bmi FROM portfolio_profile WHERE reg_id='$reg_id'"))['user_bmi'];
                        ?>
                        <h3>What is my BMI?</h3>
                        <p>Ans: <?php echo $u_bmi; ?></p>
                        <br>
                        <h3>My BMI Graph:</h3>

                        <div id="bmi_graph">
                            <div id="chartcontainer">Your browser doesn't support chart!</div>
                        </div>
                    </div>
                </div>

                <div id="main_section_right">
                    
                </div>

                <div style="clear: both;"></div>
                </div>
              </div>
            </div>

            <?php include 'includes/footer.php'; //including the footer ?>
            
        </div>
        <script type="text/javascript" src="scripts/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="scripts/jscharts.js"></script>
        <script type="text/javascript" src="scripts/chart.js"></script>
    </body>
</html>