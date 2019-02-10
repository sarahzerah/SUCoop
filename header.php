<header class="header dark-bg">
   <!--<div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>-->

    <!--SU Coop logo-->
    <!--BLANCHE: Added padding-bottom-->
    <a  class="logo" style="padding-bottom: 1% "><img alt="avatar" src="img/sucoop.png" width="50" height="50" > SU<span class="lite">Coop</span></a><br>
    
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
                            <?php if ($_SESSION['first']==1): ?>
                          <a href="./Users/usersProfile.php"><i class="icon_profile"></i>View Profile</a>
                            <?php 
                            $_SESSION['first']==2; 
                            else: ?>
                            <a href="../Users/usersProfile.php"><i class="icon_profile"></i>View Profile</a>
                            <?php endif; ?>
                        </li>

                        <li>
                            <?php if ($_SESSION['first']==1): ?>
                            <a href="./Users/logout.php"><i class="icon_key_alt"></i>Log Out</a>
                            <?php 
                            $_SESSION['first']==2; 
                            else: ?>
                            <a href="../Users/logout.php"><i class="icon_key_alt"></i>Log Out</a>
                           <?php endif; ?>
                        </li>
                </ul>

            </li> <!--profile menu end -->
        </ul> <!--profile dropdown end-->
    </div>
</header> 
