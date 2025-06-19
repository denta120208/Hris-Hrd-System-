<script type="text/javascript">
    $(document).ready(function() {
        $('#addDependents').hide();
        $('#depenDtlSave').hide();
        $('#depenDtlCancel').hide();
        $('.deleteButton').hide();
        $('.editButton').hide();
        $('#ed_date_of_birth').datetimepicker({
            format: 'Y-m-d',
        });
        $('#editDtl').click(function(){
            $('#idEmp').val($('#emp_id').val());
            $('#addDependents').show();
            $('#editDtl').hide();
            $('#depenDtlSave').show();
            $('#depenDtlCancel').show();
            $('.deleteButton').show();
            $('.editButton').show();
        });
        $('#depenDtlCancel').click(function(){
            $('#addDependents').hide();
            $('#editDtl').show();
            $('#depenDtlSave').hide();
            $('#depenDtlCancel').hide();
            $('.deleteButton').hide();
            $('.editButton').hide();
        });
        $('#depenDtlSave').click(function (){
            $('form#addDependents').submit();
        });
    });

    $(document).on("click", ".open-showModalEdit", function() {  
        var id = $(this).data('id');
        var name = $(this).data('name');
        var relation = $(this).data('relation');
        var datebirth = $(this).data('datebirth');
        if(id.toString().length > 0 && name.toString().length > 0 && relation.toString().length > 0 && datebirth.toString().length > 0) {
            $('#idEmp').val($('#emp_id').val());
            $('#idDep').val(id);
            $('#ed_name').val(name);
            $('#ed_relationship').val(relation);
            $('#ed_date_of_birth').val(datebirth);

            $('#addDependents').show();
            $('#editDtl').hide();
            $('#depenDtlSave').show();
            $('#depenDtlCancel').show();
        }
    });
</script>
<?php
function date_formated($date){
    $new_date = date('d-m-Y', strtotime(substr($date, 0, 11)));
    return $new_date;
}
?>
<form id="addDependents" action="{{ route('personalEmp.setDependent') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="idEmp" id="idEmp" />
    <input type="hidden" name="idDep" id="idDep" />
    <div class="form-group">
        <label for="ed_name">Name</label>
        <input class="form-control" type="text" name="ed_name" id="ed_name" />
    </div>
    <div class="form-group">
        <label for="ed_relationship">Relationship</label>
        <select class="form-control" name="ed_relationship" id="ed_relationship">
            <option value="">-= Select =-</option>
            <option value="Spouse">Spouse</option>
            <option value="Child">Child</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ed_date_of_birth">Date Of Birth</label>
        <input class="form-control" type="text" name="ed_date_of_birth" id="ed_date_of_birth" readonly="readonly" />
    </div>
    <input type="submit" class="btn btn-primary" id="depenDtlSave" value="Save">
    <input type="reset" class="btn btn-danger" id="depenDtlCancel" value="Cancel">
</form>
<div class="table-responsive">
    <table id="data-table-basic" class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Relationship</th>
            <th>Date Of Birth</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
            @if($eds)
            <?php $no = 1;?>
                @foreach($eds as $row)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->ed_name }}</td>
                <td>{{ $row->ed_relationship }}</td>
                <td>{{$row->ed_date_of_birth && date_formated($row->ed_date_of_birth) != '01-01-1900' && date_formated($row->ed_date_of_birth) != '01-01-1970' ? date_formated($row->ed_date_of_birth) : '-'}}</td>
                <td><a href="#addDependents" class="open-showModalEdit editButton" data-id="{{ $row->id }}" data-name="{{ $row->ed_name }}" data-relation="{{ $row->ed_relationship }}" data-datebirth="{{ date('Y-m-d', strtotime(date_formated($row->ed_date_of_birth))) }}"><i class="fa fa-edit" title="Edit"></i></a></td>
                <td>
                    <a data-toggle="modal" data-target="#confirm-delete{{ $row->id }}" class="deleteButton"><i class="fa fa-trash" title="Delete"></i></a>
                    <div class="modal fade" id="confirm-delete{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Confirmation Delete Dependents
                                </div>
                                <div class="modal-body">
                                    <h1>Are you sure want to delete this dependents?</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger btn-ok" href="{{ route('personalEmp.delDependent', $row->id) }}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <?php $no++;?>
            </tr>
                @endforeach
            @else
            <tr><td colspan="4">No Dependents</td></tr>
            @endif
        </tbody>
    </table>
    <button class="btn btn-success" id="editDtl">Edit</button>
</div>