<?php 
    require_once 'connect.php';
    session_start();
    if ($_SESSION['username']){
    $status = $_GET['status'];
    $post_id = $_SESSION['post_id'];
    $user_id = $_SESSION['user_id'];

    if ($status == '1'){
            $sql = "SELECT * FROM liked WHERE user_id='$user_id' and post_id='$post_id'";
                
        $result = mysqli_query($con,$sql);
        if ($result){
            if (mysqli_num_rows($result)>0){
                $sql1 = "UPDATE liked SET like_num='1', dislike_num='0' WHERE user_id='$user_id' AND post_id='$post_id'";
                $result1 = mysqli_query($con,$sql1);
                if ($result1){
                    header("location:view.php?id=$post_id");    
                }else{
                    echo "<script>alert('Error in sql Update CHECK: ')";
                    echo mysqli_error($con)."</script>";
                }
                
            }else{
                $sql1 = "INSERT INTO liked  (post_id,user_id,like_num,dislike_num) VALUES ('$post_id','$user_id','1','0')";
                $result1 = mysqli_query($con,$sql1);
                if ($result1){
                header("location:view.php?id=$post_id");    
                }else{
                    echo "Error in Insert statement Check : ".mysqli_error($con);
                }
                
            }
            
        }else{
            echo 'Error! CHECK'.mysqli_error($con);
        }
        
        //------------------Else dislike part----------------------
    }else{
            $sql = "SELECT * FROM liked WHERE user_id='$user_id' and post_id='$post_id'";
                
        $result = mysqli_query($con,$sql);
        if ($result){
            if (mysqli_num_rows($result)>0){
                $sql1 = "UPDATE liked SET like_num='0',dislike_num='1' WHERE user_id='$user_id' AND post_id='$post_id'";
                $result1 = mysqli_query($con,$sql1);
                if ($result1){
                    header("location:view.php?id=$post_id");    
                }else{
                    echo "<script>alert('Error in sql Update CHECK: ')";
                    echo mysqli_error($con)."</script>";
                }
                
            }else{
                $sql1 = "INSERT INTO liked (post_id,user_id,like_num,dislike_num) VALUES ('$post_id','$user_id','0','1')";
                $result1 = mysqli_query($con,$sql1);
                if ($result1){
                //header("location:view.php?id=$post_id");    
                }else{
                    echo "<script>alert('Error in sql Insert CHECK: ')";
                    echo mysqli_error($con)."</script>";
                }
                
            }
            
        }else{
            echo '<script>alert("Error in Select Statement CHECK : ")';
            echo mysqli_error($con).'</script>';
        }
        
        }
    }else{
        header('location:login_view.php');
    }


        
    


?>