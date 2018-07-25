
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
                        <a href="#">Products</a>
                    </li>
                    <li class="active">Display Product</li>
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
                                <span>Display Radiation</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        Products
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Display Product
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="content">

                    <!-- Form validation -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <a class="heading-elements-toggle"><i class="icon-menu"></i>Display Product Details</a></div>

                        <div class="panel-body">
                            <!-- Element -->
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-lg-10 col-lg-offset-2">
                                        <div class="all ">
                                            <ul class="list-inline">
                                                <li class="right">
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Name -> &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->title}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Content ->&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->content}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Price ->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->price}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Username -></span>
                                                        <span class="text-warning-600">{{$product->user->name}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Category ->&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->category->name}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Phone ->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->phone}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="sahh">
                                                        <span class="text-teal hea-lg">Address ->&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <span class="text-warning-600">{{$product->address}}</span>
                                                    </div>
                                                    <hr>
                                                    @if(! $product->images->isEmpty())
                                                        <div class="sahh">
                                                            <span class="text-teal hea-lg"> Images</span><br><br>
                                                            @foreach($product->images as $img)
                                                                <span class="text-warning-600">
                                                                <img src="/images/products/{{$img->image}}" style="margin: 5px;" width="250" height="250">
                                                            </span>
                                                            @endforeach
                                                        </div>
                                                        <hr>
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
            .text-warning-600{color: #438EB9}
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