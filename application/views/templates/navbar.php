<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>home" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
    
      <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-user-tie nav-icon"></i>
              <?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } ?>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <i class="fas fa-user-tie nav-icon"></i>
              <?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } ?><br>
              <?php if(isset($_SESSION['user_type'])){ echo strtoupper($_SESSION['user_type']); } ?>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>home" class="brand-link">
      <img src="<?php echo base_url()."assets/"; ?>login/sogo.jpg" alt="Logo" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">OOS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <?php     
      $PLACEDcnt = 1;
      $PREPARINGcnt = 1;

        foreach($vieworders as $or){

          if($_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "ba"){
            
            if($or['order_status'] == "PLACED" ){ 
                $PLACED = $PLACEDcnt++;  
            }
              
          }

          if($_SESSION['user_type'] == "fd"){
              if($_SESSION['branch_id'] == $or['branch_id']){
                  if($or['order_status'] == "PLACED" ){ 
                      $PLACED = $PLACEDcnt++;  
                  }
              }
          }

          if($_SESSION['user_type'] == "kitchen"){
              if($_SESSION['branch_id'] == $or['branch_id']){
                  if($or['order_status'] == "PREPARING TO COOK"){
                      $PREPARING = $PREPARINGcnt++;  
                  }
              }
          }
        } 
      ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Orders</li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>orders" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                New Orders
                <?php
                  if($_SESSION['user_type'] == "fd" || $_SESSION['user_type'] == "admin" || $_SESSION['user_type'] == "ba"){
                    if(isset($PLACED)){
                      echo" <span class='badge badge-info right'>$PLACED</span>";
                    }else{
                      echo" <span class='badge badge-info right'>0</span>";
                    }
                  }
      
                  if($_SESSION['user_type'] == "kitchen"){
                    if(isset($PREPARING)){
                      echo" <span class='badge badge-info right'>$PREPARING</span>";
                    }else{
                      echo" <span class='badge badge-info right'>0</span>";
                    }
                  }
                ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>completed" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Completed
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>cancelled" class="nav-link">
              <i class="nav-icon fas fa-window-close"></i>
              <p>
                Cancelled
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>

          <li class="nav-header">Settings</li>

          <li class="nav-item has-treeview">
            <?php if($_SESSION['food_menu_access'] == 1) : ?>
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Food Menu
                  <i class="fas fa-angle-right right"></i>
                </p>
              </a>
            <?php endif; ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>menu/add" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>menu" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
          <?php if($_SESSION['promo_codes_access'] == 1) : ?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Promo Codes
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>promo/add" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>promo" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
            <?php endif; ?>
          </li>

          <li class="nav-item has-treeview">
          <?php if($_SESSION['profile_access'] == 1) : ?>
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Profiles
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>profile/add" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>profile" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
            <?php endif; ?>
          </li>

          <li class="nav-item has-treeview">
          <?php if($_SESSION['branches_access'] == 1) : ?>
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-building"></i>
              <p>
                Branches
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>branch/add" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>branch" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
            <?php endif; ?>
          </li>

          <?php if($_SESSION['logs_access'] == 1) : ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>logs" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Logs
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <?php endif; ?>
          
          <!-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Profiles
              </p>
            </a>
          </li> -->
          
          
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>