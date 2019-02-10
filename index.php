<?php

  include("connect.php");

  session_start();

  if (isset($_SESSION['userID'])) 
    header('location:./Users/home.php');
  else {

  $error="";

  if(isset($_POST["submit"]))
  {
    $username = $_POST['Username']; 
    $password = $_POST['Password'];

    $username = stripslashes($username);
    $password = md5($password); 
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    
    $checkUser = "SELECT * FROM user WHERE username='$username' AND status='active' AND password='$password'";
    $result = mysqli_query($con, $checkUser);
    $rows = mysqli_fetch_assoc($result);

    $_SESSION['userID'] = $rows['userID'];
    $_SESSION['role'] = $rows['role'];
    $_SESSION['name'] = $rows['firstName'];
    $_SESSION['first'] = 1;

    if ($rows['role'] == 'manager' || $rows['role'] == 'accountant') {
      //header('location:./Reports/report.php');
      //header('location: ./Reports/home.php');
      header('location:home.php');
      
    }

    else if ($rows['role'] == 'secretary' || $rows['role'] == 'cashier' || $rows['role'] == 'inventory personnel' || $rows['role'] == 'member') 
      header('location:home.php');
    
    else { 
      header("Location: index.php?login=The Username/Password you've entered is incorrect.");
    }
    
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
      <meta name="author" content="GeeksLabs">
      <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
      <link rel="shortcut icon" href="img/small_logo.png">

      <title>SU Coop Sales and Inventory System</title>

      <!-- Bootstrap CSS -->    
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- bootstrap theme -->
      <link href="css/bootstrap-theme.css" rel="stylesheet">
      <!--external css-->
      <!-- font icon -->
      <link href="css/elegant-icons-style.css" rel="stylesheet" />
      <link href="css/font-awesome.css" rel="stylesheet" />
      <!-- Custom styles -->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/style-responsive.css" rel="stylesheet" />
  </head>

  <body style="background-image:url('img/sucoop.jpg') no-repeat fixed center;">
    <form class="login-form" action=""  method="POST">
        
      <!--error message if credentials are invalid-->
      <?php if(isset($_GET['login'])) : ?>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php echo htmlentities($_GET['login']); ?>   
      </div>
      <?php else: echo ''; endif; ?>
      
      <br> 
            
      <div class="login-wrap">
          <img src="./img/sucoop.png" width="100" height="100" style="margin-left: 100px;"> <!--SU Coop Logo-->
          <p class="login-img"></i></p>
          <div class="input-group">
            <span class="input-group-addon"><i class="icon_profile"></i></span>
            <input type="text" class="form-control" name="Username" placeholder="Username" autofocus required=""> 
          </div>

          <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            <input type="password" class="form-control" name="Password" placeholder="Password"  required=""> 
          </div>
          <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Login" />      
      </div>
    </form>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html> 
<?php } ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
