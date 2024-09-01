<?php   
define('TITLE', 'Service Status');
define('PAGE', 'ServiceStatus');        
include('includes/header.php'); 
include('../dbConnection.php');        
session_start();         
if($_SESSION['is_login']){        
    $rEmail = $_SESSION['rEmail'];    
}     
else{
    echo "<script> location.href='RequesterLogin.php';</script>";         
}             
?>

<!-- Start 2nd Column -->  
<div class="col-sm-6 mt-5 mx-5">
    <form action="" method="POST" class="form-inline  d-print-none">
        <div class="form-group mr-3">
            <label for="checkid" class="mr-3">Enter Request ID: </label>   
            <input type="text" class="form-control" name="checkid" id="checkid" onkeypress="isInputNumber(event)">
        </div>    
        <button type="submit" class="btn btn-danger">Search</button>
    </form>      
    <?php
      if(isset($_REQUEST['checkid'])){
        $checkid = $_REQUEST['checkid'];
        if (!empty($checkid)) {
            $sql = "SELECT * FROM assignwork_tb WHERE request_id = '$checkid'";   
            $result = $conn->query($sql);  
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();      
    ?>   
    <div class="printableArea">    
    <h3 class="text-center mt-5">Assigned Work Details</h3>  
    <table class="table table-bordered">
       <tbody>
        <tr>
            <td>Request ID</td>
            <td><?php if(isset($row['request_id'])){echo $row['request_id'];}?></td>    
        </tr> 
        <tr>
            <td>Request Information</td>
            <td><?php if(isset($row['request_info'])){echo $row['request_info'];}?></td>       
        </tr>
        <tr>
            <td>Request Description</td>
            <td><?php if(isset($row['request_desc'])) {echo $row['request_desc']; }?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php if(isset($row['requester_name'])) {echo $row['requester_name']; }?></td>
        </tr>
        <tr>
            <td>Address Line 1</td>
            <td><?php if(isset($row['requester_add1'])) {echo $row['requester_add1']; }?></td>    
        </tr>
        <tr>
            <td>Address Line 2</td>
            <td><?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?></td>
        </tr>
        <tr>
            <td>State</td>
            <td><?php if(isset($row['requester_state'])) {echo $row['requester_state']; }?></td>
        </tr>
        <tr>
            <td>Pin Code</td>
            <td><?php if(isset($row['requester_zip'])) {echo $row['requester_zip']; }?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td><?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?></td>
        </tr>
        <tr>
            <td>Assigned Date</td>
            <td><?php if(isset($row['assign_date'])) {echo $row['assign_date']; }?></td>
        </tr>
        <tr>
            <td>Technician Name</td>
            <td><?php if(isset($row['assign_tech'])) {echo $row['assign_tech']; }?></td>
        </tr>
        <tr>
            <td>Customer Sign</td>
            <td></td>
        </tr>
        <tr>
            <td>Technician Sign</td>
            <td></td>
        </tr>
       </tbody>
    </table>
    </div>     
    <div class="text-center mb-3">
        <form action="" class="d-inline d-print-none mr-3">   
            <input class="btn btn-danger"type="submit" value="Print" onclick="printContent()">
        </form>
        <form action="" class="d-print-none d-inline"><input class="btn btn-secondary" type="submit" value="Close" onclick="reloadPage()"></form>  
    </div>
    <?php } else {
                echo '<div class="alert alert-warning mt-4">Your Request is Still Pending.</div>';
            }
        } else {
            echo '<div class="alert alert-info mt-4">Please enter a Request ID.</div>';
        }  }?>                 
</div> <!-- End 2nd Column -->      

</div>   
</div>    
<!-- Only Number for Input fields -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);  
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();    
        }
    } 

    function printContent() {
    window.print();
    }

    function reloadPage() {
        window.location.href = 'CheckStatus.php';
    }    
   
</script>          
<?php
include('includes/footer.php');
?>    