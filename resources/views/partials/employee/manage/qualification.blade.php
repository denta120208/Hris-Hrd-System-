<?php

function date_formated($date) {
    $new_date = date('d-m-Y', strtotime(substr($date, 0, 11)));
    return $new_date;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addEdu').hide();
        $('#addWork').hide();
        $('#addTrain').hide();
        $('#eduDtlSave').hide();
        $('#eduDtlCancel').hide();
        $('.deleteButton').hide();
        $('.deleteButton1').hide();
        $('.deleteButton2').hide();
        $('#start_date').datetimepicker({
            format: 'Y-m-d',
        });
        $('#end_date').datetimepicker({
            format: 'Y-m-d',
        });
        $('#eexp_from_date').datetimepicker({
            format: 'Y-m-d',
        });
        $('#eexp_to_date').datetimepicker({
            format: 'Y-m-d',
        });
        $('#editDtlEdu').click(function(){
            $('#idEduEmp').val( $('#emp_id').val() );
            $('.deleteButton').show();
            $('#addEdu').show();
            $('#editDtlEdu').hide();
            $('#eduDtlSave').show();
            $('#eduDtlCancel').show();
        });
        $('#eduDtlCancel').click(function(){
            $('#addEdu').hide();
            $('.deleteButton').hide();
            $('#editDtlEdu').show();
            $('#eduDtlSave').hide();
            $('#eduDtlCancel').hide();
        });
        $('#eduDtlSave').click(function (){
            $('form#addEdu').submit();
        });
        $('#editDtlWork').click(function(){
            $('#idWorkEmp').val( $('#emp_id').val() );
            $('.deleteButton1').show();
            $('#addWork').show();
            $('#editDtlWork').hide();
            $('#workDtlSave').show();
            $('#workDtlCancel').show();
        });
        $('#workDtlCancel').click(function(){
            $('.deleteButton1').hide();
            $('#addWork').hide();
            $('#editDtlWork').show();
            $('#workDtlSave').hide();
            $('#workDtlCancel').hide();
        });
        $('#workDtlSave').click(function (){
            $('form#addWork').submit();
        });
        $('#editDtlTrain').click(function(){
            $('#idTrainEmp').val( $('#emp_id').val() );
            $('.deleteButton2').show();
            $('#addTrain').show();
            $('#editDtlTrain').hide();
            $('#trainDtlSave').show();
            $('#trainDtlCancel').show();
        });
        $('#trainDtlCancel').click(function(){
            $('.deleteButton2').hide();
            $('#addTrain').hide();
            $('#editDtlTrain').show();
            $('#trainDtlSave').hide();
            $('#trainDtlCancel').hide();
        });
        $('#trainDtlSave').click(function (){
            $('form#addTrain').submit();
        });
        $('#license_issued_date').datetimepicker({
            format: 'Y-m-d',
        });
        $('#license_expiry_date').datetimepicker({
            format: 'Y-m-d',
        });
    });
    function deleteConfirmation(e, message) {
        if (!confirm("Delete " + message + "?")) {
            e.preventDefault();
        }
    }
</script>
<div class="table-responsive">
    <div>
        <form id="addEdu" action="{{ route('personalEmp.setEducation') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="idEduEmp" id="idEduEmp" />
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <?php $edu = \App\Models\Master\Education::lists('name','id')->prepend('-=Pilih=-', '0'); ?>
                    <label for="education_id">Level <span style="color: red;">*</span></label>
                    {!! Form::select('education_id', $edu, null, ['class' => 'form-control', 'id' => 'education_id']) !!}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="institute">Institute <span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="institute" id="institute" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label for="major">Major/Specialization <span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="major" id="major" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input class="form-control" type="text" name="year" id="year" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label for="score">GPA/Score</label>
                    <input class="form-control" type="text" name="score" id="score" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="start_date">Start Date <span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="start_date" id="start_date" readonly="readonly" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="end_date">End Date <span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="end_date" id="end_date" readonly="readonly" />
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Save">
            <input type="reset" class="btn btn-danger" id="eduDtlCancel" value="Cancel">
        </form>
        <h4>Education</h4>
        <table id="data-table-basic" class="table table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Institution Name</th>
                <th>Major</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @if($edus)
                    <?php $no = 1;?>
                    @foreach($edus as $row)
                        <tr @if(isset($row->is_delete) && $row->is_delete == 1) style="opacity:0.5; background:#eee;" @endif>
                            <td>{{ $no }}</td>
                            <td>{{ $row->education->name }}</td>
                            <td>{{ $row->institute }}</td>
                            <td>{{ $row->major }}</td>
                            <td>{{ $row->start_date == "Jan  1 1900 12:00:00:AM" ? "-" : date_formated($row->start_date)  }}</td>
                            <td>{{ $row->end_date == "Jan  1 1900 12:00:00:AM" ? "-" : date_formated($row->end_date)  }}</td>
                            <td>
                                @if(isset($row->is_delete) && $row->is_delete == 1)
                                    <i class="fa fa-trash" style="color:gray" title="Deleted"></i>
                                @else
                                    <a onclick="deleteConfirmation(event,'education')" id="deleteButton" class="deleteButton" href="{{ route('personalEmp.deleteEducation', $row->id) }}"><i class="fa fa-trash" title="Delete"></i></a>
                                @endif
                            </td>
                            <?php $no++;?>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="5">No Data</td></tr>
                @endif
            </tbody>
        </table>
        <button id="editDtlEdu" class="btn btn-success">Edit</button>
    </div>
