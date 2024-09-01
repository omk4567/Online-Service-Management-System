<?php
define('TITLE', 'Assets');
define('PAGE', 'assets');   
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
    <p class="bg-dark text-white p-2">Products/Part Details</p>        
    <?php
    $sql = "SELECT * FROM assets_tb";
    $result = $conn->query($sql);  
    if($result->num_rows > 0){
        echo '<table class="table">
        <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">DOP</th>  
                    <th scope="col">Available</th>
                    <th scope="col">Total</th>  
                    <th scope="col">Original Cost Each</th>
                    <th scope="col">Selling Cost Each</th>
                    <th scope="col">Action</th>
                </tr>
        </thead>
        <tbody>';   
        while($row = $result->fetch_assoc()){
            echo '<tr>';
             echo '<td>'.$row["pid"].'</td>';
             echo '<td>'. $row["pname"].'</td>';
             echo '<td>'.$row["pdop"].'</td>';
             echo '<td>'.$row["pava"].'</td>';
             echo '<td>'.$row["ptotal"].'</td>'; 
             echo '<td>'.$row["poriginalcost"].'</td>';
             echo '<td>'.$row["psellingcost"].'</td>';  
             echo '<td>';   
             echo '<form action="editproduct.php" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["pid"].'>     
                <button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';      
             echo '</form>'; 
             echo '<form action="" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["pid"].'>
                <button type="submit" class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>';      
             echo '</form>';
             echo '<form action="sellproduct.php" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["pid"].'>     
                <button type="submit" class="btn btn-warning mr-3" name="issue" value="Issue"><i class="fas fa-handshake"></i></button>';      
             echo '</form>';           
             echo '</td>';      
        }   
        echo '</tbody> </table>';   
    }
    else{
        echo 'No Results.';   
    }
    ?>
</div>
<!-- End 2nd Column -->     
<?php
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM assets_tb WHERE pid = {$_REQUEST['id']}";            
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';        
    }    
    else{
        echo "Unable to delete.";   
    }
}           
?>
  
</div>    
<div class="float-right"><a href="addproduct.php" class="btn btn-danger"><i class="fas fa-plus fa-2x"></i></a></div> 
</div>

<?php
include('includes/footer.php');         
?>