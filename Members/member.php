<?php

        include '../head.php';
        include '../header.php';
        include '../sidebar.php';
        include '../functions.php';
        include '../connect.php';

               
                $id=$_SESSION['userID'];

                $qry = "SELECT * FROM user WHERE userID='$id'";
                $run = mysqli_query($con, $qry);
                $rows = mysqli_fetch_array($run);
              
                $_SESSION['user']=$rows['userID'];
                $firstName=$rows['firstName'];
                $lastName=$rows['lastName'];
                $middleName=$rows['middleName'];
                $birthDate=$rows['birthDate'];
                $homeAddress=$rows['homeAddress'];
                $civilStatus=$rows['civilStatus'];
                $emailAdd=$rows['emailAdd'];
                $currentAddress=$rows['currentAddress'];
                $contactNum=$rows['contactNum'];
                $contact_Num=$rows['contact_Num'];
                $picture=$rows['picture'];
                
                $qry2 = "SELECT * FROM member WHERE userID='$id'";
                $run2 = mysqli_query($con, $qry2);
                $rows2 = mysqli_fetch_array($run2);
                $memberID =$rows2['memberID'];
                $creditLimit=$rows2['creditLimit'];
                $creditBalance=$rows2['creditBalance'];
                $savings=$rows2['savings'];
                $investment=$rows2['investment'];

                ?>
<section id="main-content" style="padding-left: 8%; padding-right: 3%; padding-top: 6%">
<div id="profile" class="tab-pane" > 
    <section class="panel" >
        <div class="panel-body bio-graph-info" >  
                <div class="col-sm-8">
                 
                                 