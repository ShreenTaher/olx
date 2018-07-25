<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->
    <ul class="nav nav-list">
        <li class='@if(Request::is('/olx/dashboard')) active @endif'>
            <a href="/olx/dashboard">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class='@if(Request::is('/olx/settings/create')) active @endif'>
            <a href="/olx/settings/create">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Settings </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class='@if(Request::is('/olx/admins')) active @endif'>
            <a href="/olx/admins">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Admins </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class='@if(Request::is('/olx/users')) active @endif'>
            <a href="/olx/users">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Users </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class='@if(Request::is('/olx/categories', '/olx/subcategories')) active @endif'>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Categories </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/olx/categories">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Categories
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="/olx/subcategories">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Sub Categories
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class='@if(Request::is('/olx/products')) active @endif'>
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Products </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/olx/waitingApprove">
                        <i class="menu-icon fa fa-caret-right"></i>
                        waiting approve
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="/olx/products">
                        <i class="menu-icon fa fa-caret-right"></i>
                        accepted products
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class='@if(Request::is('/olx/rules')) active @endif'>
            <a href="/olx/rules">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Rules </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class='@if(Request::is('/olx/contacts')) active @endif'>
            <a href="/olx/contacts">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Contacts </span>
            </a>

            <b class="arrow"></b>
        </li>

    </ul><!-- /.nav-list -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
