<?php
define('TITLE', 'Requester Profile');         
define('PAGE', 'RequesterProfile');              
include('includes/header.php');     
include('../dbConnection.php');    
session_start();         
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];    
}     
else{
    echo "<script> location.href='RequesterLogin.php';</script>";         
}        
$sql = "SELECT r_name FROM requesterlogin_tb WHERE r_email = '$rEmail'";    
$result = $conn->query($sql);  
if($result->num_rows == 1){
    $row = $result->fetch_assoc();   
    $rName = $row['r_name'];   
}      

if(isset($_REQUEST['nameupdate'])){
    if($_REQUEST['rName'] == ""){
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields.</div>';       
    }
    else{
        $rName_new = $_REQUEST['rName'];  // rName is in the name attribute of input name field
        if($rName_new != $rName){
        $sql = "UPDATE requesterlogin_tb SET r_name = '$rName_new' WHERE r_email = '$rEmail'";   
        if($conn->query($sql) == TRUE){
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully.</div>';    
        }
        else{
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update.</div>';   
        }
        }
        else{
            $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Enter a Different Name.</div>';
        }                
               
    }
}                     
?>     
   
<div class="col-sm-6 mt-5"> <!-- Start Profile Area 2nd Column --> 
    <form action="" method="POST" class="mx-5">
        <div class="form-group">
            <label for="rEmail">Email</label><input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail; ?>" readonly>       
            </div>  
            <div class="form-group">
            <label for="rName">Name</label><input type="text" class="form-control" name="rName" id="rName" value="<?php echo $rName; ?>">      
            </div>   
            <button type="submit" class="btn btn-danger" name="nameupdate">Update</button>   
            <?php if(isset($passmsg)){
                        echo $passmsg;
             } ?>   
    </form>     
</div> <!-- End Profile Area 2nd Column -->      
</div> <!-- End Row --> 
</div> <!-- End Container -->   
<?php
include('includes/footer.php');   
?>                                                         


