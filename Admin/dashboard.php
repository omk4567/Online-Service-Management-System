<?php
define('TITLE', 'Dashboard');   
define('PAGE', 'dashboard');   
include('includes/header.php');    
include('../dbConnection.php');     

session_start();         
if($_SESSION['is_adminlogin']){
    $aEmail = $_SESSION['aEmail'];    
}     
else{
    echo "<script> location.href='adminLogin.php';</script>";              
}         
$sql = "SELECT max(request_id) FROM submitrequest_tb";  
$result = $conn->query($sql);  
$row = $result->fetch_row();   // in the form of numeric array       
$submitrequest = $row[0]; 
if($submitrequest == ""){
    $submitrequest = 0;  
} 

$sql = "SELECT max(rno) FROM assignwork_tb";  
$result = $conn->query($sql);  
$row = $result->fetch_row();   // in the form of numeric array       
$assignwork = $row[0];    
if($assignwork == ""){
    $assignwork = 0;  
} 

$sql = "SELECT * FROM technician_tb";  
$result = $conn->query($sql);
$totaltech = $result->num_rows;       
if($totaltech == ""){
    $totaltech = 0;  
}
?>   


<div class="col-sm-9 col-md-10"> <!-- Start Dashboard 2nd Column -->
        <div class="row text-center mx-5">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3" style="max-width:18rem;">
                <div class="card-header">Requests Received</div>  
                <div class="card-body">
                    <h4 class="card-title"><?php echo $submitrequest; ?></h4> 
                    <a href="request.php" class="btn text-white">View</a>      
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width:18rem;">
                <div class="card-header">Assigned Work</div>  
                <div class="card-body">
                    <h4 class="card-title"><?php echo $assignwork; ?></h4> 
                    <a href="work.php" class="btn text-white">View</a>      
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3" style="max-width:18rem;">
                <div class="card-header">No. of Technicians</div>     
                <div class="card-body">
                    <h4 class="card-title"><?php echo $totaltech; ?></h4>    
                    <a href="technician.php" class="btn text-white">View</a>      
                </div>
            </div>
        </div>
        </div>
    <div class="mx-5 mt-5 text-center">
        <p class="bg-dark text-white p-2">List of Requesters</p>    
        <?php 
        $sql = "SELECT * FROM requesterlogin_tb";   
        $result = $conn->query($sql);   
        if($result->num_rows > 0){
            echo 
            '<table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                        Requester ID
                        </th>
                        <th scope="col">
                        Name
                        </th>
                        <th scope="col">
                        Email
                        </th>
                    </tr>
                </thead>
            <tbody>';     
            while($row = $result->fetch_assoc()){
                echo '<tr>';
                echo '<td>'.$row['r_login_id'].'</td>'; 
                echo '<td>'.$row['r_name'].'</td>';
                echo '<td>'.$row['r_email'].'</td>'; 
                echo '</tr>';  
            }
            echo '</tbody
            </table>
            ';     
        }
        else{
            echo 'No Results Found.';
        }
        ?>
    </div>
</div> <!-- End Dashboard 2nd Column -->
            
</div>
</div>

<?php
include('includes/footer.php');    
?>


