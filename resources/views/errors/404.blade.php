@extends('layouts.app')
@section('content')

    <section class="breadcrumb_area">
        <div class="container">
            <h1>404</h1>
        </div>
    </section>

    <section class="content ">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="widget_shape">
                        <div class="error_page">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="error_massage text-center">
                                        <h2 class="error_tit">عذراً</h2>
                                        <p class="error_des1">لا يوجد نتائج بحث عن</p>
                                        <p class="error_des2">العنوان الذي يعذر عن وجوده</p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="error_icon text-center">
                                        404
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
