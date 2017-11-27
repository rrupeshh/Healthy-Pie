<?php include 'connect.php'; 
session_start();
$search = "";
if (isset($_POST['search_submit'])){
    $search = $_POST['search'];
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


            <!-- Main Section Part -->

            <div id="main_section">
              <div id="main_section_wrapper">

                <div id="main_section_left">
                    <div id="main_section_right_search">


                        
                    </div>

                    <div id = "main_section_left_articles">
                        
                        <div id="recipe_header">
                            Search Results: 
                        </div>
                          <?php
                                $sql = "SELECT * FROM recipe where keyword like '%$search%'";
                                $res = mysqli_query($con,$sql);
                                if ($res){
                                    while($row = mysqli_fetch_array($res)){
                                
                            ?> 
                                <div class ="article">
                                    <a href="view.php?id=<?php echo $row['id']; ?>">
                                    <div class = "article_image">
                                      <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Recipe Photo">
                                    </div>
                                  
                                    <div class = "article_content">
                                        
                                        <div class="article_content_name">
                                            <?php echo $row['title']; ?>
                                        </div>

                                        <div class="article_content_posted_by">
                                            Posted By: <?php 
                                                $u_Id = $row['user_id']; 
                                                $u_name = ucfirst(mysqli_fetch_assoc(mysqli_query($con,"SELECT firstname FROM register WHERE id='$u_Id'"))['firstname']).' '.ucfirst(mysqli_fetch_assoc(mysqli_query($con,"SELECT lastname FROM register WHERE id='$u_Id'"))['lastname']);
                                                echo '<span style="color: #555;font-weight: bold;">'.$u_name.'</span>';

                                            ?>
                                        </div>

                                        <div class="article_content_description">
                                            Ingredients: <?php echo '<span style="font-style: italic;color: #555;">'.$row['ingredients'].'</span>'; ?>
                                        </div>
                                        <div class="article_content_time">
                                            Time: <?php echo $row['time']; ?>
                                        </div>
                                        
                                    </div>

                                    <div style="clear: both;"></div>
                                    </a>
                                </div>

                            <?php
                                    }
                                }
                            ?>    
                        <?php 
                        
                        ?>
                    </div>


                </div>

                <div id="main_section_right">
                    <div id="main_section_right_search">
                        <div id="title">
                            Sort By
                        </div>

                        <div id="sub_search_section">
                            <select>
                                <option>Latest</option>
                                <option>A-Z</option>
                            </select>

                        </div>

                        <div style="clear: both;"></div>
                    </div>
                </div>

                <div style="clear: both;"></div>

              </div>
            </div>
            <?php include 'includes/footer.php'; //including the footer ?>
        </div>
        <script type="text/javascript" src="scripts/scripts.js">
        </script>
    </body>
</html>
