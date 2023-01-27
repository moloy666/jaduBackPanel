 <!-- START SIDEBAR-->
 <nav class="page-sidebar">
     <div id="sidebar-collapse">
         <div class="admin-block d-flex">
             <div>
                 <?php
                    if (empty($this->session->userdata(field_profile_image))) { ?>
                     <img src="<?= base_url(); ?>/assets/images/admin-avatar.png" width="45px" />
                 <?Php
                    } else { ?>
                     <img src="<?= base_url($this->session->userdata(field_profile_image)) ?>" width="45px" />

                 <?php
                    }
                    ?>
             </div>
             <div class="admin-info">
                 <div class="font-strong"><?= ucwords($this->session->userdata(field_name)) ?></div>
                 <small><?= ucwords($this->session->userdata(field_user_type)) ?></small>
             </div>
         </div>

         <input type="hidden" class="form-control" value="<?= $this->session->userdata(field_type_id) ?>" id="user_type">

         <?php $uri_last_segment = end($this->uri->segments); ?>

         <ul class="side-menu metismenu">
             <li>
                 <a href="<?= base_url('administrator/dashboard') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'dashboard') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-th-large"></i>
                     <span class="nav-label">Dashboard</span>
                 </a>
             </li>
             <!-- <li class="heading">FEATURES</li> -->

             <li>
                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/ride_details') ?>" id="" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'ride_details') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-life-bouy"></i>
                     <span class="nav-label">Ride Details</span>
                 </a>
             </li>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_customers_data) == "active" || $this->session->userdata(session_customers_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/customers') ?>" id="customers" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'customers') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-users"></i>
                             <span class="nav-label">Customers</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/customers') ?>" id="customers" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'customers') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-users"></i>
                         <span class="nav-label">Customers</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <li>
                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/admin') ?>" id="admin_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'admin') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-tachometer"></i>
                     <span class="nav-label">Admin</span>
                 </a>
             </li>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_franchise_data) == "active" || $this->session->userdata(session_franchise_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/franchise') ?>" id="franchise_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'franchise') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-sitemap"></i>
                             <span class="nav-label">Franchise</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/franchise') ?>" id="franchise_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'franchise') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-sitemap"></i>
                         <span class="nav-label">Franchise</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_subfranchise_data) == "active" || $this->session->userdata(session_subfranchise_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/sub_franchise') ?>" id="sub_franchise_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'sub_franchise') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-sitemap"></i>
                             <span class="nav-label">Sub-Franchise</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/sub_franchise') ?>" id="sub_franchise_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'sub_franchise') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-sitemap"></i>
                         <span class="nav-label">Sub-Franchise</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_sarathi_data) == "active" || $this->session->userdata(session_sarathi_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . saathi) ?>" id="sarathi_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'saathi') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-smile-o"></i>
                             <span class="nav-label">Sarathi</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . saathi) ?>" id="sarathi_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'saathi') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-smile-o"></i>
                         <span class="nav-label">Saathi</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_driver_data) == "active" || $this->session->userdata(session_driver_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/driver') ?>" id="driver_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'driver') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-life-bouy"></i>
                             <span class="nav-label">Drivers</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/driver') ?>" id="driver_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'driver') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-life-bouy"></i>
                         <span class="nav-label">Drivers</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_driver_data) == "active" || $this->session->userdata(session_driver_data) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/driver/location') ?>" id="" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'location') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-map-marker"></i>
                             <span class="nav-label">Drivers Location</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/driver/location') ?>" id="" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'location') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-map-marker"></i>
                         <span class="nav-label">Drivers Location</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <!-- <li>
                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/dormant_account') ?>" id="driver_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'dormant_account') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-users"></i>
                     <span class="nav-label">Dormant Account</span>
                 </a>
             </li> -->

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_coupon) == "active" || $this->session->userdata(session_coupon) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/coupons') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'coupons') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-money"></i>
                             <span class="nav-label">Coupons</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/coupons') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'coupons') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-gift"></i>
                         <span class="nav-label">Coupons</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_incentive) == "active" || $this->session->userdata(session_incentive) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/incentives') ?>" id="incentives_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'incentives') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-rupee"></i>
                             <span class="nav-label">Incentives</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/incentives') ?>" id="incentives_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'incentives') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-th"></i>
                         <span class="nav-label">Incentives</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_call_booking) == "active" || $this->session->userdata(session_call_booking) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/call_booking') ?>" id="booking_call" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'call_booking') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-phone"></i>
                             <span class="nav-label">Call Booking</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/call_booking') ?>" id="booking_call" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'call_booking') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-phone"></i>
                         <span class="nav-label">Call Booking</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <li>
                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/hotel') ?>" id="hotel" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'hotel') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-building"></i>
                     <span class="nav-label">Hotels</span>
                 </a>
             </li>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_places) == "active" || $this->session->userdata(session_places) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/places') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'places') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-map-marker"></i>
                             <span class="nav-label">Add Places</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/places') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'places') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-map-marker"></i>
                         <span class="nav-label">Add Places</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_packages) == "active" || $this->session->userdata(session_packages) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/packages') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'packages') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-money"></i>
                             <span class="nav-label">Packages</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/packages') ?>" id="coupon" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'packages') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-gift"></i>
                         <span class="nav-label">Packages</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_ride_rental) == "active" || $this->session->userdata(session_ride_rental) == const_active) { ?>
                     <li>
                         <a href="javascript:;" id="rental_page"><i class="sidebar-item-icon fa fa-car"></i>
                             <span class="nav-label">Rental</span><i class="fa fa-angle-left arrow"></i></a>
                         <ul class="nav-2-level collapse">
                             <li>
                                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/slabs') ?>">Rental Slabs</a>
                             </li>
                             <li>
                                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/features') ?>">Rental Features</a>
                             </li>
                             <li>
                                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/details') ?>">Rental Details</a>
                             </li>
                         </ul>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="javascript:;" id="rental_page"><i class="sidebar-item-icon fa fa-car"></i>
                         <span class="nav-label">Rental</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/slabs') ?>">Rental Slabs</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/features') ?>">Rental Features</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_ADMIN . '/rental/details') ?>">Rental Details</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_fare_list) == "active" || $this->session->userdata(session_fare_list) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/fare_management') ?>" id="fare_list_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'fare_management') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-file-text-o"></i>
                             <span class="nav-label">Fare Management</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/fare_management') ?>" id="fare_list_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'fare_management') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-file-text-o"></i>
                         <span class="nav-label">Fare Management</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_service_ride) == "active" || $this->session->userdata(session_service_ride) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/services') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'services') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-gears"></i>
                             <span class="nav-label">Services</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/services') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'services') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-gears"></i>
                         <span class="nav-label">Services</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_compliments) == "active" || $this->session->userdata(session_compliments) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/compliments') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'compliments') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-list"></i>
                             <span class="nav-label">Compliments</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/compliments') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'compliments') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Compliments</span>
                     </a>
                 </li>
             <?php
                }
                ?>



             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_achivements) == "active" || $this->session->userdata(session_achivements) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/achivements') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'achivements') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-list"></i>
                             <span class="nav-label">Achivements</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/achivements') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'achivements') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Achivements</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_help) == "active" || $this->session->userdata(session_help) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/help') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'help') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-hand-stop-o"></i>
                             <span class="nav-label">Help</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/help') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'help') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-hand-stop-o"></i>
                         <span class="nav-label">Help</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_feedback) == "active" || $this->session->userdata(session_feedback) == const_active) { ?>
                     <li>
                         <a href="<?= base_url(WEB_PORTAL_ADMIN . '/feedback') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'feedback') ? 'active' : '' ?>">
                             <i class="sidebar-item-icon fa fa-star"></i>
                             <span class="nav-label">Feedback</span>
                         </a>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_ADMIN . '/feedback') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'feedback') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-star"></i>
                         <span class="nav-label">Feedback</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(field_type_id) == "user_admin") {
                    if ($this->session->userdata(session_reports) == "active" || $this->session->userdata(session_reports) == const_active) { ?>
                     <li>
                         <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                             <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i></a>
                         <ul class="nav-2-level collapse">
                             <li>
                                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/resolve_reports') ?>">Resolved Reports</a>
                             </li>
                             <li>
                                 <a href="<?= base_url(WEB_PORTAL_ADMIN . '/unresolve_reports') ?>">Unresolved Reports</a>
                             </li>
                         </ul>
                     </li>
                 <?php
                    }
                } else { ?>
                 <li>
                     <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                         <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_ADMIN . '/unresolve_reports') ?>">Unresolved Reports</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_ADMIN . '/resolve_reports') ?>">Resolved Reports</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }
                ?>

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