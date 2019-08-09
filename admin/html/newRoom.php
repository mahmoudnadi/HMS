<?php
  include("header.php");
  ini_set('display error',1);
  error_reporting(E_ALL);
  require_once 'functions.php';
 ?>
 <?php
 if(isset($_POST['submit']) && isset($_POST['accessibility'])
 && isset($_POST['selection']) && isset($_POST['roomStatusActive'])
 && isset($_POST['roomStatus'])){
   $access = (int) sanitizeString($_POST['accessibility']);
   $roomType_ID = sanitizeString($_POST['selection']);
   $active = (int) sanitizeString($_POST['roomStatusActive']);
   $roomStatus = (int)sanitizeString($_POST['roomStatus']);

   $stmt = $conn->prepare("INSERT INTO rooms(roomType_ID, active, access, status_ID) VALUES(?,?,?,?)");
   $stmt ->bind_param("iiis",$roomType_ID,$active,$access,$roomStatus);
   $stmt ->execute();
   if(!$stmt ->error) echo "<script>alert('Room Successfully Added!')</script>";
   else echo "<script>alert('Room Unsuccessfully Added!')</script>";
   $stmt ->close();
 }
 ?>
 <script>var currentPage = "rooms";</script>
 <!-- main content area start -->
 <div class="main-content">
     <!-- header area start -->
     <div class="header-area">
         <div class="row align-items-center">
           <div class="col-md-6 col-sm-8 clearfix">
             <div class="nav-btn pull-left">
                 <span></span>
                 <span></span>
                 <span></span>
             </div>
             <div class="pull-left">
               <h2>New Room</h2>
             </div>
           </div>
           <div class="col-md-6 col-sm-4 clearfix">
               <div class="user-profile pull-right">
                   <img class="avatar user-thumb" src="../images/author/avatar.png" alt="avatar">
                   <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></h4>
                   <div class="dropdown-menu">
                       <a class="dropdown-item" href="#">Message</a>
                       <a class="dropdown-item" href="#">Settings</a>
                       <a class="dropdown-item" href="#">Log Out</a>
                   </div>
               </div>
           </div>
         </div>
     </div>
     <!-- header area end -->
     <div class="main-content-inner">
       <!-- add new room type-->
       <div class="col mt-5">
         <div class="card">
             <div id="accordion4" class="according accordion-s3 gradiant-bg">
               <div class="card">
                 <div class="card-header">
                   <a class="card-link" href="#">Create New Room</a>
                 </div>
                 <div id="accordion41"  data-parent="#accordion4">
                   <div class="card-body">
                     <form onsubmit='return confirm("Are you sure you want to create this room?");' action="newRoom.php" method="post">
                       <input type="hidden" name="roomStatus" value='1'>
                       <div class="form-group custom-control">
                         <label for="selection" class="col-form-label">Select Room Type: </label>
                         <select  class="custom-select col-6 " id="selection" name="selection">
                           <option disabled selected>-- Select Room Type --</option>
                           <?php
                             $result= $conn->query("SELECT * FROM roomTypes");
                             if(!$result) die("Fatal Error");
                             $rows=$result->num_rows;
                             for($j = 0; $j < $rows; ++$j){
                               $row = $result->fetch_array(MYSQLI_ASSOC);
                                 echo '<option value="' . $row['roomType_ID'] . '">' . $row['name'] . '</option>';
                             }
                             echo "</select>";
                            ?>
                       </div>
                       <div class="form-group">
                         <b class="text-muted mb-3 mt-4 d-block">Accessibility:</b>
                         <div class="custom-control custom-radio custom-control-inline">
                             <input type="radio" id="access" name="accessibility" value="1" class="custom-control-input">
                             <label class="custom-control-label" for="access">Accessible</label>
                         </div>
                         <div class="custom-control custom-radio custom-control-inline">
                             <input type="radio" id="non-access" name="accessibility" value="0" class="custom-control-input">
                             <label class="custom-control-label" for="non-access">Non-Accessible</label>
                         </div>
                       </div>
                       <div class="form-group">
                         <b class="text-muted mb-3 mt-4 d-block">Status:</b>
                         <select id="roomStatusActive" name="roomStatusActive" class="custom-select col-sm-2">
                           <option disabled selected>Options</option>
                           <option selected id="active" value="1">Active</option>
                           <option id="inactive" value="0">Inactive</option>
                         </select>
                       </div>
                       <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-4 pr-4 pl-4">
                     </form>
                   </div>
                 </div>
               </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <!-- main content area end -->
  <!-- footer area start-->
<?php include("footer.php");?>

</body>
</html>
