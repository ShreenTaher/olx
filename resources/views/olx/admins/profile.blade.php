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
                        <a href="#">Admins</a>
                    </li>
                    <li class="active">admin profile</li>
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
                                <span>&nbsp; Choose Skin</span>
                            </div>

                        </div><!-- /.pull-left -->

                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        Admin Profile Page
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <div>
                            <div id="user-profile-1" class="user-profile row">
                                <div class="col-xs-12 col-sm-3 center">
                                    <div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="/images/admins/{{\Illuminate\Support\Facades\Auth::user()->image}}" />
												</span>

                                        <div class="space-4"></div>

                                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                            <div class="inline position-relative">
                                                <a href="#" class="user-title-label dropdown-toggle">
                                                    <i class="ace-icon fa fa-circle light-green"></i>
                                                    &nbsp;
                                                    <span class="white">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-6"></div>

                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="space-12"></div>

                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Username </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="username">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Email </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Location </div>

                                            <div class="profile-info-value">
                                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                <span class="editable" id="country">{{\Illuminate\Support\Facades\Auth::user()->address}}</span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Phone </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="age">{{\Illuminate\Support\Facades\Auth::user()->phone}}</span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Joined </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="signup">{{\Illuminate\Support\Facades\Auth::user()->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="widget-box">
                                            <div class="widget-header">
                                                <h4 class="widget-title">Edit Admin</h4>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main no-padding">
                                                    <form method="post"
                                                          action="/medical/admins/{{ \Illuminate\Support\Facades\Auth::user()->id }}"
                                                          enctype="multipart/form-data">
                                                    {!!  '<input type="hidden" name="_method" value="PUT">' !!}
                                                    {{ csrf_field() }}
                                                    <!-- <legend>Form</legend> -->
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label for="name" class="control-label col-lg-3">Name</label>
                                                                    <div class="col-lg-7">
                                                                        <input value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" type="text"
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
                                                                    <label for="email" class="control-label col-lg-3">Email</label>
                                                                    <div class="col-lg-7">
                                                                        <input value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" type="email"
                                                                               class="form-control" name="email" id="email" placeholder="Enter email">
                                                                        @if ($errors->has('email'))
                                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label for="password" class="control-label col-lg-3">Password</label>
                                                                    <div class="col-lg-7">
                                                                        <input value="" type="password"
                                                                               class="form-control" name="password" id="password" placeholder="Enter password">
                                                                        @if ($errors->has('password'))
                                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label for="phone" class="control-label col-lg-3">Phone</label>
                                                                    <div class="col-lg-7">
                                                                        <input value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}" type="text"
                                                                               class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                                                        @if ($errors->has('phone'))
                                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label for="address" class="control-label col-lg-3">Address</label>
                                                                    <div class="col-lg-7">
                                                                        <input value="{{ \Illuminate\Support\Facades\Auth::user()->address }}" type="text"
                                                                               class="form-control" name="address" id="address" placeholder="Enter address">
                                                                        @if ($errors->has('address'))
                                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
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

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

@endsection