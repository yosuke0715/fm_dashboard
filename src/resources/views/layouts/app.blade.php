<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BSS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <!-- End plugin css for this page -->
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <!-- partial:partials/_navbar.html -->

            @yield('content')
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. エフアンドエムネット All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>

