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
                        <form action="{{url('/admin/bss-update')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">BSSタイトル</label>
                                <input name="title" type="text" class="form-control" id="exampleInputEmail1" value="{{$BSS->title}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">種類</label>
                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    <option selected>種類を選択</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $BSS->category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="margin-right: 20px">レベル感</label>1:大事すぎる　2:できてほしい　3:できればできてほしい　4:余裕があれば
                                <input name="level" type="text" class="form-control" id="exampleInputPassword1" value="{{$BSS->level}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">備考</label>
                                <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$BSS->note}}</textarea>
                            </div>
                            <input type="hidden" value="{{$BSS->id}}" name="id">
                            <input type="submit" class="btn btn-success" value="編集する">
                        </form>

                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection
