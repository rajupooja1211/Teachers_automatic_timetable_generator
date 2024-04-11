<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 sidebar">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 site-logo-container">
            <h3 class="text-center site-logo">{{env("APP_NAME")}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="menu">
                <?php $page = Request::segment(1); ?>
                <li class="menu-link {{ ($page == 'dashboard') ? 'active' : '' }}">
                    <a href="/teacher"><span class="fa fa-dashboard"></span><span class="text">Dashboard</span></a>
                </li>
                <li class="menu-link {{ ($page == 'sms') ? 'active' : '' }}">
                    <a href="/sms"><span class="fa fa-dashboard"></span><span class="text">Sms</span></a>
                </li>
                <li class="menu-link">
                    <a href="/logout"><span class="fa fa-sign-out"></span><span class="text">Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>