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
                        <a href="#">Not Authorized</a>
                    </li>
                </ul><!-- /.breadcrumb -->

            </div>
            <div class="page-content">
        <!-- Main charts -->
            <div class="row">
            <div class="col-lg-12">
                <!-- Bordered panel body table -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">403</h5>
                        <div class="heading-elements">
                            {{--<ul class="icons-list">--}}
                                {{--<li><a data-action="collapse"></a></li>--}}
                                {{--<li><a data-action="reload"></a></li>--}}
                                {{--<li><a data-action="close"></a></li>--}}
                            {{--</ul>--}}
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="error_page">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="error_massage text-center">
                                        <h1>     403</h1>
                                        <h2 class="error_tit">عذراً</h2>
                                        <p class="error_des1">لا تملك صلاحية الوصول إلى هذا العنوان</p>
                                        <p class="error_des2">العنوان الذي يعذر عن وجوده</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <!-- /bordered panel body table -->
            </div>
        </div>
        <!-- /main charts -->
            </div>
        </div>
    </div>
    {{--</div>--}}
    <!-- Content area ////////////////-->
@endsection