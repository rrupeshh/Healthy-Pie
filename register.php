<?php
    require('connect.php'); 
?>
<?php

    // Defining the variables
    $firstname = $lastname = $email = $emailagain = $password = $passwordagain = $userpost = $username = "";
    
    if( isset($_POST['submit_reg']) ) {
        $firstname = test_input($_POST['firstname']);
        $lastname = test_input($_POST['lastname']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $passwordagain = test_input($_POST['passwordagain']);
        $username = test_input($_POST['username']);
        
        if( !empty($email) ) {
            
            if( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                $errormessage = "Not Valid!";
            } else {
                
                    if( !empty($password) ) {
                        
                        if( $password == $passwordagain ) {
                            
                            $newpassword = md5($password);
                            
                                
                                if( !preg_match("/^[a-z0-9._]+$/i",$username) ) {
                                    $errormessage = "Username not valid!";
                                } else {
                                    
                                    if( $firstname && $lastname ) {
                                        
                                        $query = mysqli_query($con,"SELECT * FROM register WHERE username = '$username'");
                                        
                                        if( mysqli_num_rows($query) == 0 ) {
                                        $sql = "INSERT INTO register (firstname,lastname,email,password,username,role) VALUES('$firstname','$lastname','$email','$newpassword','$username','user')";
                                    
                                    $insert = mysqli_query($con,$sql);
                                            if(!$insert) {
                                                echo "Couldn't insert";
                                            } else {
                                                $errormessage = "Registered Succesfully!";
                                                $last_id = mysqli_insert_id($con);
                                        $sql = "INSERT INTO profile (id) VALUES('$last_id')";
                                        $result = mysqli_query($con,$sql);
                                        if (!$result){
                                            echo "CHECK: ".mysqli_error($con);
                                        }
                                    else{
                                        echo "<script>alert('Successfully Registered! Login to continue....')</script>";
                                    }
                                            }
                                        } else {
                                            $errormessage = "User Already Registered!";
                                        }
                                        
                                    } else {
                                        $errormessage = "Fill Up the Name fields";
                                    }
                                    
                                }
                            
                        } else {
                            $errormessage = "Password Do not match!";
                        }
                        
                    } else {
                        $errormessage = "Password Empty!";
                    }
            }}
                    
            
        else {
            $errormessage = "Empty Email";
        }
    
    }



?>

<?php echo $errormessage; ?>