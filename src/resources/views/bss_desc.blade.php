@extends('layouts.app')

@section('content')
    @include('nav.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(!is_null($message))
                    <div class="alert alert-info" role="alert">
                        {{$message}}
                    </div>
                @endif
                <button type="button" class="btn btn-primary btn-sm sort_no" >未記入のみ表示</button>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">status</th>
                        <th scope="col"></th>
                        <th scope="col">種類</th>
                        <th scope="col">タイトル</th>
                        <th scope="col">解釈</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($BSS_data as $index => $BSS)
                        <?php $index++; ?>
                        <tr>
                            <th scope="row">
                                @if($BSS->OK_flag == 1)
                                    <span class="badge rounded-pill bg-primary">OK</span>
                                @elseif($BSS->NG_flag == 1)
                                    <span class="badge rounded-pill bg-warning text-dark">再</span>
                                @endif

                            </th>
                            <td><button class="btn btn-danger btn-sm add_desc" value="{{$BSS->id}}">記入</button></td>
                            <td>{{$BSS->name}}</td>
                            <td>{{$BSS->title}}</td>
                            <td>{{$BSS->description}}</td>
                        </tr>
                    @endforeach
                    <input type="hidden" value="{{\Auth::id()}}" id="user_id">
                    </tbody>
                </table>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

