<?php 
    session_start();
    require_once('connect.php');
    $errormessage = "Enter Username & Password";
    $username = $password = "";

if (isset($_POST['submit'])){
    if (!preg_match("/^[a-z0-9._]*$/i",$username)){
        $errormessage = "Invalid username";
    }else{
     $username = test_input($_POST['username']);
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM register WHERE BINARY username = '$username' AND password = '$password'";
    $result = mysqli_query($con,$sql);
    
    if (mysqli_num_rows($result) == 1){
        
        $sql = "SELECT * FROM register WHERE username = '$username' AND password= '$password'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if ($row){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['first_name'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
        }
     header('Location:'.$_SESSION['url']);
    }else{
        $errormessage = "Invalid Username & Password";
    }
    }
}

function test_input($data){
    $data = trim($data);
    $data  = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles_old/style.css">
        <link rel="stylesheet" href="styles_old/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="HealthyPie.png">
        
        <title>HealthyPie | LogIn</title>
                
    </head>
    
    <body>
        <div id="wrapper">
            
            
            
            <div id="index_main_section" style="margin-top:10%;">
        
                <div id="registration_section">
                    <center>Login</center>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <table id="register-login-table">
                            <tr>
                                <td>UserName:</td>
                                <td>
                                    <input type="text" name="username" autocomplete="on" autofocus="on" placeholder="UserName" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="password" autocomplete="off" placeholder="Password" required/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color: red;border-left: 5px solid red;"><?php echo $errormessage; ?></td>
                                <td>
                                    <input type="submit" name="submit" value="Login"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>