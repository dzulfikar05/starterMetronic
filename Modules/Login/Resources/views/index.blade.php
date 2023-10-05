<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title>Metronic Starter</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="template/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="template/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="template/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="template/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <!-- DataTables -->
    <link href="plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Sweet Alert-->
    <link href="plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    {{-- select2 --}}
    <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <script src="plugins/jquery/jquery.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <!--begin::Main-->
    <section class="vh-100">

        <div class="">
            <div class="row">
                <div class="col-sm-7 d-flex justify-content-center align-items-center ">

                    <div class="m-sm-4 mt-5 mt-md-0">

                        {{-- <img class="col-12" src="assets/logo/logo_loker.png" alt="logo"> --}}
                        <span class="fs-1 fw-bolder text-primary"><span class="text-dark ">App</span> Starter</span>
                        <form action="javascript:onLogin(this)" method="post" id="form_login" name="form_login"
                            autocomplete="off" class="mt-5">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control form-control-lg" type="email" name="user_email"
                                    placeholder="Enter your email" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <span id="toggle_password" class="d-flex justify-content-end">
                                    <i id="iconPassword" class="fa fa-eye-slash"></i>
                                </span>
                                <input class="form-control form-control-lg" type="password" id="password"
                                    name="password" placeholder="Enter your password" />
                            </div>
                            <span class="text-muted">don't have any account ? <a href="/register">Register</a></span>
                            {{-- <div class="mb-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Recipient's username"
                                            aria-describedby="basic-addon2 " />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-eye-slash "></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <button type="submit" class="btn btn-lg btn-primary col-12 mt-3">Log In</button>
                        </form>
                    </div>

                </div>
                <div class="col-sm-5 px-0 d-none d-sm-block">
                    <img src="assets/logo/tech.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover;">
                </div>
            </div>
        </div>
        <style>
            #toggle_password {
                /* position: absolute; */
                position: relative;
                bottom: -30px;
                left: -12px;
                /* right: 10px top: -200px; */
            }
        </style>
    </section>
    @include('login::javascript')
    <!--end::Main-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="template/assets/plugins/global/plugins.bundle.js"></script>
    <script src="template/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="template/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="template/assets/js/custom/widgets.js"></script>
    <script src="template/assets/js/custom/apps/chat/chat.js"></script>
    <script src="template/assets/js/custom/modals/create-app.js"></script>
    <script src="template/assets/js/custom/modals/upgrade-plan.js"></script>

    <!-- Sweet Alerts js -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    {{-- <script src="assets/js/pages/sweet-alerts.init.js"></script> --}}

    {{-- block ui --}}
    <script src="plugins/blockui-master/jquery.blockUI.js"></script>
    {{-- select2 --}}
    <script src="plugins/select2/select2.min.js"></script>

    <script src="assets/helpers/helper.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
