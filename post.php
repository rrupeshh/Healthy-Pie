<?php 
    session_start();

    if (!isset($_SESSION['username'])){
        echo '<script>alert("Unauthorised access! Login To continue")</script>';
        header('refresh:0,url=Index.php');
    } 
?>
<?php 
    include 'connect.php';

    if(isset($_POST['submit'])) {
        $ingredient = $_POST['ingredient'];
        $amount = $_POST['amount'];

        if(sizeof($ingredient) == sizeof($amount)) {
            $totalcalorie = 0;

            for($i = 0; $i < sizeof($ingredient); $i++) {

                //for ingredient
                $eachingredient = $ingredient[$i];
                $eachingredient = strtolower($eachingredient);
                $eachingredient = ucfirst($eachingredient);

                //for amount
                $eachingredientamount = $amount[$i];


                //taking out the calorie from the table ingredient
                $calorie = mysqli_fetch_assoc(mysqli_query($con, "SELECT calorie FROM ingredients WHERE item_name='$eachingredient'"))['calorie'];

                //calculating the total calorie for each item inserted
                $totaleachcalorie = $calorie * $eachingredientamount;

                //summing to totalcalorie
                $totalcalorie += $totaleachcalorie;

            }

            $recipe_title = $_POST['recipe_title'];
            $recipe_direction = $_POST['recipe_direction'];
            $recipe_preparation_time = $_POST['recipe_preparation_time'];
            $recipe_keywords = $_POST['recipe_keywords'];
            $recipe_ingredients = join(', ', $ingredient);
            $user_id = $_SESSION['user_id'];

            //for image
            $target = "images_recipe/".basename($_FILES['recipe_image']['name']);
            $recipe_image = $_FILES['recipe_image']['name'];

            if(!empty($recipe_image)) {
                $sql = "INSERT INTO recipe VALUES (NULL,'$recipe_title','$recipe_ingredients','$recipe_direction','$recipe_preparation_time','$recipe_image',$user_id,now(),'$recipe_keywords','$totalcalorie')";

                mysqli_query($con,$sql) or die(mysqli_error($con));

                if(move_uploaded_file($_FILES['recipe_image']['tmp_name'],$target)) {
                    if($res) {
                        $errormessage = "Updated successfully";
                        echo '<script>alert("Successfully Inserted!")</script>';
                    } else {
                        $errormessage = "Couldnt update check:".mysqli_error($con);
                    }
                } else {
                    $errormessage = "Error in Image Insertion";
                }
            } else {
                $errormessage = "Image is empty";
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
        <style type="text/css">
            input[class="item"], input[class="amount"] {
                margin: 10px;
                padding: 4px;
            }

            button#add_more, button[class="remove_button"], input[value="POST"] {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include "includes/headernew.php"; ?>
            
            <div id="main_section">
              <div id="main_section_wrapper">

                <div id="main_section_left">
                    <!-- Sample for the ajax input 
                    <input onkeypress="showSomething(event);" onkeyup=" 
                                        if(this.value!='') {
                                            load(this.value);
                                        }
                                        
                                    " id="item_name" type="text" name="item_name" placeholder="Item Name" >
                    
                    <?php //echo '-'; ?>
                    
                    <input id="item_amt" type="text" name="item_amt" disabled>-->

                    

                    <!-- Posting the recipe -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                        <!-- Title -->
                        <label for="recipe_title">Title: </label>
                        <input id="recipe_title" type="text" name="recipe_title" placeholder="Choose A Title..." required> 
                        <br><br>

                        <h3>Add the ingredients</h3>

                        <!-- Ingredients -->
                        <div id="ingredients">
                            <div class="ingredients_each">
                                <input class="item" type="text" name="ingredient[]" placeholder="Item" required>
                                <input class="amount" type="text" name="amount[]" placeholder="Amount" required>
                                <button id="add_more" type="button">Add More</button>
                            </div>
                        </div>
                        <br><br>

                        <label for="recipe_direction">Direction: </label>
                        <textarea id="recipe_direction" name="recipe_direction" cols="40" rows="3" placeholder="Directions..." required></textarea>
                        <br><br>

                        <label for="recipe_image">Choose Image: </label>
                        <input id="recipe_image" type="file" name="recipe_image" required>
                        <br><br>

                        <label for="recipe_preparation_time">Preparation Time: </label>
                        <input id="recipe_preparation_time" type="text" name="recipe_preparation_time" placeholder="Preperation time...." required>
                        <br><br>

                        <label for="recipe_keywords">Keywords: </label>
                        <input id="recipe_keywords" type="text" name="recipe_keywords" placeholder="Keywords" required>
                        <br><br>

                        <input type="submit" name="submit" value="POST">
                    </form>
                </div>

                <div id="main_section_right">
                    <div id="main_section_right_search">
                        <div id="title">
                            Search Here
                        </div>

                        <div id="sub_search_section">

                          <input type="text" placeholder="Search...">
                          <input type="submit" name="sub_search_submit" value="SEARCH">

                          <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>

                <div style="clear: both;"></div>

              </div>
            </div>
            <?php include 'includes/footer.php'; //including the footer ?>
            
        </div>
        <script type="text/javascript" src="scripts/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="scripts/scripts.js">
        </script>
        <script type="text/javascript" src="scripts/post_server.js">
        </script>
    </body>
</html>