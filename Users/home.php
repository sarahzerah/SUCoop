<?php  
    include '../connect.php';
    include '../functions.php';

    include '../head.php';  

            include '../header.php';
                include '../sidebar.php';
        ?>

    
    <section id="container" class="">
        

        <section id="main-content">
            <section class="wrapper">
                <br><br>
                <center><h1><b>Welcome, <?php echo $_SESSION['name']; ?>!</b></h1></center>
                <p class="text-center"><img src="img/sucoop.png" style="background-size: cover; padding-top: 50px "></p>   
            </section>
        </section>
    </section>
<?php include '../footer.php';   ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
