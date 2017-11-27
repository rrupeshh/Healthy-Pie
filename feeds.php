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
        
<!--       Style for form fields starts here -->
        
        <style>
            table{
                width:100%;
            }
            tr,td{
            margin: 5%;
            }
            table input[type="text"] ,input[type="email"] , textarea{
                padding:2%;
                width: 60%;
                
            }
            
            table input[type="submit"],[type="reset"] {
              font-family: "Trebuchet MS";
              margin-top:20px;
                margin-right:10px;
              width:150px;
              float: left;
              display: block;
              padding: 10px;
              outline: none;
              border: none;
              font-size: 18px;
              background: #3F75BB;
              color: #fff;
              cursor: pointer;

            }
        </style>
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
                    <div id = "feedback_form">
                        <form action="feedback.php" method="Post">
                            <table>
                            <tr>    
                                <td><label for="name">Name</label></td><td><input type="text" name="name" id="name" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td><td><input type="email" name="email" id="email" required></td>
                            </tr>
                            <tr>    
                                <td><label for="subject">Subject</label></td><td><input type="text" name="subject" id="subject" required></td>
                            </tr>
                                <td><label for ="message">Message</label></td><td><textarea rows='4' cols="40" name="message" id="message" required></textarea>
                            </td>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="submit" value="Send"><input type="reset" name="reset" value="Reset"></td>
                            </tr>
                            </table>
                        </form>
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