<fieldset>
    <form id="addWork" action="{{ route('personalEmp.setWork') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="idWorkEmp" id="idWorkEmp" />
        <div class="form-group">
            <label for="eexp_employer">Company <span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="eexp_employer" id="eexp_employer" />
        </div>
        <div class="form-group">
            <label for="eexp_jobtit">Job Title <span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="eexp_jobtit" id="eexp_jobtit" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="eexp_from_date">From <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="eexp_from_date" id="eexp_from_date" readonly="readonly" />
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="eexp_to_date">To <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="eexp_to_date" id="eexp_to_date" readonly="readonly" />
            </div>
        </div>
        <div class="form-group">
            <label for="eexp_comments">Comment</label>
            <textarea rows="6" class="form-control" type="text" name="eexp_comments" id="eexp_comments"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" id="workDtlSave" value="Save">
        <input type="reset" class="btn btn-danger" id="workDtlCancel" value="Cancel">
    </form>
    <div>
        <h4>Work Experience</h4>
        <table id="data-table-basic" class="table table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Company Name</th>
                <th>Job Level</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @if($quali)
                    <?php $no = 1;?>
                    @foreach($quali as $row)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $row->eexp_employer }}</td>
                        <td>{{ $row->eexp_jobtit }}</td>
                        <td>{{ date_formated($row->eexp_from_date) }}</td>
                        <td>{{ date_formated($row->eexp_to_date) }}</td>
                        <td><a onclick="deleteConfirmation(event,'work')" id="deleteButton1" class="deleteButton1" href="{{ route('personalEmp.deleteWork', $row->id) }}"><i class="fa fa-trash" title="Delete"></i></a></td>
                    </tr>
                        <?php $no++;?>
                    @endforeach
                @else
                    <td colspan="5">No Data</td>
                @endif
            </tbody>
        </table>
        <button id="editDtlWork" class="btn btn-success">Edit</button>
    </div>
</fieldset>
    <fieldset>
        <form id="addTrain" action="{{ route('personalEmp.setTrain') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="idTrainEmp" id="idTrainEmp" />
            <div class="form-group">
                <label for="train_name">Training Name</label>
                <input class="form-control" type="text" name="train_name" id="train_name" />
            </div>
            <div class="form-group">
                <label for="license_no">Sertificate No</label>
                <input class="form-control" type="text" name="license_no" id="license_no" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="license_issued_date">Start Training Date</label>
                    <input class="form-control" type="text" name="license_issued_date" id="license_issued_date" readonly="readonly" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="license_expiry_date">End Training Date</label>
                    <input class="form-control" type="text" name="license_expiry_date" id="license_expiry_date" readonly="readonly" />
                </div>
            </div>
            <input type="submit" class="btn btn-primary" id="trainDtlSave" value="Save">
            <input type="reset" class="btn btn-danger" id="trainDtlCancel" value="Cancel">
        </form>
        <div>
            <h4>Training</h4>
            <table id="data-table-basic" class="table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Training Name</th>
                    <th>Sertificate No</th>
                    <th>Start Training Date</th>
                    <th>End Training Date</th>
                </tr>
                </thead>
                <tbody>
                @if($trains)
                    <?php $no = 1;?>
                    @foreach($trains as $row)
                        <tr>
                            <td>{{ $no }}</td>
                            @if($row->license_id)
                            <td>@if($row->license_id == 1) {{ $row->train_name }} @else {{ $row->trainning->name }} @endif</td>
                            @else
                            <td>{{ $row->train_name }}</td>
                            @endif
                            <td>{{ $row->license_no }}</td>
                            <td>{{ date_formated($row->license_issued_date) }}</td>
                            <td>{{ date_formated($row->license_expiry_date) }}</td>
                            <td><a onclick="deleteConfirmation(event,'training')" id="deleteButton2" class="deleteButton2" href="{{ route('personalEmp.deleteTrain', $row->id) }}"><i class="fa fa-trash" title="Delete"></i></a></td>
                        </tr>
                        <?php $no++;?>
                    @endforeach
                @else
                    <td colspan="5">No Data</td>
                @endif
                </tbody>
            </table>
            <button id="editDtlTrain" class="btn btn-success">Edit</button>
        </div>
    </fieldset>
</div>