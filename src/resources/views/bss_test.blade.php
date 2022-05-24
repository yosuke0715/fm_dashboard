@extends('layouts.app')

@section('content')
    @include('nav.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h3 class="rate-percentage">テストページ</h3>
                @if(!is_null($message))
                    <div class="alert alert-info" role="alert">
                        {{$message}}
                    </div>
                @endif
                @if($is_answered == 1)
                <form action="{{url('/bss-answer')}}" method="POST">
                    @csrf
                    <p>カテゴリー：{{$question->name}}</p>
                    <p>テストタイトル：{{$question->title}}</p>
                    <div class="form-floating">
                        <textarea class="form-control" id="floatingTextarea" name="answer"></textarea>
                        <label for="floatingTextarea">解答を記入</label>
                    </div>
                    <input type="hidden" name="title" value="{{$question->title}}">
                    <button type="submit" class="btn btn-danger mt-3">解答する</button>
                </form>
                @elseif($is_answered == 0)
                    <div class="alert alert-info" role="alert">
                        本日は回答済です
                    </div>
                @endif
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

