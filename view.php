<?php include 'connect.php'; 
session_start();

$errormessage = "";
//$_SESSION['url'] = $_SERVER['REQUEST_URI']."?id=".(isset($_SESSION['post_id'])?$_SESSION['post_id']:'');
$redirectId = $_GET['id'];
$_SESSION['post_id'] = $redirectId;

if (isset($_SESSION['username'])){
    echo '<script type="text/javascript"> logged_in = true;</script>';
}else{
    echo '<script type="text/javascript">logged_in=false;</script>';
}




if (isset($_POST['submit_comment'])){
    if ($_SESSION['username']){
    $comment = ($_POST['comment']);
    $username = $_SESSION['username'];
    $recipe_id = $redirectId;    
        
    $sql = "INSERT INTO comment (recipe_id,username,comment) values('$recipe_id','$username','$comment')";
    $result = mysqli_query($con,$sql);
        if (!$result){
            echo '<script>alert("Error In Comment") </script>';
        }
        
    }else{
        echo '
        <script>
        alert("User Not Logged In Login To continue...");
        </script>
        
        ';
        $_SESSION['comment'] = ($_POST['comment']);
        header('refresh:0,url=login_view.php');
        exit;
       
    }
}

if (isset($_POST['reply'])){
    if (isset($_SESSION['username'])){
    $cmnt_id = $_POST['cmnt_id'];
    $reply_text = $_POST['reply_text'];
    $username = $_SESSION['username'];
    $sql = "INSERT INTO reply (cmnt_id,username,reply_text) VALUES ('$cmnt_id','$username','$reply_text')";
    $result = mysqli_query($con,$sql);
    
    if(!$result){
        echo "Error CHECK:".mysqli_error($con);
    }
}else{
       echo '
        <script>
        alert("User Not logged In!  Login To continue");
        </script>
        
        ';
        $_SESSION['comment'] = test_input($_POST['comment']);
        header('refresh:0,url=login_view.php');  
        exit;
    }
}

?>


<?php 
// for the like buttons with color

$like_image = '<img src="Photos/Like And Dislike/Default Like.png" style="width: 4%;">';
$dislike_image = '<img src="Photos/Like And Dislike/Default Dislike.png" style="width: 4%;">';

