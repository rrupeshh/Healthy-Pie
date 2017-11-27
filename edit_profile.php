<?php 
    session_start();
    require_once("connect.php");
   
    
if(isset($_SESSION['username'])){
         $msg = "";
    $o_birthplace = $o_contact = $o_usersex = $o_dob = $_biography = $_image = "";
    
        $user_id = $_SESSION['user_id'];
        $sq = "SELECT * FROM profile where id = '$user_id'";
        $res = mysqli_query($con,$sq);
    
    if ($res){
        while ($row = mysqli_fetch_array($res)){
            $o_birthplace = $row['birthplace'];
            $o_usersex = $row['usersex'];
            $o_contact = $row['contact'];
            $o_usersex = $row['usersex'];
            $o_dob = $row['dob'];
            $o_biography = $row['biography'];
            $o_image = $row['image'];
        }
    }else{
        $msg =  "Error in seleccting old datas";
    }
    

    if (isset($_POST['submit'])){
        
        $target = "Profile/".basename($_FILES['image']['name']);
        $birthplace = $_POST['birthplace'];
        $contact = $_POST['contact'];
        $usersex = $_POST['usersex'];
        $dob = $_POST['dob'];
        $biography = $_POST['biography'];
        $image = $_FILES['image']['name'];
        
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE profile SET  id='$user_id', birthplace='$birthplace', contact='$contact', usersex='$usersex', dob='$dob', biography='$biography', image='$image' WHERE id='$user_id'";
        
        $result = mysqli_query($con,$sql);
        if (!$result){
            $msg = "Error in Insert Statement";
        }else{
            $msg = "Succesfully updated";
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "Image Uplodaded";
            header('refresh:0,url=profile.php');
        }else{
            $msg = "Error in uplodaing Image";
        }
        
        
    }
    }else{
        header('location:Index.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" type="text/css" href="styles/edit_profile.css">
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
    				    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
                            <table class="update_profile_table">
                                <tr>
                                    <td>Birthplace</td>
                                    <td><input type="text" name="birthplace" placeholder="Birthplace..." required value="<?php echo $o_birthplace ;?>"></td>           
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td><input type="text" name="contact" placeholder="Contact Number..." value="<?php echo $o_contact ?>"></td>
                                </tr>
                                <tr>
                                    <td>UserSex
                                    </td>
                                    <td>
                                        <input id="male" type="radio" name="usersex" value="male" required>
                                        <label for="male">Male</label>
                                        <input id="female" type="radio" name="usersex" value="female">
                                        <label for="female">Female</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth :</td>
                                    <td><input type="date" name="dob" placeholder="YY-MM-DD" required value="<?php echo $o_date ?>"></td>
                                </tr>
                                <tr>
                                    <td>Biography</td>
                                    <td><textarea name="biography" placeholder="Your Biography..." rows="4" cols="40"><?php echo $o_biography; ?></textarea></td>
                                </tr>
                                <tr>
                                <td>Image</td>
                                <td>
                                    <input style="display: none" id="file" type="file" name="image" required>
                                    <label for="file">Choose A File...</label>
                                </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><input type="reset" name="reset" value="Reset"><input type="submit" name="submit" id="submit" value="Submit"></td>
                                </tr>
                            </table>
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
            </div>

            <?php include 'includes/footer.php'; //including the footer ?>
        </div>
        <script type="text/javascript" src="scripts/scripts.js">
        </script>
    </body>
</html>
