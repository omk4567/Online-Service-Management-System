<?php
define('TITLE', 'Update Requester');
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
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Requester Details</h3>      
    <?php
    if(isset($_REQUEST['edit'])){
        $sql = "SELECT * FROM requesterlogin_tb WHERE r_login_id = {$_REQUEST['id']}";  
        $result = $conn->query($sql);  
        $row = $result->fetch_assoc();
    }   
    if(isset($_REQUEST['requpdate'])){
        if(($_REQUEST['r_login_id'] == "") || ($_REQUEST['r_name'] == "") || ($_REQUEST['r_email'] == "")){
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">All Fields are Mandatory.</div>';
        }
        else{
            $rid = $_REQUEST['r_login_id'];  
            $rname = $_REQUEST['r_name'];
            $remail = $_REQUEST['r_email'];
            $sql = "UPDATE requesterlogin_tb SET r_login_id = '$rid', r_name = '$rname', r_email = '$remail' WHERE r_login_id = '$rid'";   
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully.</div>';
            }
            else{
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update.</div>';
            }
        }
    } 
    ?> 
        
    <form action="" method="POST">
        <div class="form-group">
            <label for="r_login_id">Requester ID</label>
            <input type="text" class="form-control" name="r_login_id" id="r_login_id" value="<?php if(isset($row['r_login_id'])){echo $row['r_login_id']; }?>" readonly>
        </div>  
        <div class="form-group">
            <label for="r_name">Name</label>
            <input type="text" class="form-control" name="r_name" id="r_name" value="<?php if(isset($row['r_login_id'])){echo $row['r_name']; }?>">
        </div>
        <div class="form-group">
            <label for="r_email">Email</label>
            <input type="email" class="form-control" name="r_email" id="r_email" value="<?php if(isset($row['r_email'])){echo $row['r_email']; }?>">    
        </div>  
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="requester.php" class="btn btn-secondary">Close</a>
        </div>   
        <?php if(isset($msg)){echo $msg;} ?>
    </form>

</div> <!-- End 2nd Column --> 
<?php
include('includes/footer.php');    
?>
