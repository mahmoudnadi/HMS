<?php
  include("header.php");
  ini_set('display error',1);
  error_reporting(E_ALL);
?>
<?php
 require_once 'functions.php';
 if(isset($_POST['submit']) && isset($_POST['accessibility'])
 && isset($_POST['roomNum']) && isset($_POST['roomStatusActive'])
 && isset($_POST['availability']) && isset($_POST['roomType'])){
   $access = (int) sanitizeString($_POST['accessibility']);
   $roomNum = (int)sanitizeString($_POST['roomNum']);
   $roomType_ID = (int) sanitizeString($_POST['roomType']);
   $active = (int) sanitizeString($_POST['roomStatusActive']);
   $roomStatus = (int)sanitizeString($_POST['availability']);

   $stmt = $conn->prepare("UPDATE rooms SET roomType_ID=?, active=?, access=?, status_ID=? WHERE room_id=?");
   $stmt->bind_param("iiiii",$roomType_ID,$active,$access,$roomStatus,$roomNum);
   $stmt->execute();
   if(!$stmt ->error) echo "<script>alert('Room Successfully Updated!')</script>";
   else echo "<script>alert('Room Unsuccessfully Updated!')</script>";
   $stmt->close();
 }
 if(isset($_POST['delete']) && isset($_POST['accessibility'])
 && isset($_POST['roomNum']) && isset($_POST['roomStatusActive'])
 && isset($_POST['availability']) && isset($_POST['roomType'])){
   $roomNum = $_POST['roomNum'];
   $stmt = $conn ->prepare("DELETE FROM rooms WHERE room_id=?");
   $stmt->bind_param("i", $roomNum);
   $stmt->execute();
   if(!$stmt ->error) echo "<script>alert('Room Deleted!')</script>";
   else echo "<script>alert('--ERROR: Room Unsuccessfully Deleted.')</script>";
   $stmt->close();
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
               <h2>Edit Room</h2>
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
       <!-- edit room-->
       <div class="col mt-5">
         <div class="card">
             <div id="accordion4" class="according accordion-s3 gradiant-bg">
               <div class="card">
                 <div class="card-header">
                   <a class="card-link" href="#">Edit Room</a>
                 </div>
                 <div id="accordion41"  data-parent="#accordion4">
                   <div class="card-body">
                     <form onsubmit='return confirm("Are you sure you want to make this change?");' action="editRoom.php" method="post">

                       <div class="form-group">
                         <b class="text-muted mb-3 mt-4 d-block">Select Room: </b>
                         <select  class="custom-select col-sm-2 " id="roomNum" name="roomNum">
                           <option disabled selected>-- Select Room --</option>
                           <?php
                             $result= $conn->query("SELECT * FROM rooms");
                             if(!$result) die("Fatal Error");
                             $rows=$result->num_rows;
                             for($j = 0; $j < $rows; ++$j){
                               $row = $result->fetch_array(MYSQLI_ASSOC);
                               echo '<option value="' . $row['room_id'] . '">' . $row['room_id'] . '</option>';
                             }
                             echo "</select>";
                            ?>
                       </div>
                       <div class="form-group">
                          <b class="text-muted mb-3 mt-4 d-block">Room Type: </b>
                         <select  class="custom-select col-sm-2 " id="roomType" name="roomType">
                           <option disabled selected>-- Room Type --</option>
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
                         <b class="text-muted mb-3 mt-4 d-block">Status: </b>
                         <select id="roomStatusActive" name="roomStatusActive" class="custom-select col-sm-2">
                           <option disabled selected>Options</option>
                           <option id="active" value="1">Active</option>
                           <option id="inactive" value="0">Inactive</option>
                         </select>
                       </div>
                       <div class="form-group">
                         <b class="text-muted mb-3 mt-4 d-block">Select Room Status: </b>
                         <select  class="custom-select col-sm-2 " id="availability" name="availability">
                           <option disabled selected>-- Availability --</option>
                           <?php
                             $result= $conn->query("SELECT * FROM roomstatus");
                             if(!$result) die("Fatal Error");
                             $rows=$result->num_rows;
                             for($j = 0; $j < $rows; ++$j){
                               $row = $result->fetch_array(MYSQLI_ASSOC);
                                 echo '<option value="' . $row['status_ID'] . '">' . $row['rm_Status'] . '</option>';
                             }
                             echo "</select>";
                            ?>
                       </div>
                       <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-4 pr-4 pl-4">
                      <input type="submit" name="delete" value="Delete" class="btn btn-danger mt-4 pr-4 pl-4">
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
<script>
    $(document).ready(function(){
      $('#roomNum').change(function(){
        var room_id = $(this).val();
        $.ajax({
          method:'post',
          url:'editRoomFillForm.php',
          data:{room_id:room_id},
          dataType:'json',
          success: function(result){
            if(result.access == 1){
              $("input:radio[id='access']").trigger('click');
            }
            if(result.access == 0){
              $("input:radio[id='non-access']").trigger('click');
            }

            $('#availability option[value="' + result.status_ID + '"]').prop({defaultSelected: true});
            $('#roomStatusActive option[value="' + result.active + '"]').prop({defaultSelected: true});
            $('#roomType option[value="' + result.roomType_ID + '"]').prop({defaultSelected: true});
          }
        });
      });
    });
</script>
</body>
</html>
