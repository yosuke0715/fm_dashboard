<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/home')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">BSS</li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/bss-progress')}}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">BSS【進捗】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/bss-view')}}">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">BSS【一覧】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/bss-add')}}">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">BSS【追加】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/bss-edit')}}">
                <i class="menu-icon mdi mdi-layers-outline"></i>
                <span class="menu-title">BSS【編集】</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item nav-category">解釈添削</li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/bss-score')}}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">BSS解釈添削</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item nav-category">追加</li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/add-category')}}">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">カテゴリ追加</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    </ul>
</nav>
