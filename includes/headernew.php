<?php 
    include('login.php');
    include('register.php');
    $_SESSION['url'] = basename($_SERVER['REQUEST_URI']);


?>

<div id="top_header">
                <div id="top_header_wrapper">
                    <div id="top_header_left">
                        <div><span style="font-weight: bold;">Recipe</span>#Blogs</div>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div style="clear: both;"></div>
                    </div>

                    <div id="top_header_right">
                        <div>
                            <img style="width:22px;" src="Photos/u.png">
                        </div>
                    <?php 
                            if (!isset($_SESSION['username'])){
                                
                            
                        ?>
                        <div onclick ="open_login_popup()">
                           <a href="javascript: void(0)" >LOG IN</a>
                        </div>

                        <div onclick ="open_register_popup()">
                            <a href="javascript: void(0)">JOIN</a>
                        </div>
                    <?php
                        }else{
                            ?>
                        
                        <div onclick ="window.location.href='logout.php'">
                            <a href="javascript: void(0)">LOG OUT</a>
                        </div>
                        <?php
                            }
                        ?>
                        <div style="clear: both;"></div>
                    </div>

                    <div style="clear: both;"></div>
                </div>
            </div>



            <!-- Main Header Section -->
            <div id="main_header">
              <div id="main_header_wrapper">

                <div id="main_header_title">
                  <span>HealthyPie</span>
                  <span>.com</span>
                </div>

                <div id="main_header_navigation">
                  <ul>
                    <li><a href="Index.php">HOME</a></li>
                    <li><a href="recipe.php">RECIPE</a></li>
                    <li><a href="health.php">HEALTH</a></li>
                    <li><a href="search_ingredients.php">SEARCH</a></li>
                    <li><a href="feeds.php">FEEDS</a></li>
                      <li><a href="hotel_restaurant.php">HOTEL FINDER</a></li>
                    <?php
                      if (isset($_SESSION['username'])){
                      ?>
                        <li><a href="profile.php">PROFILE</a></li>
                        <li><a href="discussion.php">DISCUSS</a></li>
                        <li><a href="post.php">POST RECIPE</a></li>
                        <li><a href="portfolio.php">PORTFOLIO</a></li>
                      <?php
                      }
                      ?>
                    
                    <div style="clear: both;"></div>
                  </ul>
                </div>
              </div>
            </div>

 <!--Login popup starts here-->

            <div id = "Login_pop">
            
                <div id = "login_pop_header">
                    
                    <h1>LOG IN</h1>
                <div id = "close_pop" title = "Close" onclick="close_login_popup()">
                    <p>X</p>
                </div>
                </div>
                
                <div id="login_pop_content">
                    <div id="pop_form" >
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <table id="register-login-table">
                            <tr>
                                
                                <td>
                                    <input class = "pop_input" type="text" name="username" autocomplete="on" autofocus="on" placeholder="Username" required autofocus/>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <input class = "pop_input" type="password" name="password" autocomplete="off" placeholder="Password" required/>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                            <input class = "pop_check" type="checkbox" name="vehicle" value="Bike">&nbsp;Remember Me<br>
                                     </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <input class = "pop_sub" type="submit" name="submit_login" value = "SUBMIT"/>
                                </td>
                            </tr>
                           
                        </table>
                    </form>
                         
                        </div>
                        <hr class = "hori_rule">
                        <div class = "pop_bottom">Don't have a healthypie.com.np account? Click here to <a onclick ="close_login_popup();open_register_popup();" href ="javascript: void(0)">register</a>.</div>
                    
                    <!-- Pop up Script Begins -->
                    <script type ="text/javascript">
            var popupDiv = document.getElementById("Login_pop");
            function open_login_popup(){
                popupDiv.style.display ="block";
                
            }
            function close_login_popup(){
                 popupDiv.style.display ="none";
            }
        </script>
                    <!-- Pop up Script Ends-->
                    
                </div>
            </div>

        <!--Registration popup starts here-->
        <div id = "Register_pop">
                <div id = "register_pop_header">
                    
                    <h1>REGISTER</h1>
                <div id = "close_pop" title = "Close" onclick="close_register_popup()">
                    <p>X</p>
                </div>
                </div>
                
                <div id="register_pop_content">
                    <div id="pop_form" >
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <table id="register-login-table">
                            <tr>
                                
                                <td>
                                    <input class = "pop_input_short" type="text" name="firstname" autocomplete="on" autofocus="on" placeholder="First Name" required/>
                                    <input class = "pop_input_short" type="text" name="lastname" autocomplete="on" autofocus="on" placeholder="Last Name" required/>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <input class = "pop_input" type="email" name="email" autocomplete="on" autofocus="on" placeholder="Email" required/>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <input class = "pop_input" type="text" name="username" autocomplete="on" autofocus="on" placeholder="Username" required/>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <input class = "pop_input_short" type="password" name="password" autocomplete="off" placeholder="Password" required/>
                                    <input class = "pop_input_short" type="password" name="passwordagain" autocomplete="off" placeholder="Re-Enter Password" required/>
                                </td>
                            </tr>
                            <tr>
                                
                            <tr>
                                
                                <td>
                                    <input class = "pop_sub" type="submit" name="submit_reg" value = "SUBMIT"/>
                                </td>
                            </tr>
                           
                        </table>
                    </form>
                         
                        </div>
                        <hr class = "hori_rule">
                        <div class = "pop_bottom">Already a member? Click here to <a onclick ="close_register_popup();open_login_popup();" href ="javascript: void(0)">sign in</a>.</div>
                    
                    <!-- Pop up Script Begins -->
                    <script type ="text/javascript">
            var popupDiv1 = document.getElementById("Register_pop");
            function open_register_popup(){
                popupDiv1.style.display ="block";
            }
            function close_register_popup(){
                 popupDiv1.style.display ="none";
            }
                        
            function logout(){
                
            }            
        </script>
                    <!-- Pop up Script Ends-->
                    
                </div>
            </div>

            <!-- Search Section Below Main Section -->

            <div id="search_section">
              <div id="search_section_wrapper">
                <div id="search_section_caption">
                  Search all of our recipes
                </div>

                <div id="search_section_search_form">
                    <form method="POST" action="search.php">
                  <input type="text" placeholder="Search Dish, Keyword and Foods here" name = "search">
                  <input type="submit" name="search_submit" value="SEARCH">
                        </form>
                  <div style="clear: both;"></div>
                </div>
              </div>
            </div>
     <!-- Login Page -->
            
            