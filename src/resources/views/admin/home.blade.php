@extends('layouts.app_admin')

@section('content')
    @include('nav_admin.top_navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('nav_admin.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="btn-wrapper d-flex" style="justify-content: end">
                    <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                    <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-tab">
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                    <h3 class="rate-percentage">個人の進捗</h3>
                                @foreach($users as $user)
                                    <h4>{{$user['user_name']}}</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="statistics-details d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="statistics-title">進捗合計</p>
                                                    <h3 class="rate-percentage">{{$user['total_progress']}} <span style="font-size: 12px;">%</span></h3>
                                                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                                                </div>
                                                <div>
                                                    <p class="statistics-title">合計〇数</p>
                                                    <h3 class="rate-percentage">{{$user['OK_count']}} <span style="font-size: 12px;">個</span></h3>
                                                    <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                                                </div>
                                                <div>
                                                    <p class="statistics-title">合計△数</p>
                                                    <h3 class="rate-percentage">{{$user['middle_count']}} <span style="font-size: 12px;">個</span></h3>
                                                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                </div>
                                                <div class="d-none d-md-block">
                                                    <p class="statistics-title">空白数</p>
                                                    <h3 class="rate-percentage">{{$user['blank_count']}} <span style="font-size: 12px;">個</span></h3>
                                                    <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                                </div>
                                                <div class="d-none d-md-block">
                                                    <p class="statistics-title">解釈記入率</p>
                                                    <h3 class="rate-percentage">{{$user['description_count']}} <span style="font-size: 12px;">%</span></h3>
                                                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">全員の進捗</h4>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive  mt-1">
                                                        <table class="table select-table">
                                                            <thead>
                                                            <tr>
                                                                <th>User</th>
                                                                <th>Progress</th>
                                                                <th class="text-center">解釈記入率</th>
                                                                <th class="text-center">最終ログイン</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($users as $user)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex ">
                                                                            <div>
                                                                                <h6>{{$user['user_name']}}</h6>
                                                                                <p>{{$user['user_mail']}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div>
                                                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                                <p class="text-success">{{$user['total_progress']}} %</p>
                                                                                <p>{{$user['OK_count']}} / {{$user['BSS_count']}}</p>
                                                                            </div>
                                                                            <div class="progress progress-md">
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$user['total_progress']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="text-center">{{$user['description_count']}} %</h6>
                                                                    </td>
                                                                    <td class="text-center">@if(!is_null($user['last_login'])){{$user['last_login']}}@endif</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
@endsection
