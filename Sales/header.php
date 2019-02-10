<header class="header dark-bg">
   <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

    <!--SU Coop logo-->
    <!--BLANCHE: Added padding-bottom-->
    <a href="index.php" class="logo" style="padding-bottom: 1% "><img alt="avatar" src="img/small_logo.png" width="50" height="50" > SU<span class="lite">Cooperative</span></a><br>
    
    <div class="top-nav notification-row">                
        <!--profile dropdown start-->
        <ul class="nav pull-right top-menu">
                    
            <!--profile menu start -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="profile-ava"></span>
                    <span class="username"><?php echo ucwords($_SESSION['role']); ?></span>
                    <b class="caret"></b>
                </a>

                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                        <li class="eborder-top">
                           
                            <a href="../usersProfile.php"><i class="icon_profile"></i>View Profile</a>
                          
                        
                        </li>

                        <li>
                            
                            <a href="logout.php"><i class="icon_key_alt"></i>Log Out</a>
                          
                        </li>
                </ul>

            </li> <!--profile menu end -->
        </ul> <!--profile dropdown end-->
    </div>
</header> 