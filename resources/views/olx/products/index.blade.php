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
                    <li class="active">All Products</li>
                </ul><!-- /.breadcrumb -->

            </div>
            @include('olx.message')
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
                                <span>&nbsp; Choose Skin</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="pink">
                            <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                            <a href="#modal-table" role="button" class="green" data-toggle="modal">Display All Products</a>
                        </h4>

                        <div class="hr hr-18 dotted hr-double"></div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="clearfix">
                                    <div class="pull-right tableTools-container"></div>
                                </div>

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Username</th>
                                            <th>category</th>
                                            <th>Price</th>
                                            {{--<th>Phone</th>--}}
                                            {{--<th>Address</th>--}}
                                            <th>
                                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                                Created at
                                            </th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->user->name}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->price}}</td>
{{--                                            <td>{{$product->phone}}</td>--}}
{{--                                            <td>{{$product->address}}</td>--}}
                                            <td>{{$product->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="blue" href="/olx/products/{{$product->id}}">
                                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                                    </a>
                                                    {{--<a class="green" href="/olx/products/{{$product->id}}/edit">--}}
                                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                                    {{--</a>--}}

                                                    <a class="red delete"
                                                       onclick="return false;" object_id="{{ $product->id }}"
                                                       delete_url="/olx/products/{{ $product->id }}" href="/olx/products/{{ $product->id }}">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                </div>

                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/olx/products/{{$product->id}}" class="tooltip-primary" data-rel="tooltip" title="Show">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            {{--<li>--}}
                                                                {{--<a href="/olx/products/{{$product->id}}/edit" class="tooltip-success" data-rel="tooltip" title="Edit">--}}
                                                                    {{--<span class="green">--}}
                                                                        {{--<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>--}}
                                                                    {{--</span>--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}

                                                            <li>
                                                                <a onclick="return false;" object_id="{{ $product->id }}"
                                                                   delete_url="/olx/products/{{ $product->id }}" href="/olx/products/{{ $product->id }}"
                                                                   class="tooltip-error delete" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--<a href="/olx/products/create">--}}
                                        {{--<button type="button" name="button" style="margin: 20px;"--}}
                                                {{--class="btn btn-success pull-right">Add Product <i class="icon-arrow-left13 position-right"></i>--}}
                                        {{--</button>--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->


@endsection