 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
     <div id="sidebar-collapse">
         <div class="admin-block d-flex">
             <div>
                 <?php
                    // $apiBaseUrl = "https://jaduridedev.v-xplore.com/";
                    $apiBaseUrl = apiBaseUrl;
                    if (empty($this->session->userdata(session_sarathi_profile_image) || ($this->session->userdata(session_sarathi_profile_image)) == null) || ($this->session->userdata(session_sarathi_profile_image)) == '') { ?>

                     <img src="<?= base_url('assets/images/admin-avatar.png') ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 45px;">

                 <?php
                    } else { ?>
                     <img src="<?= $apiBaseUrl . $this->session->userdata(session_sarathi_profile_image) ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 45px;">


                 <?php
                    }
                    ?>
             </div>
             <div class="admin-info">
                 <div class="font-strong"><?= ucwords($this->session->userdata('sarathi_name')) ?></div>
                 <small>Saathi</small>
             </div>
         </div>
         <?php $uri_last_segment = end($this->uri->segments) ?>

         <?php $display = ($this->session->userdata(session_sarathi_status) == const_deactive)? "none":"" ?>

         <ul class="side-menu metismenu">
             <li>
                 <a href="<?= base_url(WEB_PORTAL_SARATHI . '/dashboard') ?>" id="dashboard_page">
                     <i class="sidebar-item-icon fa fa-th-large"></i>
                     <span class="nav-label">Dashboard</span>
                 </a>
             </li>

             <li class="heading">FEATURES</li>


             <li>
                 <a href="<?= base_url(WEB_PORTAL_SARATHI . '/recharge') ?>" id="recharge_page">
                     <i class="sidebar-item-icon fa fa-building"></i>
                     <span class="nav-label">Recharge History</span>
                 </a>
             </li>


             <li>
                 <a href="<?= base_url(WEB_PORTAL_SARATHI . '/driver') ?>" id="driver_page">
                     <i class="sidebar-item-icon fa fa-life-bouy"></i>
                     <span class="nav-label">Drivers</span>
                 </a>
             </li>

             <li>
                 <a href="<?= base_url(WEB_PORTAL_SARATHI . '/driver/location') ?>" id="driver_location_page">
                     <i class="sidebar-item-icon fa fa-map-marker"></i>
                     <span class="nav-label">Driver Location</span>
                 </a>
             </li>

             <?php
                if ($this->session->userdata(sarathi_session_incentive) == "active" || $this->session->userdata(sarathi_session_incentive) == const_active) { ?>

                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/incentives') ?>" id="incentives_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'incentives') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-rupee"></i>
                         <span class="nav-label">Incentives</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(sarathi_session_call_booking) == "active" || $this->session->userdata(sarathi_session_call_booking) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/call_booking') ?>" id="booking_call" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'call_booking') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-phone"></i>
                         <span class="nav-label">Call Booking</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(sarathi_session_places) == "active" || $this->session->userdata(sarathi_session_places) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/places') ?>" id="places_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'places') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-map-marker"></i>
                         <span class="nav-label">Places</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(sarathi_session_ride_rental) == "active" || $this->session->userdata(sarathi_session_ride_rental) == const_active) { ?>
                 <li>
                     <a href="javascript:;" id="rental_page"><i class="sidebar-item-icon fa fa-car"></i>
                         <span class="nav-label">Rental</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_SARATHI . '/rental/slabs') ?>">Rental Slabs</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_SARATHI . '/rental/features') ?>">Rental Features</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_SARATHI . '/rental/details') ?>">Rental Details</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }

                ?>


             <?php
                if ($this->session->userdata(sarathi_session_fare_list) == "active" || $this->session->userdata(sarathi_session_fare_list) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/fare_management') ?>" id="fare_list_page" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'fare_management') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-file-text-o"></i>
                         <span class="nav-label">Fare Management</span>
                     </a>
                 </li>
             <?php
                }
                ?>


             <?php
                if ($this->session->userdata(sarathi_session_service_ride) == "active" || $this->session->userdata(sarathi_session_service_ride) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/services') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'services') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-gears"></i>
                         <span class="nav-label">Services</span>
                     </a>
                 </li>
             <?php
                }
                ?>

             <?php
                if ($this->session->userdata(sarathi_session_compliments) == "active" || $this->session->userdata(sarathi_session_compliments) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/compliments') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'compliments') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Compliments</span>
                     </a>
                 </li>
             <?php
                }

                ?>


             <?php
                if ($this->session->userdata(sarathi_session_achivements) == "active" || $this->session->userdata(sarathi_session_achivements) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/achivements') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'achivements') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-list"></i>
                         <span class="nav-label">Achivements</span>
                     </a>
                 </li>
             <?php
                }

                ?>

             <?php
                if ($this->session->userdata(sarathi_session_help) == "active" || $this->session->userdata(sarathi_session_help) == const_active) { ?>
                 <li>
                     <a href="<?= base_url(WEB_PORTAL_SARATHI . '/help') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'help') ? 'active' : '' ?>">
                         <i class="sidebar-item-icon fa fa-hand-stop-o"></i>
                         <span class="nav-label">Help</span>
                     </a>
                 </li>
             <?php
                }

                ?>

             <li>
                 <a href="<?= base_url(WEB_PORTAL_SARATHI . '/feedback') ?>" class="<?= (!empty($uri_last_segment) && $uri_last_segment == 'feedback') ? 'active' : '' ?>">
                     <i class="sidebar-item-icon fa fa-star"></i>
                     <span class="nav-label">Feedback</span>
                 </a>
             </li>


             <?php
                if ($this->session->userdata(sarathi_session_reports) == "active" || $this->session->userdata(sarathi_session_reports) == const_active) { ?>
                 <li>
                     <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                         <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_SARATHI . '/resolve_reports') ?>">Resolved Reports</a>
                         </li>
                         <li>
                             <a href="<?= base_url(WEB_PORTAL_SARATHI . '/unresolve_reports') ?>">Unresolved Reports</a>
                         </li>
                     </ul>
                 </li>
             <?php
                }

                ?>





             <!--<li>
                        <a href="km-settings.html">
                            <i class="sidebar-item-icon fa fa-file-text-o"></i>
                            <span class="nav-label">Fare Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="invoice.html">
                            <i class="sidebar-item-icon fa fa-file-text"></i>
                            <span class="nav-label">Invoices</span>
                        </a>
                    </li>
                    <li>
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
                        <a href="reports.html">
                            <i class="sidebar-item-icon fa fa-bug"></i>
                            <span class="nav-label">Reports</span>
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