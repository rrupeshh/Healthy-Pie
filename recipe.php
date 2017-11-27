<?php include 'connect.php'; 
session_start();
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


                        <div id="sub_search_section">

                          <input id="sub_search_section_text" type="text" placeholder="Search Recipies..." style="
                            float: left;width: 70%;

                            display: block;
  padding: 10px;
  font-size: 18px;
  border: 1px solid #e1e1e1;
  outline: none;
                            ">
                          <input type="submit" name="sub_search_submit" value="SEARCH" style="outline: none;border: none;padding: 12px;cursor: pointer;background:  #17C;color: #fff;font-weight: bold;float: left;width: 30%;">
                          <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div id = "main_section_left_articles">
                        <div id="recipe_header">
                            Recipe's Available:
                        </div>
                            <?php
                                $sql = "SELECT * FROM recipe ORDER by id desc";
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
