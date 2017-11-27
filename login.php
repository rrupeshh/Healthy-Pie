<?php 
    
    include('connect.php');
    $errormessage = "";
    $username = $password = "";


if (isset($_POST['submit_login'])){
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
        echo '<script>alert("Successfylly Logged In")</script>';
        $value = $_SESSION['url'];
        header("refresh:0,url= $value");
        exit;
    }else{
         echo "<script>alert('Invalid Username & Password')</script>";
         header("refresh:0,url= $value");
        exit;
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
