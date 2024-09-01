<?php
define('TITLE', 'Requester'); 
define('PAGE', 'requesters');   
include('includes/header.php');    
include('../dbConnection.php');    
session_start();         
if($_SESSION['is_adminlogin']){
    $aEmail = $_SESSION['aEmail'];    
}     
else{
    echo "<script> location.href='adminLogin.php';</script>";              
}         
?>     
<!-- Start 2nd Column -->  
<div class="col-sm-6 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">List of Requesters</p>    
    <?php
    $sql = "SELECT * FROM requesterlogin_tb";
    $result = $conn->query($sql);  
    if($result->num_rows > 0){
        echo '<table class="table">
        <thead>
                <tr>
                    <th scope="col">Requester ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
        </thead>
        <tbody>';   
        while($row = $result->fetch_assoc()){
            echo '<tr>';
             echo '<td>'.$row["r_login_id"].'</td>';
             echo '<td>'. $row["r_name"].'</td>';
             echo '<td>'.$row["r_email"].'</td>';
             echo '<td>';
             echo '<form action="editreq.php" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["r_login_id"].'>
                <button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';      
             echo '</form>'; 
             echo '<form action="" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["r_login_id"].'>
                <button type="submit" class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>';      
             echo '</form>';          
             echo '</td>';      
        }   
        echo '</tbody> </table>';   
    }
    else{
        echo '0 Results.';   
    }
    ?>
</div>
<!-- End 2nd Column -->     
<?php
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM requesterlogin_tb WHERE r_login_id = {$_REQUEST['id']}";  
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';  
    }
    else{
        echo "Unable to delete.";   
    }
}
?>
  
</div>    
<div class="float-right"><a href="insertreq.php" class="btn btn-danger"><i class="fas fa-plus fa-2x"></i></a></div> 
</div>
<?php
include('includes/footer.php');    
?>






