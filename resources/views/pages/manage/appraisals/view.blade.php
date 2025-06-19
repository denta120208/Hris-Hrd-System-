@extends('_main_layout')

@section('content')
<div class="container">
    <div class="row">
        <?php
            $project = DB::table('location')->where('code', Session::get('project'))->first();
            $year = $project->appraisal_year_period;

            $evaluators = DB::select("SELECT e.emp_number, ev.evaluator_status, e.emp_firstname, e.emp_middle_name, e.emp_lastname
                FROM emp_evaluator ev INNER JOIN employee e
                ON ev.emp_number = e.emp_number
                WHERE ev.is_delete = 0
                and ev.emp_evaluation = '".$emp->emp_number."'
            ");

            foreach($evaluators as $key => $data) {
                $countAppraisalStatusAll = \DB::table("emp_appraisal")->where("period", $year)->where("emp_number", $emp->emp_number)->where("emp_evaluator", $data->emp_number)->count();
                $countAppraisalStatusBukanDua = \DB::table("emp_appraisal")->where("period", $year)->where("emp_number", $emp->emp_number)->where("emp_evaluator", $data->emp_number)->where("appraisal_status", "<>", 2)->count();
                if($countAppraisalStatusAll > 0) {
                    if($countAppraisalStatusBukanDua > 0) {
                        $evaluators[$key]->status_dua = false;
                    }
                    else {
                        $evaluators[$key]->status_dua = true;
                    }
                }
                else {
                    $evaluators[$key]->status_dua = false;
                }
            }

            $td = 0;
            $array = array();
            $countEvaluators = count($evaluators);
        ?>
        <h3>{{ $emp->emp_firstname." ".$emp->emp_middle_name." ".$emp->emp_lastname }}</h3>
        <h4>{{ $emp->job_title->job_title }}</h4>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            @if($pic)
                @if($pic->epic_picture_type == '2')
                    <img style="height: 150px;width: 150px;" class="img-responsive img-thumbnail" src="data:image/jpeg;base64,{{ base64_encode($pic->epic_picture) }}"/>
                @elseif($pic->epic_picture_type == '1')
                    <img style="height: 150px;width: 150px;" class="img-responsive img-thumbnail" src="data:image/jpeg;base64,{{ $pic->epic_picture }}"/>
                @else
                    <img src="{{ asset('images\personal\FOTO_DEFAULT.gif') }}">
                @endif
            @else
                <img src="{{ asset('images\personal\FOTO_DEFAULT.gif') }}">
            @endif
            @foreach($evaluators as $eva)
            <?php
                $nama_evaluators = strtolower($eva->emp_firstname.' '.$eva->emp_middle_name.' '.$eva->emp_lastname);
                $fix_nama_evaluators = ucwords($nama_evaluators);
            ?>
            @if($eva->status_dua == true)
            <div style="padding-top: 10px;">
                <a href="/hrd/print_appraisal/{{ $emp->emp_number }}/{{ $eva->emp_number }}" onclick="window.open(this.href).print(); return false" class="btn btn-primary">{!! ucwords($fix_nama_evaluators) !!}</a>
            </div>
            @endif
            @endforeach
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <table class="table table-striped" id="emp_appraisal">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Factor Name</th>
                    @foreach($evaluators as $eva)
                    @if($eva->status_dua == true)
                    <th>{!! $eva->emp_firstname.' '.$eva->emp_middle_name.' '.$eva->emp_lastname !!}</th>
                    @else
                    <th>{!! $eva->emp_firstname.' '.$eva->emp_middle_name.' '.$eva->emp_lastname !!} <span style="color: red;">(DRAFT)</span></th>
                    @endif
                    <?php
                        $array[$td] = $eva->emp_number;
                        $td++;
                    ?>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <?php $total_appraisal_value = 0; ?>
                @if($appraisals)
                    <?php $no = 1;?>
                    @foreach($appraisals as $row)
                    <tr>
                        <td>{!! $no !!}</td>
                        <td>{!! $row->factor !!}</td>
                        @foreach($evaluators as $eva)
                        <?php
                        // $year = date("Y");
                        $val_appr = DB::select("
                                SELECT ea.appraisal_value, ea.emp_evaluator,ea.appraisal_id
                                FROM emp_appraisal ea
                                WHERE ea.period = '".$year."' AND ea.emp_number = '".$emp->emp_number."' AND ea.emp_evaluator = '".$eva->emp_number."' AND appraisal_id = '".$row->id."'");
                        ?>
                        @if($val_appr)
                            <td class="{!! $val_appr[0]->emp_evaluator !!}">{!! $val_appr[0]->appraisal_value !!}</td>
                            <?php $total_appraisal_value += $val_appr[0]->appraisal_value; ?>
                        @else
                            <td class="{!! $eva->emp_number !!}">0.00</td>
                        @endif
                        @endforeach
                    </tr>
                    <?php $no++;?>
                    @endforeach
                @else
                    <tr><td>No Data</td></tr>
                @endif
                <tr style="font-weight: bold;">
                    <td colspan="2">Total Per Evaluator</td>
                    @for($j=0;$j<count($array);$j++)
                        <script type="text/javascript">
                            $(document).ready(function(){
                                var classes = {!! $array[$j] !!};
                                var sum = 0;
                                var results = '';
                                var temp = '';
                                $("."+classes).each(function() {
                                    var value = $(this).text();
                                    // add only if the value is number
                                    if(!isNaN(value) && value.length != 0) {
                                        sum += parseFloat(value);
                                        if(sum >= 0 && sum <= 54.99){
                                            results = 'K'
                                        }else if(sum >= 55 && sum <= 68.99){
                                            results = 'C'
                                        }else if(sum >= 69 && sum <= 79.99){
                                            results = 'CB'
                                        }else if(sum >= 80 && sum <= 92.99){
                                            results = 'B'
                                        }else if(sum >= 93 && sum <= 100){
                                            results = 'SB'
                                        }else{
                                            results = '-'
                                        }
                                    }
                                    {{-- $('.total_'+classes).text(sum+' / '+results); --}}
                                    $('.total_'+classes).text(sum);
                                });
                                {{--if(sum >= 0){--}}
                                {{--    $.ajax({--}}
                                {{--        type: "GET",--}}
                                {{--        url: '{{ route('hrd.getResult') }}',--}}
                                {{--        data: {result_val:sum},--}}
                                {{--        success: function(response){--}}
                                {{--            results = response['hasil'];--}}

                                {{--        }--}}
                                {{--    });--}}
                                {{--}--}}
                            });</script>
                        <td class="total_{!! $array[$j] !!}"></td>
                    @endfor
                </tr>
                <?php
                    // $total_average_all_evaluators = (float) ($total_appraisal_value / count($array));
                    $dataEmpAppraisalValue = \DB::table("emp_appraisal_value")->where("emp_number", $emp->emp_number)->where("period", $year)->first();
                    $sup_value = empty($dataEmpAppraisalValue->sup_value) ? 0 : $dataEmpAppraisalValue->sup_value;
                    $dir_value = empty($dataEmpAppraisalValue->dir_value) ? 0 : $dataEmpAppraisalValue->dir_value;
                    $total_average_all_evaluators = empty($sup_value) ? $dir_value : $sup_value;
                ?>
                <tr style="font-weight: bold;">
                    <td colspan="2">Total Average All Evaluators</td>
                    <td>{{ $total_average_all_evaluators }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection