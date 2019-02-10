 <?php
    include '../connect.php';
    include '../session.php';

    if (isset($_POST['save'])) {
        
        header("Location:cashTOR.php");      
        
    }

    if (isset($_POST['cancel'])) {
       
         header("Location:cashTransaction.php");
    }
?>