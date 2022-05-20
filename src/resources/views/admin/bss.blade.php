@extends('layouts.app')

@section('content')
    @include('nav_admin.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('nav_admin.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper" style="overflow-x: scroll">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">種類</th>
                        <th scope="col">レベル</th>
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

