 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
     <div id="sidebar-collapse">
         <div class="admin-block d-flex">
             <div>
                 <?php
                    if (empty($this->session->userdata(session_hotel_image))) { ?>
                     <img src="<?= base_url(); ?>/assets/images/admin-avatar.png" width="45px" />
                 <?Php
                    } else { ?>
                     <img src="<?= base_url($this->session->userdata(session_hotel_image)) ?>" width="45px" />

                 <?php
                    }
                    ?>
             </div>

             <div class="admin-info">
                 <div class="font-strong"><?= ucwords($this->session->userdata(session_hotel_name)) ?></div>
                 <small><?= ucwords($this->session->userdata(session_hotel_mobile)) ?></small>
             </div>
         </div>

         <?php $uri_last_segment = end($this->uri->segments); ?>

         <ul class="side-menu metismenu">
             <li>
                 <a href="<?= base_url('hotel/dashboard') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'dashboard') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-th-large"></i>
                     <span class="nav-label">Dashboard</span>
                 </a>
             </li>
             <li class="heading">FEATURES</li>

             <li>
                 <a href="<?=base_url('hotel/call_booking')?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'call_booking') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-users"></i>
                     <span class="nav-label">Booking</span>
                 </a>
             </li>

             


             <!--<li>
                        <a href="content-management.html">
                            <i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Content Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="scheme-manageemnt.html">
                            <i class="sidebar-item-icon fa fa-th"></i>
                            <span class="nav-label">Scheme Manageemnt</span>
                        </a>
                    </li>
                    <li>
                        <a href="coupon-management.html">
                            <i class="sidebar-item-icon fa fa-gift"></i>
                            <span class="nav-label">Coupon Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="access-management.html">
                            <i class="sidebar-item-icon fa fa-gears"></i>
                            <span class="nav-label">Access Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="financial-management.html">
                            <i class="sidebar-item-icon fa fa-gear"></i>
                            <span class="nav-label">Financial Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="km-settings.html">
                            <i class="sidebar-item-icon fa fa-sun-o"></i>
                            <span class="nav-label">KM Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="commission-settings.html">
                            <i class="sidebar-item-icon fa fa-snowflake-o"></i>
                            <span class="nav-label">Commission Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="transaction.html">
                            <i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Transaction</span>
                        </a>
                    </li>
                    <li>
                        <a href="supports.html">
                            <i class="sidebar-item-icon fa fa-question-circle"></i>
                            <span class="nav-label">Supports</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="maps.html">
                            <i class="sidebar-item-icon fa fa-map-marker"></i>
                            <span class="nav-label">Maps</span>
                        </a>
                    </li> -->
         </ul>
     </div>
 </nav>

 <script>
     let user_type = $('#user_type').val();
     if (user_type == "user_admin") {
         $('#admin_page').hide();

     }
 </script>
 <!-- END SIDEBAR-->