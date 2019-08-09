<?php
  include("header.php");
  ini_set('display error',1);
  error_reporting(E_ALL);
  require_once 'functions.php';
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
                      <h2>View Rooms</h2>
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
              <div class="col-12 mt-5">
              	<div class="card">
              		<div class="card-body">
              			<h4 class=" header-title">Current Rooms</h4>
              			<div class="data-tables">
              				<div class="table-responsive">
              					<table id="dataTable" class="table table-hover progress-table text-center">
              						<thead class=" bg-tableHeader text-uppercase">
              							<tr>
                              <th scope="col">Room Number</th>
              								<th scope="col">Room Type</th>
              								<th scope="col">Adults</th>
              								<th scope="col">Children</th>
                              <th scope="col">Extra</th>
              								<th scope="col">Price</th>
              								<th scope="col">Active</th>
                              <th scope="col">Accessible</th>
                              <th scope="col">Room Status</th>
              							</tr>
              						</thead>
              						<tbody>
              							<?php
                                $result = queryMysql('
                                SELECT rooms.room_id AS "roomNum",
                                roomtypes.name AS "roomType",
                                roomtypes.max_adults AS "adults",
                                roomtypes.max_children AS "children",
                                roomtypes.extra AS "extra",
                                roomtypes.price AS "price",
                                rooms.active AS "active",
                                rooms.access AS "accessibility",
                                roomstatus.rm_Status AS "roomStatus"
                                FROM rooms
                                LEFT JOIN roomtypes ON roomtypes.roomType_ID = rooms.roomType_ID
                                LEFT JOIN roomstatus ON roomstatus.status_ID = rooms.status_ID
                                ORDER BY rooms.room_id');
                                $rows = $result ->num_rows;
                                for($j = 0; $j < $rows; ++$j){
                                  $row = $result ->fetch_array(MYSQLI_ASSOC);
                                  echo "<tr>
                                          <td>".$row['roomNum']."</td>
                                          <td>".$row['roomType']."</td>
                                          <td>".$row['adults']."</td>
                                          <td>".$row['children']."</td>
                                          <td>".$row['extra']."</td>
                                          <td>".$row['price']."</td>";
                                          if($row['active'] == 1)echo "<td><p class='status-p bg-success'>Active</p></td>";
                                          elseif ($row['active'] == 0) echo "<td><p class='status-p bg-danger'>Inactive<p></td>";
                                          else echo "<td class=' bg-warning'>ERROR</td>";
                                          if($row['accessibility'] == 1) echo "<td>Yes</td>";
                                          else if($row['accessibility'] == 0) echo "<td>No</td>";
                                          else echo "<td>ERROR</td>";
                                          echo "<td>".$row['roomStatus']."</td>
                                        </tr>";
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
  </body>
</html>
