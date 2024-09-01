<?php
define('TITLE', 'Insert Technician'); 
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

if(isset($_REQUEST['empsubmit'])){   
    // Checking for Empty Fields
    if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){   
     // msg displayed if required field missing
     $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">All Fields are Mandatory.</div>';
    } 
    else{    
      // Assigning User Values to Variable
      $eName = $_REQUEST['empName'];
      $eCity = $_REQUEST['empCity'];
      $eMobile = $_REQUEST['empMobile'];
      $eEmail = $_REQUEST['empEmail'];     
      $sql = "INSERT INTO technician_tb (empName, empCity, empMobile, empEmail) VALUES ('$eName', '$eCity', '$eMobile', '$eEmail')";    
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Technician Added Successfully. </div>';
      } else {
       // below msg display on form submit failed
       $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add. </div>';   
      }
    }
}
?>     
<!-- Start 2nd Column --> 
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Technician</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empName">Name</label>
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
    <div class="form-group">
      <label for="empCity">City</label>
      <input type="text" class="form-control" id="empCity" name="empCity">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" pattern="\d{10}" maxlength="10">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail">  
    </div>             
    <div class="text-center">   
      <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit">Submit</button>
      <a href="technician.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div> <!-- End 2nd Column -->     

<!-- Only Number for Input fields -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);  
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();    
        }
    }
 </script>    
<?php
include('includes/footer.php');    
?>     
