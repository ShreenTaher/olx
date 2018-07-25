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
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content" style="">
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
                            <span>&nbsp; Choose Skin</span>
                        </div>

                    </div><!-- /.pull-left -->

                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <div class="page-header">
                <h1>
                    Dashboard
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        overview &amp; stats
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="space-6"></div>

                        <div class="col-sm-12 infobox-container">
                            <div class="infobox infobox-green">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-comments"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$contacts}}</span>
                                    <div class="infobox-content">New Contacts</div>
                                </div>

                                <div class="stat stat-success"></div>
                            </div>
                            <div class="infobox infobox-blue">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div>
                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$admins}}</span>
                                    <div class="infobox-content">Admins</div>
                                </div>
                                <div class="badge badge-success">..%
                                    <i class="ace-icon fa fa-arrow-up"></i>
                                </div>
                            </div>

                            <div class="infobox infobox-pink">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-shopping-cart"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$new_products}}</span>
                                    <div class="infobox-content">new Products Waiting Approve</div>
                                </div>
                                <div class="stat stat-important">..%</div>
                            </div>
                            <div class="infobox infobox-red">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-flask"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$categories}}</span>
                                    <div class="infobox-content">Categories</div>
                                </div>
                            </div>
                            <div class="infobox infobox-red">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-flask"></i>
                                </div>

                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$products}}</span>
                                    <div class="infobox-content">Accepted Products</div>
                                </div>
                            </div>
                            <div class="infobox infobox-blue">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-twitter"></i>
                                </div>
                                <div class="infobox-data">
                                    <span class="infobox-data-number">{{$users}}</span>
                                    <div class="infobox-content">Users</div>
                                </div>
                                <div class="badge badge-success">..%
                                    <i class="ace-icon fa fa-arrow-up"></i>
                                </div>
                            </div>
                            <div class="space-6"></div>

                        </div>

                        <div class="vspace-12-sm"></div>


                    </div><!-- /.row -->

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
    <style>
        .infobox{
            margin: 5px;
            background-color: #f5f5f5;
        }
    </style>
    <script>
        $(function () {
            $('.dropdown-toggle').on('click', function (e) {
                e.preventDefault();
                $(this).parent().toggleClass('open');
            });
            $('.dropdown_item').on('click', function (e) {
                e.preventDefault();
                $(this).parent().toggleClass('open');
            });
        });
    </script>
@endsection