<?php 

include "config.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM inventory WHERE itemName like'%".$search."%'
     
    ";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){

        $response[] = array("value"=>$row['productNum'],
          "label"=> $row['itemName']
             
        );
        
    }

    echo json_encode($response);
  
}

exit;

?>