<?php include 'connect.php'; 
    session_start();
?>

<?php 
    $userId = $_SESSION['user_id'];
    $question_id = $_GET['question_id'];

    if(isset($_POST['submit_reply'])) {
        $reply = $_POST['reply'];
        $date = date('y-m-d');

        mysqli_query($con, "INSERT INTO forum_answer VALUES (NULL,'$userId','$reply','$date','$question_id')");
        header('Location: discussion_reply.php?question_id='.$question_id);
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
                            <div class="title">
                                <?php 
                                    $question = mysqli_fetch_assoc(mysqli_query($con, "SELECT question FROM forum_question WHERE que_id='$question_id'"))['question'];
                                    echo $question;
                                ?>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']). '?question_id='.$question_id; ?>" method="post">
                                <textarea class="comment_insert" type="text" name="reply" placeholder="Write a reply..." onsubmit="return check_login()" required></textarea>  <!-- change url here on change in directory-->

                                <input type="submit" name="submit_reply" value="Reply"> 

                                <div style="clear: both;"></div>
                            </form>
                        </div>

                        <div class="forum_question_display">
                            <div class="title">Replies:</div>

                            <?php 
                                $result = mysqli_query($con, "SELECT * FROM forum_answer INNER JOIN register ON forum_answer.reg_id = register.id WHERE forum_answer.que_id='$question_id' ORDER BY forum_answer.reply_id DESC");

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
                                                        <?php echo $row['reply']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                } else {
                                    echo '<div style="padding:10px;font-weight: bold;color: #666;">No Replies...</div>';
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