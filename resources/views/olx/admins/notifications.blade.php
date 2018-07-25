
@extends('admin_layout.app')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Users</a>
                    </li>
                    <li class="active">Display All Notifications</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50" style="padding: 35px 10px">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>Display Notifications</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        Admins
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Display Notifications
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="content">

                    <!-- Form validation -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <a class="heading-elements-toggle"><i class="icon-menu"></i>Display Notifications Details</a></div>

                        <div class="panel-body">
                            <!-- Element -->
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-lg-10 col-lg-offset-2">
                                        <div class="all ">
                                            <ul class="list-inline">
                                                <li class="right">
                                                    @if(!$notifications->isEmpty())
                                                        @foreach($notifications as $notification)
                                                            <div class="sahh">
                                                                {{--<span class="text-teal hea-lg">Order Owner</span>--}}
                                                                <span class="text-warning-600">{{ $notification->data['message'] }}</span>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    @else
                                                        there is No Notifications
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
        <style>
            .row{
                margin-bottom: 30px;
            }
            table {
                border-spacing: 20px !important;
                border-collapse: collapse;
                border: 5px solid #eee;
            }
            .text-teal{
                margin-right: 80px;
            }
            .sahh{
                width: 600px;
                font-size: 16px;
                margin: auto 50px;
            }
            .right{
                margin-bottom: 20px;
                border: 1px dashed #28343a;
                box-shadow: 3px 2px 7px #CCC;
                padding: 40px;
            }
            object{
                width: 100%;
                height: 400px;
            }

        </style>

@endsection