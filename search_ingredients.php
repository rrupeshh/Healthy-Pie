<?php include 'connect.php'; 
session_start();
$errormessage = "";

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" href="styles/tag.css">
        <link rel="stylesheet" href="styles_old/HealthyPie.css">
    </head>
    <body>
        <div id="wrapper">
             <?php include "includes/headernew.php"; ?>

            <!-- Main Section Part -->

            <div id="main_section">
              <div id="main_section_wrapper" style="height:auto;">

                <div id="main_section_left">
                    <div id="main_section_right_search">
                            

                        <div id="sub_search_section">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                            <div id="sub_search_section_text" class="tags-input" data-name="tags-input" style="
                            float: left;width: 70%;
                            display: block;
                            padding: 10px;
                            font-size: 18px;
                            border: 1px solid #e1e1e1;
                            outline: none;
                            "></div>
                          <input type="submit" name="submit" value="SEARCH" style="outline: none;border: none;padding: 12px;cursor: pointer;background:  #17C;color: #fff;font-weight: bold;float: left;width: 30%;">
                            </form>
                          <div style="clear: both;"></div>
                        </div>
                    </div>
                    <div id = "main_section_left_articles">
                        
                            <div id="recipe_header">
                                Recipe's Available:
                            </div>
                        <?php 
                            $num_count = 0;
                            if (isset($_POST['submit'])){
                            ?>
                                      <div style="padding: 5px 0px;
    font-weight: bold;
    color: #555;
    font-size: 20px">  Result for <?php echo "'".(isset($_POST['tags-input'])?$_POST['tags-input']:"Search...")."'"; ?>
                                        
                                        </div>
                            <?php
                                
                            }
                                if (isset($_POST['tags-input'])){
          $search = $_POST['tags-input'];
    $arr = explode(",",$search);
    $count = 0;
    $length = count($arr);
    $sql = "SELECT * FROM recipe";
    $result = mysqli_query($con,$sql);    
    if ($result){
        while($row = mysqli_fetch_array($result)){
            $count = 0;
            $post_ingredient = $row['ingredients'];
            $arr_post_ingredient = explode(",",$post_ingredient);
            $length_search = count($arr_post_ingredient);
                foreach ($arr as $value){
                    if(in_array($value,$arr_post_ingredient)){
                        $count++;
                    }
                }
               // echo $count."<br>";
                if (($count == $length) and ($length == $length_search)){
                    ?>
                <div class ="article" style="border:2px solid blue">
                            <a href="view.php?id=<?php echo $row['id']; ?>">
                            <div class = "article_image">
                              <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Recipe Photo">
                            </div>
                          
                            <div class = "article_content">
                              <div class="article_content_name">
                                <?php echo $row['title']; ?>
                              </div>
                              <div class="article_content_description">
                                <?php echo $row['ingredients']; ?>
                              </div>
                                <div class="article_content_time">
                                    <?php echo $row['time']; ?>
                                </div>
                            </div>

                            <div style="clear: both;"></div>
                            </a>
                        </div>   
                
                <?php
                    ++$num_count;
               //writing for length<num code here for suggestion to exact length search
                }
                if (($count>$length_search and $count<$length_search+3)){
                ?>    
                <div class ="article">
                            <a href="view.php?id=<?php echo $row['id']; ?>">
                            <h3 style="margin-bottom:7px">Suggested Recipe!</h3>
                                <div class = "article_image">
                              <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Recipe Photo">
                            </div>
                          
                            <div class = "article_content">
                              <div class="article_content_name">
                                <?php echo $row['title']; ?>
                              </div>
                              <div class="article_content_description">
                                <?php echo $row['ingredients']; ?>
                              </div>
                                <div class="article_content_time">
                                    <?php echo $row['time']; ?>
                                </div>
                            </div>

                            <div style="clear: both;"></div>
                            </a>
                        </div>   
        <?php   
                    ++$num_count;
                }
            if ((($count<$length_search and $count>$length_search-2))){
        ?>
            <div class ="article" style="border:2px solid red">
                            <a href="view.php?id=<?php echo $row['id']; ?>">
                                <h3 style="margin-bottom:7px">Suggested Recipe!</h3>
                            <div class = "article_image">
                              <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Recipe Photo">
                            </div>
                          
                            <div class = "article_content">
                              <div class="article_content_name">
                                <?php echo $row['title']; ?>
                              </div>
                              <div class="article_content_description">
                                <?php echo $row['ingredients']; ?>
                              </div>
                                <div class="article_content_time">
                                    <?php echo $row['time']; ?>
                                </div>
                            </div>

                            <div style="clear: both;"></div>
                            </a>
                        </div>    
        <?php
                ++$num_count;
                }
           
            }   
        if (!($num_count>0)){
            echo '<div style="padding: 10px 0px;font-weight: bold;color: #1a4a7a;">&rdsh; No result to display</div>';
        }
        }
    }
                        
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

                <div style="clear: both;min-height: 80px"></div>

              </div>
            </div>
            <?php include 'includes/footer.php'; //including the footer ?>
        </div>
        <script type="text/javascript" src="tag_js.php"></script>
        <script type="text/javascript" src="scripts/scripts.js">
        </script>
    </body>
</html>
