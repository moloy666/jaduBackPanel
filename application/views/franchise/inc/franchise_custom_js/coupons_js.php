  <script>
      get_coupon_details();

      function edit(id, type, for_user, value, expired_at) {
          let user = for_user.replace(' ', '_');

          $('#edit_id').val(id);
          $('#edit_coupon_type').val(type);
          $('#edit_for_user').val(user);
          $('#edit_value').val(value);
          $('#edit_expired_at').val(expired_at);
      }


      function get_coupon_details() {
          $.ajax({
              type: "post",
              url: "<?= base_url(WEB_PORTAL_ADMIN . '/get_coupon_details') ?>",
              success: function(response) {
                  let data = response.data;
                  let details = '';
                  let status = "";
                  $.each(data, function(i, data) {
                      if (data.validity == "active" || data.validity == "ACTIVE")
                          status = "checked";
                      else
                          status = "";
                      details += `<tr>
                                <td>${i+1}</td>
                                <td class="uppercase">${data.code}
                                <span class="badge rounded-pill bg-warning ml-3">${data.count}</span>
                                </td>
                                <td class="title">${data.for_user}</td>
                                <td>${data.type}</td>
                                <td>${data.value}</td>
                                <td><label class="switch">
                                <input type="checkbox" ${status} onclick="status(this,'${data.uid}')" class="access_status_change" disabled>
                                <span class="slider round"></span></label>
                                </td>
                                <td>${data.expired_at}</td>

                                <td>
                                <div>
                   
                                <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('${data.uid}', '${data.type}', '${data.for_user}', '${data.value}', '${data.expired_at}' )" disabled>

                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </button>

                                <button class="hdrbtn mx-2 delete access_delete" data-toggle="modal" data="${data.uid}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                                <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                            <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                        </svg>
                                </button> 
                                </div>
                                </td>
                                </tr>`;
                  });
                  $('#table_details').html(details);
                  $('#table').dataTable();
                  get_panel_access_list();
              },
              error: function(data) {
                  console.log(data);
              }
          });
      }

      $('#btn_add_data').on('click', function() {
          let coupon_type = $('#coupon_type').val();
          let value = $('#value').val();
          let user_type = $('#for_user').val();
          let expired_at = $('#expired_at').val();

          console.log(user_type);

          $.ajax({
              url: "<?= base_url(WEB_PORTAL_ADMIN . '/add_coupon_data') ?>",
              type: "post",
              data: {
                  "coupon_type": coupon_type,
                  "value": value,
                  "user_type": user_type,
                  "expired_at": expired_at,
              },
              success: function(data) {
                  console.log(data);
                  if (data.success) {
                      toast(data.message, "center");
                      $('#addNewUsr1').modal('hide');
                      get_coupon_details();
                      $('#add_data_form')[0].reset();
                  } else {
                      toast(data.message, "center");
                  }
              },
              error: function(data) {
                  console.log(data);
              },
          });

      });

      function status(state, uid) {
          let specific_id = $('#specific_id').val();
          if (state.checked == true) {
              $.ajax({
                  url: "<?= base_url(WEB_PORTAL_ADMIN . '/active_coupon') ?>",
                  type: "post",
                  data: {
                      "id": uid,
                      "specific_id": specific_id
                  },
                  success: function(data) {
                      state.removeAttribute("checked");
                      toast(data.message, "center");
                  },
                  error: function(data) {
                      alert(JSON.stringify(data));
                  }
              });
          } else {
              $.ajax({
                  url: "<?= base_url(WEB_PORTAL_ADMIN . '/deactive_coupon') ?>",
                  type: "post",
                  data: {
                      "id": uid,
                      "specific_id": specific_id
                  },
                  error: function(data) {
                      alert(JSON.stringify(data));
                  },
                  success: function(data) {
                      toast(data.message, "center");
                  }
              });
          }
      }

      $('#btn_update_data').on('click', function() {
          let id = $('#edit_id').val();
          let coupon_type = $('#edit_coupon_type').val();
          let for_user = $('#edit_for_user').val();
          let value = $('#edit_value').val();
          let expired_at = $('#edit_expired_at').val();
          let specific_id = $('specific_id').val();


          $.ajax({
              url: "<?= base_url(WEB_PORTAL_ADMIN . '/update_coupon_details') ?>",
              type: "post",
              data: {
                  "id": id,
                  "type": coupon_type,
                  "for_user": for_user,
                  "value": value,
                  "expired_at": expired_at,
                  "specific_id": specific_id,
              },
              success: function(data) {
                  if (data.success) {
                      toast(data.message, "center");
                      $('#update_form')[0].reset();
                      $('#close_edit_modal').click();
                      get_coupon_details();
                  } else {
                      toast(data.message, "center");
                  }

              },
              error: function(data) {
                  // console.log(data);
              },
          });
      });



      $('#table_details').on('click', '.delete', function() {
          let id = $(this).attr('data');
          $('#btn_delete_data').click(function() {
              $.ajax({
                  type: "post",
                  url: "<?= base_url('administrator/delete_coupons') ?>",
                  data: {
                      "id": id
                  },
                  async: false,
                  success: function(data) {
                      toast(data.message, "center");
                      get_coupon_details();
                      $('#close_delete_modal').click();
                  },
                  error: function() {
                      // console.log(data);
                  }
              });
          });
      });

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

                      $('.' + data[i]).removeAttr('disabled', 'disabled');
                      // console.log(data[i]);
                  });
              }
          });
      }
  </script>