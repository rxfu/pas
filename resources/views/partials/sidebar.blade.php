<div class="collapse navbar-collapse" id="sidebar">
    <ul class="navbar-nav navbar-sidenav" id="sidebarAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="仪表盘">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">仪表盘</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="评分统计">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#score" data-parent="#sidebarAccordion">
                <i class="fa fa-fw fa-area-chart"></i>
                <span class="nav-link-text">评分统计</span>
            </a>
            <ul class="sidenav-second-level collapse" id="score">
                <li>
                  <a href="#">评分排行</a>
                </li>
                <li>
                  <a href="#">评分细目</a>
                </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="指标管理">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#index" data-parent="#sidebarAccordion">
                <i class="fa fa-fw fa-link"></i>
                <span class="nav-link-text">指标管理</span>
            </a>
            <ul class="sidenav-second-level collapse" id="index">
                <li>
                  <a href="{{ route('index.list') }}">一级指标</a>
                </li>
                <li>
                  <a href="{{ route('subindex.list') }}">二级指标</a>
                </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="系统管理">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#system" data-parent="#sidebarAccordion">
                <i class="fa fa-fw fa-wrench"></i>
                <span class="nav-link-text">系统管理</span>
            </a>
            <ul class="sidenav-second-level collapse" id="system">
                <li>
                  <a href="{{ route('department.list') }}">部门管理</a>
                </li>
                <li>
                  <a href="{{ route('user.list') }}">用户管理</a>
                </li>
                <li>
                  <a href="{{ route('user.chgpwd') }}">修改密码</a>
                </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="退出系统">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out"></i>
                <span class="nav-link-text">退出系统</span>
            </a>
        </li>
    </ul>
</div>