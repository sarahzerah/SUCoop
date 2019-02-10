<?php 

include "config.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

     $active = 'Active';
    $role = 'member';
    $query = "SELECT * FROM user WHERE 
    (lastName  LIKE '%".$search."%') 
     AND (role = '$role')
     AND (status= '$active')
    ";
    
    
    $result = mysqli_query($con,$query);
    
     if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_array($result) ){

        $new_row['label']=$row['lastName'].', '.$row['firstName'].' '.$row['middleName'][0].".";
        $new_row['value']=$row['userID'];
        $new_row['image']=$row['picture'];
        $row_set[] = $new_row; //build an array
        
    }


    echo json_encode($row_set);
  
  }else{
    echo '<div id="noresult">No Result Found</div>';
}

}

exit;
?>

