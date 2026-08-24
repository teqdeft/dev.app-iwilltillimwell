<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.dashboard.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet" />
    <script type="text/javascript">
    const SITE_URL = "{{URL::to('/')}}";
    const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
    const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";
        </script><link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}"><link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/menu.css') }}"><link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">
</head>

<body>
    <header>
        @include('includes.dashboard.header')
    </header>
    <div class="container-fluid page-body-wrapper med-con-v1">
        @include('includes.dashboard.admin.sidebar') 
        @yield('content')

        @include('includes.dashboard.footer')

        @include('includes.dashboard.scripts')
        <script>
            $(document).ready(function() {
                /* storage permissions */
                var getAllPermission = '{{ get_permissions() }}';
                localStorage.setItem("user-type", '<?= get_user_type() ?>');
                if (getAllPermission != '') {
                    localStorage.setItem("users-permissions", '<?= get_permissions() ?>');
                }
            });
        </script>
</body>

</html>