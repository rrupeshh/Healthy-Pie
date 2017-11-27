<?php 
    session_start();
    require_once('connect.php');
    if (isset($_SESSION['username'])){
        
    }else{
        header('Location:Index.php');
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
            <?php include "includes/headernew.php";
               $_SESSION['url'] = $_SERVER['REQUEST_URI'];
            ?>

            <!-- Main Section Part -->

            <div id="main_section">
              <div id="main_section_wrapper">

                <div id="main_section_left">
                    <!-- Inserting the main photo of the page -->
                    
                    
                    <!--Profile Section Starts Here. -->
                    <div id="wrap">
                        <div id="center">
                              <?php 
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT * FROM profile JOIN register ON profile.id = register.id WHERE register.id='$user_id'";
                                $result = mysqli_query($con,$sql);
                                    if (!$result){
                                           $errormessage = "Error in select statement of profile check: ".mysqli_error($con);
                                    }
                                    else{
                                        while($row = mysqli_fetch_array($result)){
                                            
                                     
                            ?>
                            <div class="first_div">
                                
                                <div class="user_image">
                                   <?php
                                        if ($row['image']==null) {
                                            echo '<img src="Profile/user_logo.bmp">';
                                        } else{
                                            ?>
                                                <img src="Profile/<?php echo $row['image']; ?>">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="user_name">
                                    <?php echo ucfirst(strtolower($row['firstname']))." ". ucfirst(strtolower($row['lastname'])); ?>
                                </div>
                            </div>

                            <div class="second_third">
                                <div class="second_div">
                                    <div style="position: relative;left: -5px;">Contact Number: <span><?php echo $row['contact']; ?></span> </div>
                                    <div>Birthplace: <span> <?php echo $row['birthplace']; ?></span></div>
                                    <div>Gender: <span><?php echo $row['usersex']; ?></span></div>
                                    <div>Date Of birth: <span> <?php echo $row['dob']; ?></span></div>
                                    <div>Biography: <span><?php echo $row['biography']; ?></span></div>
                                </div>
                                <div class="third_div">
                                    <div class='password'>
                                        Account Setting:
                                        <a href="chng_password.php">Change Password</a>
                                    </div>
                                    <div class="profile">
                                        Profile Setting
                                        <a href="edit_profile.php">Edit Profile</a>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    <?php 
                                    }
                                }
                    ?>
				</div>
                    <!--Profile Section Ends here -->
                </div>

                <div id="main_section_right">
                    <div id="main_section_right_search">
                        <div id="title">
                            Search Here
                        </div>

                        <div id="sub_search_section">

                          <input type="text" placeholder="Search...">
                          <input type="submit" name="sub_search_submit" value="SEARCH">
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
    </body>
</html>
