<?php 
    include '../head.php';
    include '../header.php'; 
    include '../functions.php';
    include '../sidebar.php';
    include '../connect.php';

    if (isset($_POST['submit'])){
    $id=$_POST['memberid'];

    $qry = "SELECT * FROM user WHERE userID='$id'";
    $run = mysqli_query($con, $qry);
    $rows = mysqli_fetch_array($run);

    $_SESSION['user'] =$rows['userID'];
    $firstName=$rows['firstName'];
    $lastName=$rows['lastName'];
    $middleName=$rows['middleName'];
    $birthDate=$rows['birthDate'];
    $homeAddress=$rows['homeAddress'];
    $civilStatus=$rows['civilStatus'];
    $emailAdd=$rows['emailAdd'];
    $currentAddress=$rows['currentAddress'];
    $contactNum=$rows['contactNum'];
    $contactNum2=$rows['contactNum2'];
    $dateCreated=$rows['dateCreated'];
    $picture=$rows['picture'];
    
    $qry2 = "SELECT * FROM member WHERE userID='$id'";
    $run2 = mysqli_query($con, $qry2);
    $rows2 = mysqli_fetch_array($run2);

    $_SESSION['$memberID']=$rows2['memberID'];
    $creditLimit=$rows2['creditLimit'];
    $creditBalance=$rows2['creditBalance'];
    $savings=$rows2['savings'];
    $investment=$rows2['investment'];
    }
?>   
<!--main content start-->
<link rel="stylesheet" href="css/tables.css"/>
<section id="main-content" style="padding-top: 3%; padding-left: 4%">  <!--1 >> Start of page -->
    <a href="membersList.php" style="">  <!--2 >> navigate to memberList <3 -->
      <img src ="./img/back.png" id="back" style="margin-left:2%">
      <!-- <img src ="./img/back.png" id="back"> -->

    </a> 
     <!--2 >> Endnavigate to memberList <3 -->
      <h2 style="color:Black; margin-left: 30px; padding-top: 2% " > <!--3 >>  The member's name -->
        <b><?php echo ucwords($lastName.", ".$firstName ." ".$middleName.""); ?></b>&nbsp; &nbsp; &nbsp;
        <br><br>
      </h2> <!--3  >> End of  member's name -->
<!--4  >> Start of page -->
   <section class="panel" style="margin-left: 2%; margin-right: 2%;"> 
      <header class="panel-heading tab-bg-primary ">
        <ul class="nav nav-tabs" style="background-color: #2F4F4F">
          <li class="active">
            <a data-toggle="tab" href="#personal" style="font-size: 20px">Personal Information</a>
          </li>
          <li class="">
            <a data-toggle="tab" href="#share" style="font-size: 20px">Share Capital</a>
          </li>
          <li class="">
            <a data-toggle="tab" href="#credit" style="font-size: 20px">Credit</a>
          </li>
          <li class="">
            <a data-toggle="tab" href="#savings" style="font-size: 20px">Savings</a>
          </li>
        </ul>
    </header>
<!--Start of panel-->
<div class="panel-body">
  <div class="tab-content">
    <div id="personal" class="tab-pane active" style="padding-top: 5%; padding-bottom: 10%; font-size: 24px"><br> <!-- tab for membersinformation-->
      <?php include 'membersPInformation.php'; ?>
    </div>
    <div id="share" class="tab-pane"><br> <!-- tab for  membersInvestment-->
      <?php include 'membersInvestment.php'; ?>
    </div>

    <div id="credit" class="tab-pane"><br> <!-- tab for  Credit-->
      <h2>Credit Limit: <strong style="color: black"> <?php echo "Php ".formatMoney($creditLimit,true); ?></strong></h2>
      <h2 style="padding-bottom:1.5%;color: black">Credit Balance: <strong style="color: black"> <?php echo "Php ".formatMoney($creditBalance,true); ?></strong></h2><br>
        <table class="table" style="width: 100%; border-top-color: white">
          <tbody>
           <tr>
             <td id="tb1" style="font-size: 24px">
              <?php include 'membersInvoice.php'; ?>
             </td>
             <td style="border-top-color: white"></td>
             <td  id="tb2" style="font-size: 24px">
              <?php include 'membersPayments.php'; ?>
             </td>
           </tr>
            <tr>
            <td style="border-top-color: white">
              <h2>  TOTAL CREDIT: <?php echo "<b>PHP ".formatMoney($totalc,true)."</b>"; ?> </h2>
            </td>
            <td style="border-top-color: white"></td>
            <td style="border-top-color: white">
             <h2>  TOTAL PAYMENT: <?php echo "<b>PHP ".formatMoney($totalp,true)."</b>"; ?> </h2>
            </td>
          </tr>

          </tbody>
        </table>
    </div>

    <div id="savings" class="tab-pane"><br> <!-- tab for Savings-->
      <h2 style="padding-bottom:1.5%">Current Balance:<b> <?php echo "Php ".formatMoney($savings,true); ?></b></h2><br>
        <table class="table" style="width: 100%;">
          <tr>
            <td id="tb3" style="font-size: 24px">
                <?php include 'membersDeposit.php'; ?>
            </td>
            <td style=" border-top-color: white"></td>
            <td colspan="2" id="tb4" style="font-size: 24px">
                 
                  <?php include 'membersWithdrawals.php'; ?> 
            </td>
          </tr>
          <tr>
            <td style="border-top-color: white">
             <h2>  TOTAL DEPOSIT: <?php echo "<b>PHP ".formatMoney($totald,true)."</b>"; ?> </h2>
            </td>
            <td style="border-top-color: white"></td>
            <td style="border-top-color: white">
            
               <h2>  TOTAL WITHDRAWAL: <?php echo "<b>PHP ".formatMoney($totalw,true)."</b>"; ?> </h2>
            </td>
          </tr>
          </table>  <!--3 >> End of first Div  -->
        </div>  <!--5 >> end of  -->
        
      </div>  <!--4 >> End of Second div tab-content  -->
    </div> <!--3 >> End of Panel  -->
  </section> <!--2 >> Ebnd of next body of the panel section -->
</section> <!--1 >> End of whole section-->   
<?php  include '../footer.php'; ?>

 