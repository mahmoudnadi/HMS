<?php
  include("insertRoomType.php");
  include("editRoomType.php");
  include("header.php");
  ini_set('display error',1);
  error_reporting(E_ALL);
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
                      <h2>Room Types</h2>
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
              <div class="col-12 mt-5">
                <div class="card">
                    <div id="accordion4" class="according accordion-s3 gradiant-bg">
                      <div class="card">
                        <div class="card-header">
                          <a class="card-link" data-toggle="collapse" href="#accordion41">Add Room Type</a>
                        </div>
                    		<div id="accordion41" class="collapse" data-parent="#accordion4">
                    			<div class="card-body">
                    				<form action="roomTypes.php" method="post">
                              <input type="hidden" id="addRoom" name="addRoom">
                    					<div class="form-group">
                    						<label for="name" class="col-form-label">Name</label>
                    						<input required class="form-control" type="text" name= "name">
                    					</div>
                    					<div class="form-group">
                    						<label for="description" class="col-form-label">Description</label>
                    						<input required class="form-control" type="text" name="description">
                    					</div>
                              <div class="form-row align-items-center">
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="adults">Maximum Number Of Adults:</label>
                                    <input required type="number" class="form-control" name="adults" value="0" min="0" max="10">
                                </div>
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="children">Maximum Number Of Children:</label>
                                    <input required type="number" class="form-control" name="children" value="0" min="0" max="10">
                                </div>
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="extra">Extra:</label>
                                    <input required type="number" class="form-control" name="extra" value="0" min="0" max="10">
                                </div>
                              </div>
                              <div class="form-group">
                    						<label for="price" class="col-form-label">Price</label>
                    						<input required class="form-control" type="DECIMAL" name= "price">
                    					</div>
                              <b class="text-muted mb-3 mt-4 d-block">Status:</b>
                              <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" checked id="active" name="roomStatus" value="1" class="custom-control-input">
                                  <label class="custom-control-label" for="active">Active</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="inactive" name="roomStatus" value="0" class="custom-control-input">
                                  <label class="custom-control-label" for="inactive">Inactive</label>
                              </div>
                              <b class="text-muted mb-3 mt-4 d-block">Included Amenities:</b>
                              <div class="form-body card-body">
                                <?php
                                      $stmt = $conn ->query("SELECT * FROM includedamenities");
                                      if(!$stmt) die("Table doesn't exist");
                                      $rows=$stmt ->num_rows;
                                      for($j = 0; $j < $rows; ++$j){
                                  			$row = $stmt->fetch_array(MYSQLI_ASSOC);
                                        echo '<div class=" custom-control custom-checkbox custom-control-inline">
                                              <input type="checkbox" class="custom-control-input" name="amenities[]" value="' .$row['amenity_ID'].'"' . ' id="id' . $row['amenity_ID'] .'">
                                              <label class="custom-control-label" for="id' . $row['amenity_ID'] .'">' . $row['amenity_Name'] .'</label>
                                        </div>';
                                  		}
                                 ?>
                              </div>
                              <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-4 pr-4 pl-4">
                            </form>
                    			</div>
                    		</div>
                      </div>
    	               </div>
                 </div>
               </div>
              <!-- edit room types -->
              <div class="col-12 mt-5">
                <div class="card">
                    <div id="accordion4" class="according accordion-s3 gradiant-bg">
                      <div class="card">
                        <div class="card-header">
                          <a class="card-link" data-toggle="collapse" href="#editRoom">Edit Room Type</a>
                        </div>
                    		<div id="editRoom" class="collapse" data-parent="#accordion4">
                    			<div class="card-body">
                            <div  class="card">
                              <form action="" method="post">
                                <div class="form-group custom-control">
                                  <label for="selection" class="col-form-label">Select Room Type: </label>
                                    <select  class="custom-select col-6 " id="selection" name="selection">
                                      <option disabled selected>Options</option>
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
                              </form>
                            </div>
                    				<form onsubmit='return confirm("Are you sure you want to make current change?");' id="roomInfo" style="display:none" action="roomTypes.php" method="post">
                              <input type="hidden" id="editRoom" name="editRoom" value="true">
                              <input type="hidden" id="roomType_ID" name="roomType_ID" value="">
                              <div class="form-group">
                    						<label for="name2" class="col-form-label">Name</label>
                    						<input required class="form-control" type="text" id="name2" name= "name" value= "">
                    					</div>
                    					<div class="form-group">
                    						<label for="description2" class="col-form-label">Description</label>
                    						<input required class="form-control" type="text" id="description2" name="description" value="">
                    					</div>
                              <div class="form-row align-items-center">
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="adults2">Maximum Number Of Adults:</label>
                                    <input required type="number" class="form-control" id="adults2" name="adults" value="" min="0" max="10">
                                </div>
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="children2">Maximum Number Of Children:</label>
                                    <input required type="number" class="form-control" id="children2" name="children" value="" min="0" max="10">
                                </div>
                                <div class="col-sm-4 my-1">
                                    <label class="col-form-label" for="extra2">Extra:</label>
                                    <input required type="number" class="form-control" id="extra2" name="extra" value="" min="0" max="10">
                                </div>
                              </div>
                              <div class="form-group">
                    						<label for="price2" class="col-form-label">Price</label>
                    						<input required class="form-control" type="DECIMAL" value="" id="price2" name= "price">
                    					</div>
                              <b class="col-form-label">Status: <br></b>
                              <select id="roomStatus2" name="roomStatus" class="custom-select col-sm-2">
                                <option disabled selected>Options</option>
                                <option id="active" value="1">Active</option>
                                <option id="inactive" value="0">Inactive</option>
                              </select>
                              <b class="text-muted mb-3 mt-4 d-block">Included Amenities:</b>
                              <div class="form-body card-body">
                                <?php
                                      $stmt = $conn ->query("SELECT * FROM includedamenities");
                                      if(!$stmt) die("Table doesn't exist");
                                      $rows=$stmt ->num_rows;
                                      for($j = 0; $j < $rows; ++$j){
                                  			$row = $stmt->fetch_array(MYSQLI_ASSOC);
                                        echo '<div class=" custom-control custom-checkbox custom-control-inline">
                                              <input type="checkbox" class="custom-control-input" name="amenities[]" value="' .$row['amenity_ID'].'"' . ' id="id' . $row['amenity_ID'] .'_2">
                                              <label class="custom-control-label" for="id' . $row['amenity_ID'] .'_2">' . $row['amenity_Name'] .'</label>
                                        </div>';
                                  		}
                                 ?>
                              </div>
                              <input type="submit" name="update" value="Update" class="btn btn-primary mt-4 pr-4 pl-4">
                              <input type="submit" name="delete" value="Delete" class="btn btn-danger mt-4 pr-4 pl-4">

                            </form>
                    			</div>
                    		</div>
                      </div>
    	               </div>
                 </div>
               </div>
              <!-- current room types -->
              <div class="col-12 mt-5">
              	<div class="card">
              		<div class="card-body">
              			<h4 class="header-title">Current Room Types</h4>
              			<div class="single-table">
              				<div class="table-responsive">
              					<table class="table table-hover progress-table text-center">
              						<thead class="text-uppercase">
              							<tr>
              								<th scope="col">Name</th>
              								<th scope="col">Adults</th>
              								<th scope="col">Children</th>
                              <th scope="col">Extra</th>
              								<th scope="col">Price</th>
              								<th scope="col">Status</th>
              							</tr>
              						</thead>
              						<tbody>
              							<?php
                                $result = queryMysql("SELECT * FROM roomTypes");
                                $rows = $result ->num_rows;
                                for($j = 0; $j < $rows; ++$j){
                                  $row = $result ->fetch_array(MYSQLI_ASSOC);
                                  if($row['roomType_ID'] != 0){
                                    echo "<tr>
                                            <td>".$row['name']."</td>
                                            <td>".$row['max_adults']."</td>
                                            <td>".$row['max_children']."</td>
                                            <td>".$row['extra']."</td>
                                            <td>".$row['price']."</td>";
                                            if($row['active'] == 1)echo "<td><p class='status-p bg-success'>Active</p></td>";
                                            elseif ($row['active'] == 0) echo "<td><p class='status-p bg-danger'>Inactive<p></td>";
                                            else echo "<td class=' bg-warning'>ERROR</td>
                                          </tr>";
                                  }

                                }
                             ?>
              						</tbody>
              					</table>
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
          $('#selection').change(function(){
            var roomType_ID = $(this).val();
            $('#roomInfo').css('display','unset');
            $('#roomType_ID').val(roomType_ID);
            
            $.ajax({
              method: 'post',
              url: 'getRoomType.php',
              data:{roomType_ID : roomType_ID},
              dataType: 'json',
              success: function(result){
                $('#roomType_ID').val(result.rm_ID);
                $('#name2').val(result.name);
                $('#description2').val(result.description);
                $('#adults2').val(result.adults);
                $('#children2').val(result.children);
                $('#extra2').val(result.extra);
                $('#price2').val(result.price);
                $('#roomStatus2 option[value="' + result.active + '"]').prop({defaultSelected: true});
                //$('#roomStatus2').val(result.active).change();
                var amenityArray = [];
                amenityArray = result.amenityArray;
                var temp="";
                for(var j = 0; j < amenityArray.length; j++){
                  $("#id" + amenityArray[j] + "_2").prop("checked",true);
                }
              }
            });
          });
        });
    </script>
  </body>
</html>
