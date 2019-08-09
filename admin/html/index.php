<?php
  include("header.php");
  ini_set('display error',1);
  error_reporting(E_ALL);
 ?>
<script>var currentPage = "dashboard";</script>
        <!-- main content area start -->
        <div class="main-content">

            <div class="header-area">
                <div class="row align-items-center">
                  <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="pull-left">
                      <h2>Dashboard</h2>
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
            <!-- page title area end -->
            <div class="main-content-inner">

            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area start-->
<?php include("footer.php");?>
</body>
</html>
