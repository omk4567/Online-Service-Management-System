<?php
define('TITLE', 'Technicians');
define('PAGE', 'technician');   
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
    <p class="bg-dark text-white p-2">ServicePlus - List of Teechnicians</p>    
    <?php
    $sql = "SELECT * FROM technician_tb";
    $result = $conn->query($sql);  
    if($result->num_rows > 0){
        echo '<table class="table">
        <thead>
                <tr>
                    <th scope="col">Emp ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">City</th>  
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
        </thead>
        <tbody>';   
        while($row = $result->fetch_assoc()){
            echo '<tr>';
             echo '<td>'.$row["empid"].'</td>';
             echo '<td>'. $row["empName"].'</td>';
             echo '<td>'.$row["empCity"].'</td>';
             echo '<td>'.$row["empMobile"].'</td>';
             echo '<td>'.$row["empEmail"].'</td>';   
             echo '<td>';
             echo '<form action="editemp.php" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["empid"].'>
                <button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';      
             echo '</form>'; 
             echo '<form action="" class="d-inline" method="POST">';
                echo '<input type="hidden" name="id" value='.$row["empid"].'>
                <button type="submit" class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>';      
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
    $sql = "DELETE FROM technician_tb WHERE empid = {$_REQUEST['id']}";        
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';  
    }
    else{
        echo "Unable to delete.";   
    }
}      
?>
  
</div>    
<div class="float-right"><a href="insertemp.php" class="btn btn-danger"><i class="fas fa-plus fa-2x"></i></a></div> 
</div>

<?php
include('includes/footer.php');    
?>

   