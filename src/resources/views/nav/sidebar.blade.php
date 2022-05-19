<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">BSS</li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/bss-view')}}" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">BSS</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/bss-desc')}}">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">BSS【解釈】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/bss-test')}}">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">BSS【テスト】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item nav-category">pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
