
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Admin Panel
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="purple dropdown-modal notification">
                    <a data-toggle="dropdown" class="dropdown-toggle dropdown_item" href="#">
                        {{--<i class="ace-icon fa fa-bell icon-animated-bell"></i>--}}
                        <i class="ace-icon fa fa-bell"></i>
                        <span class="badge badge-important">
                            <span id="count1">{{ count(auth()->user()->unreadNotifications) }}</span>
                        </span>
                    </a>

                    <ul  style="width: 300px" class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header notification">
                            <i class="ace-icon fa fa-exclamation-triangle"></i>
                            <span id="count2">{{ count(auth()->user()->unreadNotifications) }}</span>Notifications
                        </li>

                        <li class="dropdown-content" >
                            <ul class="dropdown-menu dropdown-navbar navbar-pink notification" id="showNotification" >
                                @foreach(auth()->user()->notifications->take(6) as $note)
                                <li>
                                    <a href="/olx/waitingApprove" class="notify {{$note->read_at == null ? 'unread' : ''}}">
                                        <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        {!! $note->data['message'] !!}
													</span>
                                            {{--<span class="pull-right badge badge-success">+8</span>--}}
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown-footer">
                            <a href="/olx/showMore">
                                See all notifications
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--<li class="green dropdown-modal">--}}
                    {{--<a data-toggle="dropdown" class="dropdown-toggle" href="#">--}}
                        {{--<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>--}}
                        {{--<span class="badge badge-success">5</span>--}}
                    {{--</a>--}}

                    {{--<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">--}}
                        {{--<li class="dropdown-header">--}}
                            {{--<i class="ace-icon fa fa-envelope-o"></i>--}}
                            {{--5 Messages--}}
                        {{--</li>--}}

                        {{--<li class="dropdown-content">--}}
                            {{--<ul class="dropdown-menu dropdown-navbar">--}}
                                {{--<li>--}}
                                    {{--<a href="#" class="clearfix">--}}
                                        {{--<img src="/admin_panel/assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />--}}
                                        {{--<span class="msg-body">--}}
													{{--<span class="msg-title">--}}
														{{--<span class="blue">Alex:</span>--}}
														{{--Ciao sociis natoque penatibus et auctor ...--}}
													{{--</span>--}}

													{{--<span class="msg-time">--}}
														{{--<i class="ace-icon fa fa-clock-o"></i>--}}
														{{--<span>a moment ago</span>--}}
													{{--</span>--}}
												{{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                {{--<li>--}}
                                    {{--<a href="#" class="clearfix">--}}
                                        {{--<img src="/admin_panel/assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />--}}
                                        {{--<span class="msg-body">--}}
													{{--<span class="msg-title">--}}
														{{--<span class="blue">Susan:</span>--}}
														{{--Vestibulum id ligula porta felis euismod ...--}}
													{{--</span>--}}

													{{--<span class="msg-time">--}}
														{{--<i class="ace-icon fa fa-clock-o"></i>--}}
														{{--<span>20 minutes ago</span>--}}
													{{--</span>--}}
												{{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                {{--<li>--}}
                                    {{--<a href="#" class="clearfix">--}}
                                        {{--<img src="/admin_panel/assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />--}}
                                        {{--<span class="msg-body">--}}
													{{--<span class="msg-title">--}}
														{{--<span class="blue">Bob:</span>--}}
														{{--Nullam quis risus eget urna mollis ornare ...--}}
													{{--</span>--}}

													{{--<span class="msg-time">--}}
														{{--<i class="ace-icon fa fa-clock-o"></i>--}}
														{{--<span>3:15 pm</span>--}}
													{{--</span>--}}
												{{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                {{--<li>--}}
                                    {{--<a href="#" class="clearfix">--}}
                                        {{--<img src="/admin_panel/assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />--}}
                                        {{--<span class="msg-body">--}}
													{{--<span class="msg-title">--}}
														{{--<span class="blue">Kate:</span>--}}
														{{--Ciao sociis natoque eget urna mollis ornare ...--}}
													{{--</span>--}}

													{{--<span class="msg-time">--}}
														{{--<i class="ace-icon fa fa-clock-o"></i>--}}
														{{--<span>1:33 pm</span>--}}
													{{--</span>--}}
												{{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                {{--<li>--}}
                                    {{--<a href="#" class="clearfix">--}}
                                        {{--<img src="/admin_panel/assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />--}}
                                        {{--<span class="msg-body">--}}
													{{--<span class="msg-title">--}}
														{{--<span class="blue">Fred:</span>--}}
														{{--Vestibulum id penatibus et auctor  ...--}}
													{{--</span>--}}

													{{--<span class="msg-time">--}}
														{{--<i class="ace-icon fa fa-clock-o"></i>--}}
														{{--<span>10:09 am</span>--}}
													{{--</span>--}}
												{{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li class="dropdown-footer">--}}
                            {{--<a href="inbox.html">--}}
                                {{--See all messages--}}
                                {{--<i class="ace-icon fa fa-arrow-right"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle dropdown_item">
                        {{--<img class="nav-user-photo" src="" alt="Jason's Photo" />--}}
                        <span class="user-info">
									<small>Welcome,</small>
                            {{ Auth::user()->name }}
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        {{--<li>--}}
                            {{--<a href="/olx/admins/profile">--}}
                                {{--<i class="ace-icon fa fa-user"></i>--}}
                                {{--Profile--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
