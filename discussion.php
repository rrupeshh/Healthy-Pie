<?php include 'connect.php'; 
    session_start();
?>

<?php 
    $userId = $_SESSION['user_id'];

    if(isset($_POST['submit_question'])) {
        $question = $_POST['question'];
        $date = date('y-m-d');
        mysqli_query($con, "INSERT INTO forum_question VALUES (NULL,'$userId','$question','$date',0)") or die("Error!");

        header('Location: discussion.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta chrset="utf-8">
        <title>www.HealthyPie.com</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" type="text/css" href="styles/forum_question.css">
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


                    <div id="forum_question">
                        <div class="forum_question_insert">
                            <div class="title">Post a Question:</div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <textarea class="comment_insert" type="text" name="question" placeholder="Post Questions...." onsubmit="return check_login()" required></textarea>  <!-- change url here on change in directory-->

                                <input type="submit" name="submit_question" value="POST"> 

                                <div style="clear: both;"></div>
                            </form>
                        </div>

                        <div class="forum_question_display">
                            <div class="title">Questions:</div>

                            <?php 
                                $result = mysqli_query($con, "SELECT * FROM forum_question INNER JOIN register ON forum_question.reg_id = register.id ORDER BY forum_question.reg_id DESC");

                                if(mysqli_num_rows($result) > 0) {
                                    while($row=mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="each_forum_question">

                                                <div class="each_forum_question_image">
                                                    <?php 
                                                        $uId = $row['reg_id'];
                                                        $result_image = mysqli_fetch_assoc(mysqli_query($con, "SELECT image FROM profile WHERE id = '$uId'"))['image'];

                                                        if($result_image == null) {
                                                            ?>
                                                                <img src="Profile/user_logo.bmp">
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <img src="Profile/<?php echo $result_image; ?>">
                                                            <?php
                                                        }

                                                    ?>
                                                    
                                                </div>

                                                <div class="each_forum_question_content">
                                                    <div class="each_forum_question_content_name">
                                                        <?php echo ucfirst($row['firstname']).' '.ucfirst($row['lastname']); ?>
                                                    </div>

                                                    <div class="each_forum_question_content_content">
                                                        <a href="discussion_reply.php?question_id=<?php echo $row['que_id']; ?>">
                                                            <?php echo $row['question']; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    echo '<div style="padding:10px;font-weight: bold;color: #666;">No Comments Posted!</div>';
                                }
                            ?>
                        </div>
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
