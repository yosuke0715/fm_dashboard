@extends('layouts.app')

@section('content')
    @include('nav_admin.top_navbar')
    <<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">タイトル</th>
                        @foreach($BSS_array[0]['user_name'] as $key => $user)
                            <td>{{$key}}</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($BSS_array as $index => $BSS)
                        <tr>
                            <th scope="row">{{$index}}</th>
                            <td>{{$BSS['title']}}</td>
                            @foreach($BSS['user_name'] as $key => $achieve)
                            <td>
                            @if($achieve == 0)
                                    <i class="far fa-times"></i>
                                @elseif($achieve == 1)
                                    <i class="fas fa-exclamation-triangle"></i>
                                @else
                                    <i class="far fa-circle"></i>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                    <input type="hidden" value="{{\Auth::id()}}" id="user_id">
                    </tbody>
                </table>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection

