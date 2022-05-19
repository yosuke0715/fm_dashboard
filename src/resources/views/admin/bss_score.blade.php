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
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">解答</th>
                                    <th scope="col"></th>
                                    <th scope="col">タイトル</th>
                                    <th scope="col">解釈</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scores as $index => $score)
                                    <?php $index++; ?>
                                    <tr>
                                        <td><button class="btn btn-primary btn-sm add_desc add_OK_flag" value="{{$score->id}}">OK</button></td>
                                        <td><button class="btn btn-danger btn-sm add_desc add_NG_flag" value="{{$score->id}}">NG</button></td>
                                        <td>{{$score->name}}</td>
                                        <td>{{$score->description}}</td>
                                    </tr>
                                @endforeach
                                <input type="hidden" value="{{\Auth::id()}}" id="user_id">
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection
