<?php
    session_start();
    require_once('connect.php');
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
            <?php include "includes/headernew.php";
               $_SESSION['url'] = $_SERVER['REQUEST_URI'];
            ?>

            <!-- Main Section Part -->

            <div id="main_section">
              <div id="main_section_wrapper">

                <div id="main_section_left">
                    <!-- Inserting the main photo of the page -->

                    <?php

                        $sql = "SELECT * from recipe where date ORDER BY date DESC LIMIT 1";
                        $result = mysqli_query($con,$sql);
                    if ($result){
                        if ($row = mysqli_fetch_array($result)){

                            ?>

                   <a href="view.php?id=<?php echo $row['id']; ?>">
                    <div>
                        <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Latest Recipe">

                        <div id="recipe_title">
                            Latest Recipe

                            <span style="color: yellow;float: right;">&#x2605;&#x2605;&#x2605;&#x2605;&#x2606;</span>

                            <div style="clear: both;"></div>
                        </div>
                    </div>
                       </a>

                <?php
                        }
                    }else{
                        echo "Error in select statement of latest display";
                    }

                    $sql = "SELECT * FROM recipe ORDER BY date LIMIT 4";
                    $result = mysqli_query($con,$sql);

                    if ($result){
                        ?>
                             <div id="main_section_left_bottom">
                        <?php
                        while ($row = mysqli_fetch_array($result)){

                    ?>

                   
                       <a href="view.php?id=<?php echo $row['id']; ?>">
                        <div class="main_section_left_bottom_items" onclick = "javascript:void(0)">
                            <div class="main_section_left_bottom_items_image">
                                <img src="images_recipe/<?php echo $row['image'] ?>">
                            </div>
                            <div class="label"><?php echo $row['title']; ?>  </div>
                        </div>
                        </a>
                    

                <?php
                    }

                    ?>
                        </div>
                    <?php
                    }else{
                        echo 'Error in select statement of rating dishes display';
                    }
                    ?>
                    <div style="clear: both;"></div>

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
        <?php echo $errormessage; ?>

        <script type="text/javascript" src="scripts/scripts.js">
        </script>
        
        
        
        
        <div id="google-reviews"></div>

<link rel="stylesheet" href="https://cdn.rawgit.com/stevenmonson/googleReviews/master/google-places.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/stevenmonson/googleReviews/6e8f0d79/google-places.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDUhEwXGLCU6AvsA9XwSP_eXBX-vXn8XO8&signed_in=true&libraries=places"></script>

<script>
jQuery(document).ready(function( $ ) {
   $("#google-reviews").googlePlaces({
        placeId: 'ChIJ-Y2850eOVoYR_SAqZ9S0grc' //Find placeID @: https://developers.google.com/places/place-id
      , render: ['reviews']
      , min_rating: 4
      , max_rows:4
   });
});
</script>

    </body>
</html>
