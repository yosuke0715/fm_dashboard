@extends('layouts.app_admin')

@section('content')
    @include('nav_admin.top_navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row mb-2">
                    <div class="col-2">
                        <select class="form-select form-select-sm" aria-label="form-select-sm Default select example">

                            <option selected>並び替え</option>
                            <option value="1">種類別</option>
                            <option value="2">Level順</option>
                            <option value="3">No順</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select form-select-sm" onChange="location.href=value;" aria-label="form-select-sm Default select example">

                            <option selected>絞り込み</option>
                            @if(!is_null($categories))
                            @foreach($categories as $category)
                                <option value="{{'/admin/bss-search/'.$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">種類</th>
                                <th scope="col">Level</th>
                                <th scope="col">名前</th>
                                <th scope="col">編集</th>
                                <th scope="col">削除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_null($BSS_data))
                            @foreach($BSS_data as $index => $BSS)
                                <?php $index++; ?>
                            <tr>
                                <th scope="row">{{$index}}</th>
                                <td>{{$BSS->name}}</td>
                                <td>{{$BSS->level}}</td>
                                <td>{{$BSS->title}}</td>
                                <td>
                                    <button class="BSS_edit_btn btn btn-success btn-sm" value="{{$BSS->id}}">編集</button>
                                </td>
                                <td>
                                    <button class="BSS_del_btn btn btn-danger btn-sm" value="{{$BSS->id}}">削除</button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection
