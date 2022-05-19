@extends('layouts.app_admin')

@section('content')
    @include('nav_admin.top_navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        @if(!is_null($message))
                        <div class="alert alert-info" role="alert">
                            {{$message}}
                        </div>
                        @endif
                        <form action="{{url('/admin/add-category')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">カテゴリーを追加する</label>
                                <input name="category" type="text" class="form-control" id="exampleInputEmail1">
                            </div>
                            <button type="submit" class="btn btn-primary">追加する</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection
