<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- FontsAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    @stack('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/style.css?v=' . time()) }}" rel="stylesheet">
    <style>
        @-webkit-keyframes moveup {

        0%,
        60%,
        100% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(0);
        }

        25% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(1em);
        }
        }

        @keyframes moveup {

        0%,
        60%,
        100% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(0);
        }

        25% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(1em);
        }
        }

        @-webkit-keyframes movedown {

        0%,
        60%,
        100% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(0);
        }

        25% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(-1em);
        }
        }

        @keyframes movedown {

        0%,
        60%,
        100% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(0);
        }

        25% {
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg) translateZ(-1em);
        }
        }        
        .layer {
            display: block;
            position: absolute;
            height: 3em;
            width: 3em;
            box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.2);
            transform: rotateX(50deg) rotateY(0deg) rotateZ(45deg);
        }

        .layer:nth-of-type(1) {
            background: #005EA2;
            margin-top: 1.5em;
            -webkit-animation: movedown 1.8s cubic-bezier(0.39, 0.575, 0.565, 1) 0.9s infinite normal;
            animation: movedown 1.8s cubic-bezier(0.39, 0.575, 0.565, 1) 0.9s infinite normal;
        }

        .layer:nth-of-type(1):before {
            content: "";
            position: absolute;
            width: 85%;
            background: #003860;
        }

        .layer:nth-of-type(2) {
            background: #5DC0F1;
            margin-top: 0.75em;
        }

        .layer:nth-of-type(3) {
            background: rgba(20, 89, 222, .2);
            -webkit-animation: moveup 1.8s cubic-bezier(0.39, 0.575, 0.565, 1) infinite normal;
            animation: moveup 1.8s cubic-bezier(0.39, 0.575, 0.565, 1) infinite normal;
        }

        /* Stage and link styles */
        .custom_wait_container {
            height: 4.4em;
            width: 37px;
            transform: translate(-50%, -50%);
            margin: 0 auto;
        }

        .custom_wait_link {
            align-self: center;
            justify-self: center;
            color: rgba(255, 255, 255, 0.5);
            font: 400 1em Helvetica Neue, Helvetica, sans-serif;
        }
        .custom_wait_link a {
            color: #292929 !important;
            text-decoration: none;
        }
        #PopUpMessage {
            opacity:0;
            position: fixed;
            visibility:hidden;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            top: 0;
            left: 0;
            text-align: center;
            z-index:99999;
        }
        #PopUpMessage .custom_wait_link {
            position: absolute;
            border-radius: 5px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            font-size: 17px;
        }
        #PopUpMessage .msg-gif{
            display:block;
            text-align:center;
            margin-top:15px;
        }
    </style>
</head>

<body class="dashboardPage">
        <div id="PopUpMessage">
            <div class="custom_wait_link">
                <div class="custom_wait_container">
                    <i class="layer"></i>
                    <i class="layer"></i>
                    <i class="layer"></i>
                </div>
                <a id="loader-msg">Your request is being processed...</a>
            </div>
        </div>
    @include('layouts.sidebar')

    <section class="mainSection">

        @include('layouts.header')
        @yield('content')

    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('js/all.js?v=' . time()) }}"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    
    <script type="text/javascript">
        $(".MenuToggle").click(function() {
            $(this).parent().parent().toggleClass('open');
        });

        function triggerLoader() {
            $('#PopUpMessage').show();
            $('#PopUpMessage').delay(500).css({
                "visibility": "visible",
                "opacity": "1",
                "transition": "all .5s linear"
            });
        }

        function removeLoader() {
            $('#PopUpMessage').hide();
        }

        initializeDatePicker();

        function initializeDatePicker(){
            $(".datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                onClose: function () {
                    $(this).valid();
                }
            });
        }
        $('body').click(function(evt){
            initializeDatePicker();
        });
    </script>
    @stack('js')
</body>

</html>
