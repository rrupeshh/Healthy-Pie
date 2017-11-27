<?php 
    session_start();
    require_once('connect.php');

    $name = $message = $subject = $email = "";
    if ($_POST['submit']){
        $name = ($_POST['name']);
        $email = ($_POST['email']);
        $subject = ($_POST['subject']);
        $message = ($_POST['message']);
        $to = 'bipulthapa10@gmail.com';
        $from = "From: ".$name;
        $finalMessage = "
        From: $name
        Email: $email
        Subject: $subject
        Message: $message
        ";
        mail("$to","$subject","$finalMessage",$from);
        $result =" Your Message has been sent successfully";
        $responseSubject="Feedback Message";
        $msg = "Thank you for contacting us! We will contact you soon.";
        mail("$email","$responseSubject","$msg","From:bipulthapa10@gmail.com");
    }
    
/*function test_input($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
*/
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
                    <div id = "feedback_form">
                        <h2><?php echo $result; ?></h2>
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
