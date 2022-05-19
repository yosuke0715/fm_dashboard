@extends('layouts.app')

@section('content')
    @include('nav.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <form action="{{url('/bss-add-desc')}}" method="POST">
                    @csrf
                    <p>{{$BSS->title}}</p>
                    <div class="form-floating">
                        <textarea class="form-control" id="floatingTextarea" name="description">@if(!is_null($desc)){{$desc->description}}@endif</textarea>
                        <label for="floatingTextarea">解釈を記入</label>
                    </div>
                    <input type="hidden" name="BSS_id" value="{{$BSS->id}}">
                    <input type="hidden" name="name" value="{{$BSS->title}}">
                    <input type="hidden" name="is_exists" value="{{$is_exists}}">
                    <button type="submit" class="btn btn-primary mt-3">編集する</button>
                </form>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

