<script>
$(document).ready(function(){
    $('#personalDtlSave').hide();
    $('#personalDtlCancel').hide();
    $('#emp_dri_lice_exp_date').datetimepicker("option", "disabled", true );
    $('#emp_birthday').datetimepicker("option", "disabled", true );
    $("#emp_dri_lice_exp_date").prop('disabled', true);
    $("#emp_birthday").prop('disabled', true);
    $('#personalDtl').click(function(){
        $('#personalForm input[type="text"]').prop("readonly", false);
        $('#personalForm select[name="emp_marital_status"]').prop("disabled", false);
        $('#emp_gender').prop("disabled", false);
        $('#nation_code').prop("disabled", false);
        $('#personalDtl').hide();
        $('#personalDtlSave').show();
        $('#personalDtlCancel').show();
        $('#emp_dri_lice_exp_date').datetimepicker({
           format: 'Y-m-d'
        });
        $('#emp_birthday').datetimepicker({
           format: 'Y-m-d'
        });
        $("#emp_dri_lice_exp_date").prop('disabled', false);
        $("#emp_birthday").prop('disabled', false);
    });
    $('#personalDtlCancel').click(function(){
        $('#personalForm input[type="text"]').prop("readonly", true);
        $('#personalForm select[name="emp_marital_status"]').prop("disabled", true);
        $('#emp_gender').prop("disabled", true);
        $('#nation_code').prop("disabled", true);
        $('#personalDtl').show();
        $('#personalDtlSave').hide();
        $('#personalDtlCancel').hide();
        $('#emp_dri_lice_exp_date').datetimepicker("option", "disabled", true );
        $('#emp_birthday').datetimepicker("option", "disabled", true );
        $("#emp_dri_lice_exp_date").prop('disabled', true);
        $("#emp_birthday").prop('disabled', true);
    });
    $('#personalDtlSave').click(function (){
        $('form#personalForm').submit();
    });
//    $('#emp_dri_lice_exp_date').datetimepicker({
//        format: 'd-m-Y',
//    });
//    $('#emp_birthday').datetimepicker({
//        format: 'd-m-Y',
//    });
    // $('#start_date,#end_date').datetimepicker({
    //     useCurrent: false,
    //     format: 'Y-m-d H:i',
    //     timepicker:true,
    //     minDate: moment()
    // });
});
</script>
<?php
//    print_r($emp->emp_birthday);
function date_formated($date){
    $new_date = date('d-m-Y', strtotime(substr($date, 0, 11)));
    return $new_date;
}
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div style="margin-top: 70px;" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        @if($pic)
            @if($pic->epic_picture_type == '2')
                <img style="height: 250px;width: 450px;" class="img-responsive img-thumbnail" src="data:image/jpeg;base64,{{ base64_encode($pic->epic_picture) }}"/>
            @elseif($pic->epic_picture_type == '1')
                <img style="height: 250px;width: 450px;" class="img-responsive img-thumbnail" src="data:image/jpeg;base64,{{ $pic->epic_picture }}"/>
            @else
                <img src="{{ asset('images\personal\FOTO_DEFAULT.gif') }}">
            @endif
        @else
            <img src="{{ asset('images\personal\FOTO_DEFAULT.gif') }}">
        @endif
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
<form id="personalForm" action="{{ route('personalEmp.setPersonal') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="emp_number" value="{{ $emp->emp_number }}" />
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="name">Firstname</label>
            <input class="form-control" type="text" name="emp_firstname" id="emp_firstname" value="{{ $emp->emp_firstname }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="emp_middle_name">Middlename</label>
            <input class="form-control" type="text" name="emp_middle_name" id="emp_middle_name" value="{{ $emp->emp_middle_name }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="emp_lastname">Lastname</label>
            <input class="form-control" type="text" name="emp_lastname" id="emp_lastname" value="{{ $emp->emp_lastname }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="employee_id">Employee Id</label>
            <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $emp->employee_id }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emp_ktp">KTP</label>
            <input class="form-control" type="text" name="emp_ktp" id="emp_ktp" value="{{ $emp->emp_ktp }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <?php
            $emp_gender = array('-=Pilih=-','Male','Female');
            ?>
            {!! Form::label('emp_gender', 'Gender') !!}
            {!! Form::select('emp_gender', $emp_gender, $emp->emp_gender, ['class' => 'form-control', 'id' => 'emp_gender', 'disabled' => 'disabled']) !!}
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <?php $nationality = \App\Models\Master\Nationality::lists('name', 'id')->prepend('-=Pilih=-', '0');?>
            {!! Form::label('nation_code', 'Nationality') !!}
            {!! Form::select('nation_code', $nationality, $emp->nation_code, ['class' => 'form-control', 'id' => 'nation_code', 'disabled' => 'disabled']) !!}
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emp_dri_lice_num">Driver's License Number</label>
            <input class="form-control" type="text" name="emp_dri_lice_num" id="emp_dri_lice_num" value="{{ $emp->emp_dri_lice_num }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emp_dri_lice_exp_date">License Expiry Date</label>
            <input class="form-control" type="text" name="emp_dri_lice_exp_date" id="emp_dri_lice_exp_date" value="{{ $emp->emp_dri_lice_exp_date && date_formated($emp->emp_dri_lice_exp_date) != '01-01-1970' ? date_formated($emp->emp_dri_lice_exp_date) : '-' }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emp_marital_status">Marital Status</label>
            {{-- <input class="form-control" type="text" name="emp_marital_status" id="emp_marital_status" value="{{ $emp->emp_marital_status }}" readonly="readonly" /> --}}
            <select class="form-control" name="emp_marital_status" id="emp_marital_status" required disabled>
                <option value="">-- Not Selected --</option>
                <option value="Lajang" {{ $emp->emp_marital_status == "Lajang" ? "selected" : "" }}>Lajang</option>
                <option value="Menikah" {{ $emp->emp_marital_status == "Menikah" ? "selected" : "" }}>Menikah</option>
                <option value="Cerai" {{ $emp->emp_marital_status == "Cerai" ? "selected" : "" }}>Cerai</option>
                <option value="Janda/Duda" {{ $emp->emp_marital_status == "Janda/Duda" ? "selected" : "" }}>Janda/Duda</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="emp_birthday">Date of Birth</label>
            <input class="form-control" type="text" name="emp_birthday" id="emp_birthday" value="{{ $emp->emp_birthday && date_formated($emp->emp_birthday) != '01-01-1970' ? date_formated($emp->emp_birthday) : '-' }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="bpjs_ks">BPJS Kes</label>
            <input class="form-control" type="text" name="bpjs_ks" id="bpjs_ks" value="{{ $emp->bpjs_ks }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="bpjs_tk">BPJS TK</label>
            <input class="form-control" type="text" name="bpjs_tk" id="bpjs_tk" value="{{ $emp->bpjs_tk }}" readonly="readonly" />
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="npwp">No NPWP</label>
            <input class="form-control" type="text" name="npwp" id="npwp" value="{{ $emp->npwp }}" readonly="readonly" />
        </div>
    </div>
</form></div>
</div>
<button class="btn btn-success" id="personalDtl">Edit</button>
<button class="btn btn-primary" id="personalDtlSave">Save</button>
<button class="btn btn-danger" id="personalDtlCancel">Cancel</button>