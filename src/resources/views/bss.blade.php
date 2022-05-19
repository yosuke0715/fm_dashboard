@extends('layouts.app')

@section('content')
    @include('nav.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">

        @include('nav.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row mb-2">
                    <div class="col-2">
                        <select class="form-select form-select-sm" onChange="location.href=value;" aria-label="form-select-sm Default select example">

                            <option selected>並び替え</option>
                            <option value="/bss-sort/sort/1">種類別</option>
                            <option value="/bss-sort/sort/2">Level順</option>
                            <option value="/bss-sort/sort/3">No順</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select form-select-sm" onChange="location.href=value;" aria-label="form-select-sm Default select example">

                            <option selected>絞り込み</option>
                            <option value="/bss-sort/search/1">〇のみ</option>
                            <option value="/bss-sort/search/2">△のみ</option>
                            <option value="/bss-sort/search/3">未達成のみ</option>
                        </select>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">種類</th>
                        <th scope="col">レベル</th>
                        <th scope="col">達成</th>
                        <th scope="col">項目</th>
                        <th scope="col">備考</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($BSS_data as $index => $BSS)
                        <?php $index++; ?>
                    <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$BSS->name}}</td>
                        <td>{{$BSS->level}}</td>
                        <td>
                            <select name="achievement" class="achievement">
                                @if($BSS->achievement == "0" || $BSS->achievement == null)
                                    <option value="{{$BSS->id}}/0" selected>未達成</option>
                                    <option value="{{$BSS->id}}/1">わかる</option>
                                    <option value="{{$BSS->id}}/2">説明できる</option>
                                @elseif($BSS->achievement == "1")
                                    <option value="{{$BSS->id}}/0">未達成</option>
                                    <option value="{{$BSS->id}}/1" selected>わかる</option>
                                    <option value="{{$BSS->id}}/2">説明できる</option>
                                @elseif($BSS->achievement == "2")
                                    <option value="{{$BSS->id}}/0">未達成</option>
                                    <option value="{{$BSS->id}}/1">わかる</option>
                                    <option value="{{$BSS->id}}/2" selected>説明できる</option>
                                @endif
                            </select>
                        </td>
                        <td>{{$BSS->title}}</td>
                        <td>{{$BSS->note}}</td>
                    </tr>
                    @endforeach
                    <input type="hidden" value="{{\Auth::id()}}" id="user_id">
                    </tbody>
                </table>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

