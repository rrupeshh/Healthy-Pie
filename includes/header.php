<?php
    $result = mysqli_query($con, "SELECT * FROM register WHERE username = '$username'");
    ob_start();
    while( $row = mysqli_fetch_assoc($result) ) {
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/HealthyPie.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="HealthyPie.png">
        
        <title>HealthyPie<?php echo ' ' .'|'.' '.$firstname ?></title>
    </head>
    
    <body>
        <div id="wrapper">
            <header id="main_header">
                <div id="main_header_content">
                    <div id="main_header_title">
                        <div>
                            
                                <img style="margin-right: 10px;" src="logo.png" width="50" alt="HealthyPie.com">
                             
                            </div>
                            <div>
                                <span style="text-shadow: 0.4px 0.4px 1px rgba(0,0,0,0.6);">Healthy<span style="color: rgb(143,210,60);">Pie</span></span>
                            </div>
                            
                    </div>

                    <div id="main_header_links">
                        <div>
                            <span>Logged In as: </span>
                            <a style="text-decoration: underline;" href="profile.php"><?php echo $firstname . ' ' . $lastname; ?></a>
                            <a href="logout.php">Log Out</a>
                        </div>
                        <div>
                            <form method="get" action="http://www.google.com/search">

                                <table border="0" align="center" cellpadding="0">
                                <tr><td>
                                <input type="search"   name="q" size="25" style="color:#808080;"
                                maxlength="255" value="Search ..."
                                onfocus="if(this.value==this.defaultValue)this.value=''; this.style.color='black';" onblur="if(this.value=='')this.value=this.defaultValue; "/>
                                <input type="hidden" name="sitesearch" value="dipesh.ueuo.com" /></td></tr>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>

                <div id="main_header_seperator"></div>

                <div id="navigation_menu">
                    <ul style="display:inline-block; margin:10px;">
                        <li><a href="welcome.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="recipe.php">Recipe</a></li>
                        <li><a href="javascript:void(0)">Health</a></li>
                        <li><a href="javascript:void(0)">FeedBack</a></li>
                        <li><a href="javascript:void(0)">Post Recipe</a></li>
                    </ul>
                </div>

                <div id="main_header_seperator"></div>
            </header>