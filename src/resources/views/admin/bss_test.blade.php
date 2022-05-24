@extends('layouts.app_admin')

@section('content')
    @include('nav_admin.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h3 class="rate-percentage">テストページ</h3>
                @if(!is_null($message))
                    <div class="alert alert-info" role="alert">
                        {{$message}}
                    </div>
                @endif
添削ページ
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

