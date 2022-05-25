@extends('layouts.app_admin')

@section('content')
    @include('nav_admin.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="d-flex">
                    <h3 class="rate-percentage">テストページ</h3>
                    <div class="bulk_btn mx-5">
                        <button class="btn btn-primary btn-sm">一括OKする</button>
                    </div>
                </div>
                @if(!is_null($message))
                    <div class="alert alert-info" role="alert">
                        {{$message}}
                    </div>
                @endif
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">一括OK</th>
                        <th scope="col">評価</th>
                        <th scope="col">名前</th>
                        <th scope="col">タイトル</th>
                        <th scope="col">解答</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $test)
                    <tr>
                        <td>
                            <input type="checkbox" name="bulk_btn">
                        </td>
                        <td>
                            <div class="d-flex">
                                <div class="ok_btn mx-1">
                                    <button value="{{$test->id}}" class="btn btn-primary btn-sm test-ok">OK</button>
                                </div>
                                <div class="ng_btn">
                                    <button value="{{$test->id}}"  class="btn btn-danger btn-sm test-ng">NG</button>
                                </div>
                            </div>
                        </td>
                        <td>{{$test->name}}</td>
                        <td>{{$test->test_name}}</td>
                        <td>{{$test->answer}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

