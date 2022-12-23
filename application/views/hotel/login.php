<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Login</title>
    <link href="<?= base_url() ?>./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <?php $panel = end($this->uri->segments); ?>
    <div class="content">
        <div class="brand">
            <a class="link" href="">Jadu Ride <?= ucwords($panel) ?></a>
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
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <span class="input-span"></span>Remember me</label>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
            <span id="message" class="text-warning"></span>

            <div class="form-group text-center">
                <span>Don't have an account ! <a href="<?= base_url('hotel/register') ?>">Register</a></span>
            </div>
        </form>


    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?= base_url() ?>./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
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


            $.ajax({
                url: "<?= base_url("Hotel/authenticate_hotel") ?>",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                error: function(a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        location.href = data.redirect_to;
                    } else {
                        toast(data.message);
                    }
                }
            });

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
    </script>
    <!-- Login Section Script End -->