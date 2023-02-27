<script>
        $(document).ready(function() {
            get_driver_details();
            $('#add_new').hide();

        });

        function edit_driver(id, name, email, mobile) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_number').val(mobile);
        }

        function get_driver_details() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_driver') ?>",
                beforeSend: function() {
                    $('#table_details').html('<tr><td class="text-center" colspan="8">Loading...</td></tr>');
                },
                success: function(response) {
                    if (response.success) {
                        // console.log(response);
                        let driver = response.data;
                        let str = '';
                        let count = 1;
                        let user_status = "";

                        for (let i = 0; i < driver.length; i++) {
                            if (driver[i].name == null || driver[i].name == '') driver[i].name = "";
                            if (driver[i].email == null || driver[i].email == '') driver[i].email = "";
                            if (driver[i].sarathi.name == null || driver[i].sarathi.name == '') driver[i].sarathi.name = "_____";

                            if (driver[i].status == "active" || driver[i].status == "ACTIVE")
                                driver_status = "checked";
                            else
                                driver_status = "";
                            str += `<tr>
                                <td>${count}</td>
                                <td class="title nowrap">
                                <a href="<?= base_url('administrator/driver/details/') ?>${driver[i].user_id}">${driver[i].name}</a></td>
                                <td>${driver[i].email}</td>
                                <td>${driver[i].mobile}</td>
                                <td class="title">
                                <div class="nowrap">
                                    ${driver[i].vehicle_type}
                                    ${driver[i].vehicle_name}
                                </div>
                                <strong>${driver[i].vehicle_number}</strong>
                                </td> 
                                <td class="title nowrap">${driver[i].sarathi.name}</td> 
                                <td><label class="switch">
                                <input type="checkbox"  ${driver_status} onclick="status(this,'${driver[i].user_id}')" class="access_status_change" disabled>
                                <span class="slider round"></span></label>
                                </td>
                                <td>
                                <div>

                                <button class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Export as PDF" onclick="download_ride_history('${driver[i].user_id}')">            
                                <img src="<?= base_url('assets/images/pdf.png') ?>" alt="" width="20px" class="mb-3">         
                                </button>

                                <button class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Export as CSV" onclick="download_ride_history_csv('${driver[i].user_id}')">            
                                <img src="<?= base_url('assets/images/xls.png') ?>" alt="" width="20px" class="mb-3">         
                                </button>

                                </div>
                                </td>
                                <td class="nowrap">
                                <div style="width:170px">

                                <button target="_blank" class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Download QR Code" onclick="download_qrCode('${driver[i].driver_id}')">            
                                <img src="<?= base_url('assets/images/qr_code.png') ?>" alt="" width="15px" class="mb-3">         
                                </button>

                                                                
                                <button class="hdrbtn mx-2 view_user" data-toggle="modal" id=" viewbtn"  data-target="#bnkView1"  onclick="view_bank_details('${driver[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Bank details">                        
                                <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-3">                  
                                </button>


                                <button class="hdrbtn mx-2 editUser access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit_driver('${driver[i].user_id}' , '${driver[i].name}' , '${driver[i].email}' , '${driver[i].mobile}')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </button>

                                <button class="hdrbtn mx-2" data-toggle="tooltip" data-placement="top" title="View Document" onclick="view_driver_document('${driver[i].user_id}')">
                                    <img src="<?= base_url('assets/images/view_document.png') ?>" alt="" width="20px" class="mb-3">     
                                </button> 

                                <button class="hdrbtn mx-2 delete_driver access_delete" data-toggle="modal" data="${driver[i].user_id}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                                <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                            <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                        </svg>
                                </button> 
                                </div>
                                </td></tr>`;
                            count++;
                        }
                        $('#table_details').html(str);
                        $('#table').dataTable();
                        get_panel_access_list();

                    } else {
                        console.log(response);
                        $('#table').dataTable();
                    }

                },
                error: function(response) {
                    console.log(response);
                }
            });
        }


        function download_qrCode(driver_id) {
            location.href = `<?= apiBaseUrl ?>qr?driverId=${driver_id}`;
            window.open(url, '_blank');

        }

        function download_ride_history(user_id) {
            var url = `<?= base_url('administrator/driver/ride_history/') ?>${user_id}`;
            window.open(url, '_blank');
        }

        function download_ride_history_csv(user_id) {
            var url = `<?= base_url('administrator/driver/ride_history_csv/') ?>${user_id}`;
            window.open(url, '_blank');
        }

        function view_driver_document(user_id) {
            location.href = `<?= base_url('administrator/driver/document/') ?>${user_id}`;
        }

        function status(state, user_id) {
            if (state.checked == true) {
                $.ajax({
                    url: "<?= base_url('administrator/active_driver') ?>",
                    type: "post",
                    data: {
                        "id": user_id
                    },
                    success: function(data) {
                        if (data.success) {
                            state.removeAttribute("checked");
                            toast(data.message, "center");
                        } else {
                            toast(data.message, "center");
                        }

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url('administrator/deactive_driver') ?>",
                    type: "post",
                    data: {
                        "id": user_id
                    },
                    error: function(data) {
                        alert(JSON.stringify(data));
                    },
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                        } else {
                            toast(data.message, "center");
                        }
                    }
                });
            }
        }
        ///////////////// update /////////////////////

        $('#btn_update_data').on('click', function() {
            let id = $('#edit_id').val();
            let name = $('#edit_name').val();
            let email = $('#edit_email').val();
            let mobile = $('#edit_number').val();
            let flag = 0;


            if (email.indexOf('@') > -1) {
                flag = 0;
            } else {
                flag = 1;
                toast("Enter a valid email id", "center");
            }

            let user_type = '<?= $this->session->userdata(field_user_type) ?>';

            if (flag == 0) {
                $.ajax({
                    url: "<?= base_url('administrator/update_driver') ?>",
                    type: "post",
                    data: {
                        "id": id,
                        "name": name,
                        "email": email,
                        "mobile": mobile,
                        'user_type': user_type
                    },
                    async: false,
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                            $('#update_form')[0].reset();
                            $('#close_edit_modal').click();
                            get_driver_details();
                        } else {
                            toast(data.message, "center");
                        }
                    },
                    error: function(data) {
                        // console.log(data);
                    },
                });
            } else {
                // toast("Fill all details");
            }
        });

        // add new user
        $('#btn_add_data').on('click', function() {
            let name = $('#add_name').val();
            let email = $('#add_email').val();
            let mobile = $('#add_mobile').val();
            let flag = 0;
            if (name.length < 3) {
                flag = 1;
                toast("Name should contain atleast three letters", "center");
            }
            if (mobile.length != 10) {
                flag = 1;
                toast("Mobile number must contain 10 digit", "center");
            }
            if (email == '') {
                flag = 1;
                toast("Email id is required", "center");
            }
            if (flag == 0) {
                $.ajax({
                    url: "<?= base_url('administrator/add_driver') ?>",
                    type: "post",
                    data: {
                        "name": name,
                        "email": email,
                        "mobile": mobile,
                    },
                    async: false,
                    success: function(data) {
                        toast("Data added successfully", "center");
                        $('#add_data_form')[0].reset();
                        $('#close_add_modal').click();
                        get_driver_details();
                    },
                    error: function(data) {
                        console.log(JSON.stringify(data));
                    },
                });
            }
        });
        //delete
        $('#table_details').on('click', '.delete_driver', function() {
            let id = $(this).attr('data');
            $('#btn_delete_data').click(function() {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('Admin/delete_driver') ?>",
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                            $('#close_delete_modal').click()
                            get_driver_details();
                        } else {
                            toast(data.message, "center");
                        }
                    },
                    error: function() {
                        console.log(data);
                    }
                });
            });
        });

        function view_bank_details(user_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/display_bank_details') ?>",
                data: {
                    "id": user_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        let data = response.data[0];

                        $('.bank-modal-title').html("Banking Details of " + data.account_holder_name);

                        $('#acc_name').val(data.account_holder_name);
                        $('#acc_number').val(data.account_number);
                        $('#ifsc').val(data.ifsc);
                        $('#bank_name').val(data.bank_name);
                        $('#branch_name').val(data.branch_name);

                    } else {
                        $('.bank-modal-title').html("Banking Details Not Found");
                        $('#acc_name').val('');
                        $('#acc_number').val('');
                        $('#ifsc').val('');
                        $('#bank_name').val('');
                        $('#branch_name').val('');
                    }
                }
            });
        }


        function get_panel_access_list() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/get_panel_access_list') ?>",
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    let permission = response.data.permission;
                    let data = permission.split(",");
                    $.each(data, function(i) {

                        $('.' + data[i]).removeAttr('disabled');
                        // console.log(data[i]);
                    });
                }
            });
        }

        $('#table').on('page.dt', function() {
            get_panel_access_list();
        });

        $('#table').on('order.dt', function() {
            get_panel_access_list();
        });

        $('#table').on('search.dt', function() {
            get_panel_access_list();
        });
    </script>