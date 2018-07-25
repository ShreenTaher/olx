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
                        <a href="#">Categories</a>
                    </li>
                    <li class="active">{{ isset($category) ? 'Edit' : 'Add New' }} Categories</li>
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
                                <span>{{ isset($category) ? 'Edit' : 'Add New' }} Categories</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        categories
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            {{ isset($category) ? 'Edit' : 'Add New' }} Categories
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">{{ isset($category) ? 'Edit' : 'Add New' }} Categories</h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <form method="post"
                                            action="/olx/categories{{ isset($category) ? '/'.$category->id : '' }}"
                                            enctype="multipart/form-data">
                                        {!! isset($category) ? '<input type="hidden" name="_method" value="PUT">' : '' !!}
                                        {{ csrf_field() }}
                                                <!-- <legend>Form</legend> -->
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label col-lg-3">Name</label>
                                                        <div class="col-lg-7">
                                                            <input value="{{ isset($category) ? $category->name : '' }}" type="text"
                                                                   class="form-control" name="name" id="name" placeholder="Enter name">
                                                            @if ($errors->has('name'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="image" class="control-label col-lg-3">Image</label>
                                                        <div class="col-lg-7">
                                                            {{--<input type="file" id="id-input-file-2" name="image" />--}}
                                                            <input type="file" id="id-input-file-3" name="image" />
                                                            @if ($errors->has('image'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                                <div class="form-actions center">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Submit
                                                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                    </button>
                                                    <button class="btn btn-sm " type="reset">
                                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                                        Reset
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->


@endsection