<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>
<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="">Jadu Ride Admin</a>
        </div>
        <form id="login_form">
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon">
                        <!-- <i class="fa fa-lock font-16" id="btn_password"></i> -->
                        <img src="<?=base_url('assets/images/show.png')?>" width="18px" id="show_password">
                        <img src="<?=base_url('assets/images/hide.png')?>" width="18px" id="hide_password" style="display:none">
                    </div>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <select class="form-control bgdarkred btnround" style="min-width: 150px" name="user_type" id="user_type" required="required">
                    <option value="0">Select User</option>
                    <option value="1">Administrator</option>
                    <option value="2">Admin</option>
                </select>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <span class="input-span"></span>Remember me</label>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit" id="btn_login">Login</button>
            </div>
            <span id="message" class="text-warning"></span>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login_form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
    <!-- Common Script Start -->
    <script>
        $(document).ready(() => {
            fillup_user_credentails();
        });
    </script>
    <!-- Common Script End -->
    <!-- Login Section Script Start -->
    <script>
        $("#login_form").on("submit", function(e) {
            e.preventDefault();
            let form = document.getElementById("login_form");
            let formData = new FormData(form);
            remember_if_needed(formData);
            let user_type = $('#user_type').val();
            if (user_type == 0) {
                toast("Select User Type First", "right");
            } else {
                $.ajax({
                    url: "<?= base_url("Admin/authenticate_user") ?>",
                    type: "post",
                    beforeSend:function(){
                        $('#btn_login').html(`<img src="<?=base_url('assets/images/loader3.svg')?>" width="30px">`);
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    complete:function(){
                        $('#btn_login').html(`Login`);
                    },
                    error: function(a, b, c) {
                        console.log(a);
                        console.log(b);
                        console.log(c);
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.success) {
                            location.href = data.redirect_to;
                        } else {
                            console.log(data.message);
                            $('#message').html(data.message);
                        }
                    }
                });
            }
        });
        function remember_if_needed(formData) {
            var formDataObject = {};
            formData.forEach((value, key) => {
                formDataObject[key] = value;
            });
            if (formDataObject.hasOwnProperty("remember_me")) {
                remember_user_credentials(formDataObject);
            }
        }
        function remember_user_credentials(credentials) {
            localStorage.setItem("email", credentials.email);
            localStorage.setItem("password", credentials.password);
        }
        function fillup_user_credentails() {
            if (localStorage.getItem("email") && localStorage.getItem("password")) {
                $("#login_form input[name='email']").val(localStorage.getItem("email"));
                $("#login_form input[name='password']").val(localStorage.getItem("password"));
            }
        }

        $('#show_password').click(function(){
            let password = document.getElementById('password');
            if(password.type === "password"){
                password.type = "text";
                $('#show_password').hide();
                $('#hide_password').show();
            }
        });

        $('#hide_password').click(function(){
            let password = document.getElementById('password');
            if(password.type === "text"){
                password.type = "password";
                $('#hide_password').hide();
                $('#show_password').show();
            }
        });

       
    </script>
    <!-- Login Section Script End -->