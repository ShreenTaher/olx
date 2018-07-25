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
                        <a href="#">Rules</a>
                    </li>
                    <li class="active">{{ isset($rule) ? 'Edit' : 'Add New' }} Rule</li>
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
                                <span>{{ isset($rule) ? 'Edit' : 'Add New' }} Rule</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        Rules
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            {{ isset($rule) ? 'Edit' : 'Add New' }} Rule
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
                                        <h4 class="widget-title">{{ isset($rule) ? 'Edit' : 'Add New' }} Rule</h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <form method="post"
                                            action="/olx/rules{{ isset($rule) ? '/'.$rule->id : '' }}"
                                            enctype="multipart/form-data">
                                        {!! isset($rule) ? '<input type="hidden" name="_method" value="PUT">' : '' !!}
                                        {{ csrf_field() }}
                                                <!-- <legend>Form</legend> -->
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label col-lg-3">Rule</label>
                                                        <div class="col-lg-7">
                                                            <textarea cols="80" rows="3" name="rule">{{isset($rule) ? $rule->rule : ''}}</textarea>
                                                            @if ($errors->has('rule'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('rule') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
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