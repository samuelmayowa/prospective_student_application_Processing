<?php
include_once('functions.php');
require_once('connection.php');
if(isset($_GET['payID'])){
 $payID =$_GET['payID'];   
 header('location:applications.php?payID='.$payID);
}
  //confirmLogin();
$file_path ="";
$filelocation="";
$stdEmail = "";
    //prepare Data
if(isset($_SESSION['stdEmail'])){
    
 
    $stdEmail=$_SESSION['stdEmail'];
    $stdPhno= $_SESSION['stdPhno'];
    
    
    $query = "SELECT  StdPassport FROM students WHERE studentEmail ='$stdEmail'";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
    while ($results  = mysqli_fetch_array($query)){
       $file_path =  $results ['StdPassport'];
      // $_SESSION['file_loc'] = $file_path;
        
       
        
    }
   // echo $file_path;
   $mydate=getdate(date("U"));
//}

}
?>
<?php 
        $stdEmail ="";
        $schlID ='';
        $matricID="";
        $matricI =$_SESSION['userID'];
        $query = "SELECT firstName, middleName,lastName, studentLevel,stdPhoneNumber, 
                yearOfEntry, studentEmail, department, faculty 
                FROM students WHERE matricNumber='$matricI'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            while ($schl = mysqli_fetch_array($query)){
            $stdLevel = $schl ['studentLevel'];
            $fname=$schl['firstName'];
             $midName= $schl['middleName'];
             $lname = $schl ['lastName'];
            $stdCode = $_SESSION['userID'];
            $dept = $schl ['department'];
            $stdPhno =$schl['stdPhoneNumber'];
            $yearOfEntry = $schl['yearOfEntry'];
            $faculty = $schl['faculty'];
            $stdEmail = $schl['studentEmail'];
            $_SESSION['stdPhno'] = $stPhno;
            $_SESSION['stdEmail']= $stdEmail;
            $_SESSION['fname'] =$fname;
            $_SESSION['midName'] = $midName;
            $_SESSION['lname'] = $lname;
            $_SESSION['dept'] =$dept;
            $_SESSION['yearOfEntry']= $yearOfEntry;
            $_SESSION['faculty'] = $faculty;
            $_SESSION['stdLevel'] = $stdLevel;
            $_SESSION['stdPhno'] = $stdPhno;
                //setcookie('stdEmail', $_SESSION['stdEmail'], time() + (3600), "/");
                //setcookie('pid', $_SESSION['pid'], time() + (3600), "/");
                   }  ?> 
<?php
include_once('../functions.php');
require_once('../connection.php');
$payID="";
if(!isset($_SESSION['userID'])){
  header("location:index.php?msg=You have not logged in") ;
} else {
if(isset($_GET['payID'])){
 $payID =$_GET['payID'];   
 header('location:applications.php?ppayID='.$payID);

$_SESSION['payID'] =$payID;
                            $matricNumber =  $_SESSION['userID'];
                            $email = $_SESSION['email'];
                            $courseCode =  $_SESSION['courseCode'];
                            $amount =  $_SESSION['amt'];
                            $_SESSION['amt'] = $amount;
                            $payType =  $_SESSION['payType'];
                            $dept =  $_SESSION['dept'];
                            $matricID =  $_SESSION['matricNumber'];
                            $semester =  $_SESSION['semester'];
                            $stdLevel =  $_SESSION['stdLevel'];
$upd ="<script>alert('Your Payment Was Successully Made to The Admin Your RefNumber:  ');</script>"; 
   
         $addpayment = "INSERT INTO studentPayments (CourseCode, MatricID, payType, 
        AmountPaid,RefNumber,  StdLevel, Semester,Amountpayable, studentEmail) 
 VALUES ('$courseCode', '$matricID', '$payType', '$amount','$payID', '$stdLevel', '$semester','$amount', '$email' )";
 
 
  $query = "SELECT RefNumber  FROM studentPayments WHERE RefNumber ='$payID'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode ==0){
        // ========End check ====== 
          $addpayment = mysqli_query($con,$addpayment) or die(mysqli_error($con));
         if(!$addpayment){
             $msg="Unable to Add Payment Details To Database".mysqli_error($con);
         }else {
             $msg ="<script>alert('Your Payment Was Successully Made to The Admin');</script>";
         }
   
    }
    else{
        $msg = "<script> alert('1 Payments Already Exist'); </script>";
                }
}
}
$stdMail=$_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            
        
        </style>
    </head>
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="index.html" style="color:#fff;">ESCOHST-IJERO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0" style="color:#fff;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color:#fff;"  id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="myProfiles.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology, Ijero-Ekiti</h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">STUDENT RECEIPTS OF PAYMENTS</h3></div>
                                     <div class="card-header"><h3 class="text-center font-weight-light my-4">
                                     <img src="<?php if(isset($file_path)){
                                                     echo  $file_path;  } else { echo 'passports/profiles-01.jpg'; }?>" alt="Avatar" style="width:10%" align="center"  > 
                                        </h3>  </div>
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        </h3>
                                                                        
                                                                        </div>
                                  
                                    <div class="card-body">
                                        
                                        
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Receipt Number:</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php if(isset($_SESSION['payID'])){ echo $_SESSION['payID']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Matric Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="receipts" value="<?php echo $stdCode;  ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Students FullName</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Std FullName" name="fna" value="<?php  echo $fname . '  '. $midName .'  ' .  $lname ;  ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php echo $dept; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Course Of Study</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php  echo $dept; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Student Level</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="student Level" name="signature" value="<?php echo $stdLevel; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                        
                                                
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Being Paid For</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Payment Description" name="description" value="<?php  if(isset($_SESSION['payType'])) { echo $_SESSION['payType']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php echo date('Y'); ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                        
                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">HOD's Signature</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value=""  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Student's Signature</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value=""  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="button" name="printCourseForm" class="btn btn-primary btn-block"><a href="generateReceipts.php?msg=<?php echo $payID; ?>" style="color:#fff; font-size:18px; padding:5px;" target="_new">Print Receipts</a></button></div>
                                             </div>
                                             </div>
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date Printed</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Sudent Sign" name="signature" value="<?php echo  $mydate[weekday].', '. $mydate[month]. '  ' . $mydate[mday].', '  .$mydate[year]; ?>"  readonly required />
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