if(isset($_SESSION['username'])) {
    $uName = $_SESSION['username'];
    $uId = mysqli_fetch_assoc(mysqli_query($con,"SELECT id FROM register WHERE username='$uName'"))['id'];

    $like_result = mysqli_query($con,"SELECT * FROM liked WHERE post_id = '$redirectId' AND user_id = '$uId'");

    if(mysqli_num_rows($like_result) == 1) {
        $like_result_like = mysqli_fetch_assoc($like_result)['like_num'];
        $like_result_dislike = mysqli_fetch_assoc($like_result)['dislike_num'];

        if($like_result_like == 1 AND $like_result_dislike == 0) {
            $like_image = '<img src="Photos/Like And Dislike/Liked.png" style="width: 4%;">';
            $dislike_image = '<img src="Photos/Like And Dislike/Default Dislike.png" style="width: 4%;">';
        } else {
            $like_image = '<img src="Photos/Like And Dislike/Default Like.png" style="width: 4%;">';
            $dislike_image = '<img src="Photos/Like And Dislike/Disliked.png" style="width: 4%;">';
        }
    }
                                                   
} else {
    $like_image = '<img src="Photos/Like And Dislike/Default Like.png" style="width: 4%;">';
    $dislike_image = '<img src="Photos/Like And Dislike/Default Dislike.png" style="width: 4%;">';
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        
        <link rel="stylesheet" href="styles/styles.css">
       <link rel="stylesheet" href="styles/comment.css">
        <link rel="stylesheet" href="styles/tag.css">
        
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
                            Recipe
                        </div>
                          <?php
                            if (isset($_GET)){
                                $id = $_GET['id'];

                                $sql = "SELECT * FROM recipe WHERE id='$id'";
                                $res = mysqli_query($con,$sql);
                                if ($res){
                                    while($row = mysqli_fetch_array($res)){
                                        $postCalorie = $row['total_calorie'];
                                
                            ?> 
                    </div>
                        <div class ="view_article">

                            <div class = "view_article_image">
                              <img src="images_recipe/<?php echo $row['image']; ?>" style="width: 100%;" alt="Recipe Photo">
                            </div>
                          
                            <div class = "view_article_content">
                              <div class="view_article_content_name">
                                <?php echo $row['title'] . '|<span style="font-size: 14px;font-style: italic;">Calorie: ' . $row['total_calorie'].'</span>'; ?>
                              </div>
                                <div class="view_article_content_ingredients">
                                    <span style="font-weight: bold;">Ingredients: </span><?php echo '<span style="font-style: italic;">'.$row['ingredients'].'</span>'; ?>
                                </div>
                              <div class="view_article_content_description">
                                <span style="font-weight: bold;color: #10274c;display: block;border-bottom: 1px solid #f1f1f1;">Directions:</span> <br><?php echo $row['direction']; ?>
                              </div>
                               <div class="view_article_like_dislike">
                                    <a href="like_dislike.php?status=1" onclick="return check_login()">
                                        <?php echo $like_image; ?>
                                    </a>
                                    <span style="padding: 10px;">
                                           <?php 
                                                $sql_c = "SELECT count(like_num) as lik_num FROM liked WHERE like_num='1' and post_id='$redirectId'";
                                                $result1 = mysqli_query($con,$sql_c);
                                                if ($result1){
                                                    while($row = mysqli_fetch_array($result1)){
                                                        echo  '<span style="color: #444;">'.$row['lik_num'].'</span>';
                                                            
                                                    }
                                                }else{
                                                    echo "Error in Counting Check: ".mysqli_error($con);
                                                }
                                        
                                           ?>
                                   </span>


                                   <a href="like_dislike.php?status=0" onclick="return check_login()">
                                        <?php echo $dislike_image; ?>
                                    </a>
                                   <span>
                                           <?php 
                                                  $sql_c = "SELECT count(dislike_num) as dis_num FROM liked WHERE dislike_num='1' and post_id='$redirectId'";
                                            $result1 = mysqli_query($con,$sql_c);
                                            if ($result1){
                                                while($row = mysqli_fetch_array($result1)){
                                                    echo  '<span style="color: #444;">'.$row['dis_num'].'</span>';
                                                        
                                                }
                                            }else{
                                                echo "Error in Counting Check: ".mysqli_error($con);
                                            }
                                        
                                           ?>
                                   </span>
                                </div>
                            </div>

                            <div style="clear: both;"></div>
                            
                    </div>
                    
                            <div class="holder">
                                <div class="post_comment">
                                    
                                    <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=$redirectId" ?>' onsubmit="return check_login()">
                                        <textarea class="comment_insert" type="text" name="comment" placeholder="Post Comment...." value="<?php echo ($_SERVER['HTTP_REFERER'] == 'http://localhost/series/Healthy%20Pie%202/login_view.php')?@$_SESSION['comment']:'' ?>"></textarea>  <!-- change url here on change in directory-->

                                        <input type="submit" name="submit_comment" value="POST"> 

                                        <div style="clear: both;"></div>
                                    </form>    
                                </div>
                                
                                <div class="comment">
                                    <div class="title">Comments:</div>
                                    
                                    <?php 
                                     //$sql = "SELECT * FROM recipe JOIN register ON register.id = recipe.id JOIN profile ON register.id=profile.id JOIN comment ON comment.recipe_id = recipe.id where recipe.id='$redirectId'";
                                        $sql = "SELECT * FROM recipe JOIN comment on comment.recipe_id = recipe.id JOIN register ON register.username = comment.username JOIN profile ON register.id=profile.id WHERE recipe.id='$redirectId'";
                                        $result = mysqli_query($con,$sql);
                                        $loop = 0;
                                            if (!$result){
                                                echo "<script>alert('Error in select sql statement')</script>";
                                            }else{
                                                while($row = mysqli_fetch_array($result)){
                                                 ?>
                                        <div class="main">
                    
                                        <div class="individual_comment">
                                            <div class="individual_comment_image">
                                                <?php 
                                                    if($row['image']==null) {
                                                        ?>
                                                            <img src="Profile/user_logo.bmp">
                                                        <?php
                                                    } else {
                                                        ?>  
                                                            <img src="Profile/<?php echo $row['image']; ?>">
                                                        <?php
                                                    }
                                                ?>
                                                
                                            </div>
                                            <div class="individual_comment_content">
                                                <div class="individual_comment_content_name"><?php echo ucfirst($row['firstname']) ." ".ucfirst($row['lastname']); ?></div>
                                                <div class="individual_comment_content_post">
                                                    <?php  echo $row['comment']; ?>
                                                </div>
                                                <div class="individual_comment_content_reply" >
                                                     <a href="javascript:void(0)" onclick="check(<?php echo $loop ?>)">
                                                        &rdsh; Replies
                                                     </a>
                                                    <div class="reply_wrapper">
                                                    <?php
                                                            $cmnt_id = $row['cmnt_id'];
                                                           $sql1 = "SELECT * FROM reply JOIN register ON reply.username=register.username JOIN profile ON register.id = profile.id where reply.cmnt_id='$cmnt_id'";
                                                $result1 = mysqli_query($con,$sql1);
                                                if (!$result1){
                                                    echo "Error In sql1 statement CHECK:".mysqli_error($con);
                                                }else{
                                                    while($val = (mysqli_fetch_array($result1))){
                                                ?>     
                                                        <div class="individual_reply">
                                                          
                                                            <div class="individual_reply_image">
                                                                <?php 
                                                                    if($val['image']==null) {
                                                                        ?>
                                                                            <img src="Profile/user_logo.bmp">
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                            <img src="Profile/<?php echo $val['image']; ?>">
                                                                        <?php
                                                                    }
                                                                ?>
                                                                
                                                            </div>

                                                            <div class="individual_reply_content">

                                                                <div class="individual_reply_content_name">
                                                                    <?php echo ucfirst($val['firstname']) ." ". ucfirst($val['lastname']); ?>
                                                                </div>

                                                                <div class="individual_reply_content_date">Posted On:
                                                                    <?php echo '<span style="color: #888;font-size: 14px;font-style: italic;">'.date("Y-m-d",strtotime($val['reply_date'])).'</span>'; ?>
                                                                </div>

                                                                <div class="individual_reply_content_content">
                                                                    <?php echo $val['reply_text']; ?>
                                                                </div>
                                                            </div>

                                                            <div style="clear:both"></div> 
                                                         </div>
                                                    
                                                        <?php 
                                                    }
                                                }
                                                        ?>
                                                    
                                                        <div class="reply_form">
                                                            <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=$redirectId" ?>' method="POST" onsubmit="return check_login()">
                                                                <input type='hidden' value='<?php echo $row['cmnt_id']?>' name='cmnt_id'>
                                                                
                                                                <div class="individual_reply_post_form">
                                                                   <input name="reply_text" placeholder="Write a reply..." required>
                                                                </div>

                                                                <input type="submit" name="reply" value="Reply">

                                                                <div style="clear:both"></div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div style="clear:both"></div>

                                            </div>
                                        </div>
                                        <?php
                                                            $loop++;
                                                }
                                            }
                                ?>
                                    
                                </div>
                                
                                
                                
                            </div>
                            
                
                            <?php
                                    }
                                }
                        }
                            ?>    
                      

                </div> 

                <div id="main_section_right">
                    <div id="main_section_right_search" style="width:'50%'">
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

                    <div id="suggestion_section" style="margin-top: 10px;">
                        <div id="suggestion_section_title">
                            <h3>Similar Suggestions Based On Calorie</h3>
                        </div>

                        <div class="suggestion_content">
                            <?php 
                                $start = $postCalorie - 100;
                                $end = $postCalorie + 100;

                                $res = mysqli_query($con, "SELECT * FROM recipe WHERE NOT id = $redirectId AND total_calorie BETWEEN $start AND $end");
                                
                                if(mysqli_num_rows($res) > 0) {
                                    while($row=mysqli_fetch_assoc($res)) {
                                        $suggestion_id = $row['id'];
                                        $suggestion_image = $row['image'];
                                        $suggestion_name = $row['title'];
                                        $suggestion_calorie = $row['total_calorie'];
                                        ?>
                                            <div style="cursor: pointer;" class="suggestion_content_each" onclick="location.href='view.php?id=<?php echo $suggestion_id; ?>'">
                                                <div class="suggestion_content_each_image">
                                                    <img src="images_recipe/<?php echo $suggestion_image; ?>" style="width: 100%;">
                                                </div>
                                                <div class="suggestion_content_each_info">
                                                    Name: <?php echo $suggestion_name; ?>
                                                    Calorie: <?php echo $suggestion_calorie; ?>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    echo 'Nothing in Suggestions';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>

                <div style="clear: both;"></div>

              </div>
                <div><?php echo $errormessage; ?></div>
            </div>

            <?php include 'includes/footer.php'; //including the footer ?>
        </div>
        
        <script type="text/javascript">
            function check(i){
                var x = document.getElementsByClassName('reply_wrapper')[i];
                x.style.display = "block";
            }
                
            function check_login(){
                if (logged_in){
                    return true;
                }else{
                    open_login_popup();
                   return false;
                }
            }
        </script>
    </body>
</html>
