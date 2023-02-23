 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
     <div id="sidebar-collapse">
         <div class="admin-block d-flex">
             <div>
                 <?php
                    $user_type = $this->uri->segment(1);

                    $uri_last_segment = end($this->uri->segments);
                    if (empty($this->session->userdata(session_franchise_profile_image) || ($this->session->userdata(session_franchise_profile_image)) == null) || ($this->session->userdata(session_franchise_profile_image)) == '') { ?>

                     <img src="<?= base_url('assets/images/admin-avatar.png') ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 45px;">

                 <?php
                    } else { ?>
                     <img src="<?= base_url($this->session->userdata(session_franchise_profile_image)) ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 45px;">
                 <?php
                    }
                    ?>
             </div>
             <div class="admin-info">
                 <div class="font-strong"><?= strtoupper($this->session->userdata(session_franchise_name)) ?></div>
                 <small><?= strtoupper($this->session->userdata(session_franchise_user_type)) ?></small>
             </div>
         </div>

         <input type="hidden" value="<?= $this->session->userdata(session_franchise_type_id) ?>" id="user_type">

         <ul class="side-menu metismenu">

             <li>
                 <a href="<?= base_url($user_type . '/dashboard') ?>" id="dashboard_page">
                     <i class="sidebar-item-icon fa fa-th-large"></i>
                     <span class="nav-label">Dashboard</span>
                 </a>
             </li>

             <li>
                 <a href="<?= base_url($user_type . '/recharge_history') ?>" id="recharge_history_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'recharge_history') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-th"></i>
                     <span class="nav-label">Recharge History</span>
                 </a>
             </li>

             <li class="heading">FEATURES</li>

             <?php
                if ($user_type == user_type_franchise) {
                    if ($this->session->userdata(fr_session_subfranchise_data) == "active" || $this->session->userdata(fr_session_subfranchise_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url($user_type . '/subfranchise') ?>" id="subfranchise_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'subfranchise') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-sitemap"></i>
                             <span class="nav-label">Sub Franchise</span>
                         </a>
                     </li>
             <?php
                    }
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_sarathi_data) == "active" || $this->session->userdata(fr_session_sarathi_data) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . saathi) ?>" id="sarathi_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'saathi') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-smile-o"></i>
                         <span class="nav-label">Saathi</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(fr_session_sarathi_data) == "active" || $this->session->userdata(fr_session_sarathi_data) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/saathi/request') ?>" id="sarathi_request_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'request') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-plus"></i>
                         <span class="nav-label">New Saathi Request</span>
                     </a>
                 </li>
             <?php
                }
                ?>




             <?php
                if ($this->session->userdata(fr_session_driver_data) == "active" || $this->session->userdata(fr_session_driver_data) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/driver') ?>" id="driver_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'driver') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-life-bouy"></i>
                         <span class="nav-label">Drivers</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(fr_session_driver_data) == "active" || $this->session->userdata(fr_session_driver_data) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/driver/location') ?>" id="dl_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'location') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-life-bouy"></i>
                         <span class="nav-label">Driver Location</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_incentive) == "active" || $this->session->userdata(fr_session_incentive) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/incentives') ?>" id="incentives_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'incentives') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-rupee"></i>
                         <span class="nav-label">Incentives</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(fr_session_call_booking) == "active" || $this->session->userdata(fr_session_call_booking) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/call_booking') ?>" id="booking_call" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'call_booking') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-phone"></i>
                         <span class="nav-label">Call Booking</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(fr_session_ride_rental) == "active" || $this->session->userdata(fr_session_ride_rental) == const_active) { ?>
                 <li>
                     <a href="javascript:;" id="rental_page"><i class="sidebar-item-icon fa fa-car"></i>
                         <span class="nav-label">Rental</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url($user_type . '/rental/slabs') ?>">Rental Slabs</a>
                         </li>
                         <li>
                             <a href="<?= base_url($user_type . '/rental/features') ?>">Rental Features</a>
                         </li>
                         <li>
                             <a href="<?= base_url($user_type . '/rental/details') ?>">Rental Details</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }

                ?>


             <?php
                if ($this->session->userdata(fr_session_fare_list) == "active" || $this->session->userdata(fr_session_fare_list) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/fare_management') ?>" id="fare_list_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'fare_management') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-file-text-o"></i>
                         <span class="nav-label">Fare Management</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_service_ride) == "active" || $this->session->userdata(fr_session_service_ride) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/services') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'services') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-gears"></i>
                         <span class="nav-label">Services</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(fr_session_compliments) == "active" || $this->session->userdata(fr_session_compliments) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/compliments') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'compliments') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Compliments</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_achivements) == "active" || $this->session->userdata(fr_session_achivements) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/achivements') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'achivements') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Achivements</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_help) == "active" || $this->session->userdata(fr_session_help) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/help') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'help') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-hand-stop-o"></i>
                         <span class="nav-label">Help</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_feedback) == "active" || $this->session->userdata(fr_session_feedback) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/feedback') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'feedback') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-star"></i>
                         <span class="nav-label">Feedback</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_reports) == "active" || $this->session->userdata(fr_session_reports) == const_active) { ?>
                 <li>
                     <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                         <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url($user_type . '/resolve_reports') ?>">Resolved Reports</a>
                         </li>
                         <li>
                             <a href="<?= base_url($user_type . '/unresolve_reports') ?>">Unresolved Reports</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(fr_session_places) == "active" || $this->session->userdata(fr_session_places) == const_active) { ?>
                 <li>
                     <a href="<?= base_url($user_type . '/places') ?>" id="booking_call" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'places') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-map-marker"></i>
                         <span class="nav-label">Places</span>
                     </a>
                 </li>
             <?php
                }
                ?>
         </ul>
     </div>
 </nav>

 <script>
     let user_type = $('#user_type').val();
     if (user_type == "user_sub_franchise") {
         $('#subfranchise_page').hide();
         $('#sarathi_request_page').hide();
     }
 </script>
 <!-- END SIDEBAR-->