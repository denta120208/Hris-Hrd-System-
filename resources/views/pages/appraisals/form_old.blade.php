@extends('_main_layout')

@section('content')
<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("[data-toggle=popover]").popover({
            container: 'body'
        });
        {{--$("#appraisal_cat").change(function(){--}}
        {{--    var e = document.getElementById("appraisal_cat");--}}
        {{--    var id = e.options[e.selectedIndex].value;--}}
        {{--    var typeId = '{{ $type->code->code_appraisal }}';--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('getAppraisal') }}',--}}
        {{--        type: 'get',--}}
        {{--        data: { id:id, type_code:typeId },--}}
        {{--        dataType: 'html',--}}
        {{--        cache: false,--}}
        {{--        success:function(response){--}}
        {{--            $('#true-form').html(response);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    });
</script>
<div class="container">
    <input type="hidden" id="addClasses" value="active" />
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($pic)
                    <img class="img-responsive img-thumbnail" src="data:image/jpeg;base64,{{ base64_encode( $pic->epic_picture ) }}"/>
                @else
                    <img src="{{ asset('images\personal\FOTO_DEFAULT.gif') }}">
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <h3>{{ $emp->emp_firstname." ".$emp->emp_middle_name." ".$emp->emp_lastname }}</h3>
                <h4>{{ $emp->job_title->job_title }}</h4>
            </div>
        </div>
        <br /><br />
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="{{ route('setAppraisal') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="emp_number" value="{{ $emp_number }}" />
                <div id="true-form">
                    @foreach($appraisal as $row)
                        <div class="form-group">
                            <label>{{ $row->factor }}</label>
                            <div class="col-sm-2">
                                <input type="hidden" name="appraisal_id[]" value="{{ $row->id }}" />
                                <input class="form-control" type="text" name="factor[]" id="factor"  style="text-align: center; width: 60px;" autocomplete="off" />
                            </div>
                            <a tabindex="0"
                               role="button"
                               data-html="true"
                               data-toggle="popover"
                               data-trigger="focus"
                               title=""
                               data-content="<div><p>KURANG : {{ $row->tips_kurang }}</p>
           <p>CUKUP : {{ $row->tips_cukup }}</p><p>CUKUP BAIK : {{ $row->tips_cb }}</p>
           <p>BAIK : {{ $row->tips_baik }}</p><p>SANGAT BAIK : {{ $row->tips_sb }}</p></div>"><i class="fa fa-info-circle"></i></a>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>
        <?php $evaluator = \App\Models\Employee\EmpEvaluator::where('emp_evaluation', $emp_number)->get();?>
        @foreach($appraisals as $row)
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ $row->factor }}</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text" name="factor" value="{{ $row->appraisal_value }}" disabled="disabled" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection