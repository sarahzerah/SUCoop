<aside>
    <style>
#sidebar-font{


    font-size: 20px;
    width:100%;
   
}
</style>
<div id="sidebar"  class="nav-collapse " style="padding-top: 1%;width: 12%">
    
    <!--If Manager is logged in-->
    <?php if ($_SESSION['role']=='manager' && $_SESSION['first']==1): ?> <!--first is used to check if the user just logged in-->

    <ul class="sidebar-menu">

        <li class="">
            <a class="" href="./Reports/report.php" id="sidebar-font"><span>Reports</span></a>
        </li>
        <li>
            <a class="" href="./Sales/sales.php" id="sidebar-font"><span>Sales Records</span></a>
        </li>
          <li>
            <a class="" href="./Inventory/foodInventory.php" id="sidebar-font"><span>Viand Sales</span></a>
        </li>  
          <li>
            <a class="" href="./Inventory/inventory.php" id="sidebar-font"><span>Inventory Records</span></a>
        </li>
        <li class="">
            <a class="" href="./Members/membersList.php" id="sidebar-font"><span>Members' Records</span></a>
        </li>

        <li>
            <a class="" href="./Suppliers/suppliersList.php" id="sidebar-font"><span>Suppliers' Records</span></a>
        </li>
        
        <li>
            <a class="" href="./Users/usersList.php" id="sidebar-font"><span>Employees' Records</span></a>
        </li>

    </ul>

    <?php
        $_SESSION['first']=2; 
        elseif ($_SESSION['role']=='manager' && $_SESSION['first']!=1):
    ?>

    <ul class="sidebar-menu">                

        <li class="">
            <a class="" href="../Reports/report.php" id="sidebar-font"><span>Reports</span></a>
        </li>
        <li>
            <a class="" href="../Sales/sales.php" id="sidebar-font"><span>Sales Records</span></a>
        </li>
          <li>
            <a class="" href="../Inventory/foodInventory.php" id="sidebar-font"><span>Viand Sales</span></a>
        </li>  
          <li>
            <a class="" href="../Inventory/inventory.php" id="sidebar-font"><span>Inventory Records</span></a>
        </li>
        <li class="">
            <a class="" href="../Members/membersList.php" id="sidebar-font"><span>Members' Records</span></a>
        </li>

        <li>
            <a class="" href="../Suppliers/suppliersList.php" id="sidebar-font"><span>Suppliers' Records</span></a>
        </li>
        
        <li>
            <a class="" href="../Users/usersList.php" id="sidebar-font"> <span>Employees' Records</span></a>
        </li>
    </ul>
    
    <?php 
        else :
            " ";
        endif; 
    ?>

    <!--If Secretary is logged in--> 
    <?php if ($_SESSION['role']=='secretary' && $_SESSION['first']==1): ?>
    <ul class="sidebar-menu">                

        <li>
            <a class="" href="./Members/addNewMember.php" id="sidebar-font"><span> Register New Members</span></a>
        </li>  

        <li>
            <a class="" href="./Members/membersList.php" id="sidebar-font"><span>Members' List</span></a>
        </li>

    </ul>

    <?php
        $_SESSION['first']=0; 
        elseif ($_SESSION['role']=='secretary' && $_SESSION['first']==0):
    ?>

    <ul class="sidebar-menu">                

      
        <li>
            <a class="" href="../Members/addNewMember.php" id="sidebar-font"><span> Register New Members</span></a>
        </li>  

          <li>
            <a class="" href="../Members/membersList.php" id="sidebar-font"><span>Members' List</span></a>
        </li>

    </ul>

    <?php endif; ?>

    <!--If Cashier is logged in--> 
    <?php 
        if ($_SESSION['role']=='cashier' && $_SESSION['first']==1):
            include 'connect.php'; 
    ?>
    <ul class="sidebar-menu">                

        <li>
            <?php
                $sql2="SELECT * FROM cash_sales ORDER BY ORNum DESC LIMIT 1";
                $run= mysqli_query($con, $sql2);
                $rows= mysqli_fetch_array($run);
                $salesNum=$rows['ORNum'];

                
                    $_SESSION['salesNum']=$salesNum+1;
                
            ?>
            <a class="" href="./Sales/pos.php" id="sidebar-font"><span>POS</span></a>
        </li>

        <li>
            <?php
                $sql3="SELECT * FROM cash_transaction ORDER BY transactionNum DESC LIMIT 1";
                $run2= mysqli_query($con, $sql3);
                $rows2= mysqli_fetch_array($run2);
                $transactionNum=$rows2['transactionNum'];

                
                    $_SESSION['transactionNum']=$transactionNum+1;
                
            ?>
            <a class="" href="./Members/cashTransaction.php" id="sidebar-font"><span>Cash Transaction</span></a>
        </li>  
    </ul>

    <?php
        $_SESSION['first']=0;
        elseif ($_SESSION['role']=='cashier' && $_SESSION['first']==0):
    ?>

    <ul class="sidebar-menu">                

        <li>
            <?php
                $salesNum=$_SESSION['salesNum'];
            ?>
            <a class="" href="../Sales/pos.php?id=#modal-1" id="sidebar-font"><span>POS</span></a>
            <!-- <a class="" href="../Sales/pos.php"><span>POS</span></a> -->
        </li>

        <li>
            <?php
                $transactionNum=$_SESSION['transactionNum'];
            ?>
            <a class="" href="../Members/cashTransaction.php" id="sidebar-font"><span>Cash Transaction</span></a>
        </li>  
    </ul>

    <?php endif; ?>

    <!--If Inventory Personnel is logged in--> 
    <?php if ($_SESSION['role']=='inventory personnel' && $_SESSION['first']==1): ?>
    <ul class="sidebar-menu">                

          <li>
            <a class="" href="./Inventory/inventory.php" id="sidebar-font"><span>Inventory Record</span></a>
        </li>  

              <!-- added purchase order and good reciepts here -->
           <li>
            <a class="" href="./Inventory/purchaseOrder.php" id="sidebar-font"><span>Purchase Order Records</span></a>
        </li>  

           <li>
          <a class="" href="./Inventory/goodReceipt.php" id="sidebar-font"><span>Goods Receipt Records</span></a>
        </li>  

        <li>
            <a class="" href="./Suppliers/suppliersList.php" id="sidebar-font"><span>Suppliers' Records</span></a>
        </li>

      
       
        
    </ul>

    <?php
        $_SESSION['first']=0; 
        elseif ($_SESSION['role']=='inventory personnel' && $_SESSION['first']==0):
    ?>

    <ul class="sidebar-menu">                

        <li>
            <a class="" href="../Inventory/inventory.php" id="sidebar-font"><span>Inventory Record</span></a>
        </li>  

              <!-- added purchase order and good reciepts here -->
           <li>
            <a class="" href="../Inventory/purchaseOrder.php" id="sidebar-font"><span>Purchase Order Records</span></a>
        </li>  

           <li>
          <a class="" href="../Inventory/goodReceipt.php" id="sidebar-font"><span>Goods Receipt Records</span></a>
        </li>  

        <li>
            <a class="" href="../Suppliers/suppliersList.php" id="sidebar-font"><span>Suppliers' Records</span></a>
        </li>

      
    </ul>

    <?php endif; ?>




    <!--If Member is logged in--> 
    <?php if ($_SESSION['role']=='member' && $_SESSION['first']==1): ?>
    <ul class="sidebar-menu">                

        <li>
            <a class="" href="./Members/membersInvestment.php" id="sidebar-font"><span>Share Capital</span></a>
        </li>

        <li>
            <a class="" href="./Members/membersInvoice.php" id="sidebar-font"><span>Credit</span></a>
        </li>

        <li>
            <a class="" href="./Members/membersDeposit.php" id="sidebar-font"><span>Savings</span></a>
        </li>
         
    </ul>

    <?php
        $_SESSION['first']=0; 
        elseif ($_SESSION['role']=='member' && $_SESSION['first']==0):
    ?>

    <ul class="sidebar-menu">                

       <li>
            <a class="" href="../Members/membersInvestment.php" id="sidebar-font"><span>Share Capital</span></a>
        </li>

        <li>
            <a class="" href="../Members/membersInvoice.php" id="sidebar-font"><span>Credit</span></a>
        </li>

        <li>
            <a class="" href="../Members/membersDeposit.php" id="sidebar-font"><span>Savings</span></a>
        </li>
        
    </ul>

    <?php endif; ?>

    <!--If accountant is logged in-->

    <?php if ($_SESSION['role']=='accountant' && $_SESSION['first']==1): ?>
    <ul class="sidebar-menu">                

         <li class="">
            <a class="" href="./Reports/report.php" id="sidebar-font"><span>Reports</span></a>
        </li>

        <li>
            <a class="" href="./Inventory/inventory.php" id="sidebar-font"><span>Inventory Records</span></a>
        </li>

        <li>
            <a class="" href="./Inventory/foodInventory.php" id="sidebar-font"><span>Viand Sales</span></a>
        </li>  

        <li>
            <a class="" href="./Sales/sales.php" id="sidebar-font"><span>Sales Records</span></a>
        </li>
    </ul>

    <?php
        $_SESSION['first']=2; 
        elseif ($_SESSION['role']=='accountant' && $_SESSION['first']!=1):
    ?>

    <ul class="sidebar-menu">                

         <li class="">
            <a class="" href="../Reports/report.php" id="sidebar-font"><span>Reports</span></a>
        </li>
        <li>
            <a class="" href="../Inventory/inventory.php" id="sidebar-font"><span>Inventory Records</span></a>
        </li>

        <li>
            <a class="" href="../Inventory/foodInventory.php" id="sidebar-font"><span>Viand Sales</span></a>
        </li>  

        <li>
            <a class="" href="../Sales/sales.php" id="sidebar-font"><span>Sales Records</span></a>
        </li>
    </ul>
    
    <?php endif; ?>

</div>
</aside>