@extends('layouts.app')

@section('content')
    @include('nav.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h3 class="rate-percentage">テスト再提出ページ</h3>
                @if(!is_null($message))
                    <div class="alert alert-info" role="alert">
                        {{$message}}
                    </div>
                @endif
                <table class="table select-table">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>日付</th>
                        <th>テストタイトル</th>
                        <th>解答</th>
                        <th>ボタン</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tests as $index => $test)
                        <?php $index++; ?>
                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$test->created_at}}</td>
                            <td>{{$test->test_name}}</td>
                            <td>{{$test->answer}}</td>
                            <td>
                                <button>再提出する</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

