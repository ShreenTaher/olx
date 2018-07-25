<div>

    @if(Session::has('success'))
        <div class="alert alert-success alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            {{ Session::get('success') }}
        </div>
    @endif


    @if(Session::has('error'))
        <div class="alert alert-danger alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            {{ Session::get('error') }}
        </div>
    @endif

    {{--@if($errors->has())--}}
        {{--<div class="alert alert-danger alert-styled-left">--}}
            {{--<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>--}}
            {{--حدثت بعض الاخطاء التالية--}}
        {{--</div>--}}
    {{--@endif--}}

</div>