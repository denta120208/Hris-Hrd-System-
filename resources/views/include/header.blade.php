<!-- Meta tags -->
<meta name="description" content="Human Resource System PT. Metropolitan Land Tbk.">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/meanmenu/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/jvectormap/jquery-jvectormap-2.0.3.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/notika-custom-icon.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/wave/waves.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/wysiwyg/wysiwyg.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/wysiwyg/highlight.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/responsive.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('css/datetimepicker/jquery.datetimepicker.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<link rel="stylesheet" href="{{ URL::asset('css/jquery/jquery-ui.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JavaScript -->
<script src="{{ URL::asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<script src="{{ URL::asset('js/jquery.sumtr.js') }}"></script>

<style>
    .select2 {
        width: 100% !important;
    }
    .select2-selection {
        height: 34px !important;
    }
    .select2-selection__arrow {
        height: 100% !important;
    }
    .select2-selection__rendered {
        height: 100% !important;
        line-height: 34px !important;
        padding-left: 17px !important;
    }
    .footer {
        position: fixed;
        left: 0;
        bottom: -20px;
        width: 100%;
        color: white;
        text-align: center;
    }
</style>

<script>
    $(document).ready(function() {
        $('.select2').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
            });
        });
    });
</script>

<!-- Start Header Top Area -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="#"><img src="{{ URL::asset('images/logo.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <span><i class="notika-icon notika-calendar"></i></span>
                                <div class="spinner4 spinner-4"></div>
                                <div class="ntd-ctn"><span id="leave-count">0</span></div>
                            </a>
                            <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>Leave</h2>
                                </div>
                                <div class="hd-message-info" id="detail_leave"></div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('changePassword') }}" role="button" aria-expanded="false" class="nav-link"><span><i class="fa fa-key" title="Change Password"></i></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('auth.logout')}}"><span><i class="fa fa-sign-out" title="Keluar"></i></span></a>
                        </li>
                        <li><a href="{{ url('hrd/rAttendanceEmpDW') }}">Attendance Emp DW</a></li>
                        <li><a href="{{ url('hrd/rJoinTerminate') }}">Join & Terminate</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>