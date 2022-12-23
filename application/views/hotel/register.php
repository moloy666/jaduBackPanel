<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- <title>Jadu | Login</title> -->
    <link href="<?= base_url() ?>./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= base_url() ?>./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>


<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="">Jadu Ride Hotel</a>
        </div>

        <form id="register_form">
            <h2 class="login-title text-center m-3">Register</h2>

            <div class="form-group">
                <input class="form-control" type="text" id="name" name="name" placeholder="Enter Hotel Name" >
            </div>

            <div class="form-group">
                <input class="form-control" type="email" id="email" name="email" placeholder="Enter Email" >
            </div>

            <div class="form-group">
                <input class="form-control" type="number" id="mobile" name="mobile" placeholder="Mobile Number">
            </div>

            <div class="form-group">
                <input class="form-control" type="number" id="pincode" name="pincode" placeholder=" Enter Pincode">
            </div>

            <div class="form-group">
                <input class="form-control" id="location"  placeholder="Area / Location / City" name="location">
            </div>

            <div class="form-group">
                <input class="form-control" id="district" placeholder="District Name" name="district">
            </div>

            <div class="form-group">
                <input class="form-control" id="state" placeholder="State Name" name="state">
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit" id="btn_register">Register</button>
            </div>

            <div class="form-group text-center">
                <span>Already have an account ! <a href="<?= base_url('hotel') ?>">Login</a></span>
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
    <script src="<?= base_url() ?>./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?= base_url() ?>./assets/js/app.js" type="text/javascript"></script>
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
    <!-- <script>
        $(document).ready(() => {
            fillup_user_credentails();
        });
    </script> -->
    <!-- Common Script End -->
    <!-- Login Section Script Start -->
    <!-- <script>
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
                    // console.log(data);
                    if (data.success) {
                        location.href = data.redirect_to;
                    } else {
                        console.log(data.message);
                        $('#message').html(data.message);
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
    </script> -->
    <!-- Login Section Script End -->