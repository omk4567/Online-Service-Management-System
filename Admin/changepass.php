<?php    
define('TITLE', 'Change Password');
define('PAGE', 'changepass');      
include('includes/header.php');   
include('../dbConnection.php');
session_start();         
if($_SESSION['is_adminlogin']){
    $aEmail = $_SESSION['aEmail'];    
}     
else{
    echo "<script> location.href='adminLogin.php';</script>";              
}                                                                                            
$aEmail = $_SESSION['aEmail'];
 if(isset($_REQUEST['passupdate'])){
  if(($_REQUEST['aPassword'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Password can not be empty. </div>';
  } else {
    $sql = "SELECT * FROM adminlogin_tb WHERE a_email='$aEmail'";       
    $result = $conn->query($sql);         
    if($result->num_rows == 1){       
     $row = $result->fetch_assoc();   
     $oldPass = $row['a_password'];        
     $aPass = $_REQUEST['aPassword'];    
     if($aPass == $oldPass){
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Enter a different password. </div>';
     }               
     else{
        $sql = "UPDATE adminlogin_tb SET a_password = '$aPass' WHERE a_email = '$aEmail'";
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully </div>';
      } else {
       // below msg display on form submit failed
       $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Password. </div>';
      }    
     }                                         
     
    }
   }
}     

?>  

<!-- Start Admin Change Password 2nd Column -->
<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $aEmail ?>" readonly>   
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="aPassword">
        </div>
        <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">Reset</button>
      </form>
        
    </div>

  </div>
  <?php if(isset($passmsg)) {echo $passmsg; } ?>      
</div>  
<!-- Start Admin Change Password 2nd Column -->       

</div>  
</div>

<?php
include('includes/footer.php');
?>       




