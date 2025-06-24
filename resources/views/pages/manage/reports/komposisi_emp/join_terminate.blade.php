@extends('_main_layout')

@section('title', 'Join & Terminate Report')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
               
            </ul>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="header smaller lighter blue">Join & Terminate Report</h3>
                    
                    <!-- Filter Form -->
                    <div class="well well-sm">
                        <form method="GET" action="{{ route('report_emp_join_terminate') }}" id="filterForm">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div class="input-group">
                                            <input type="date" name="start_date" class="form-control input-sm" value="{{ isset($startDate) ? $startDate : '' }}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div class="input-group">
                                            <input type="date" name="end_date" class="form-control input-sm" value="{{ isset($endDate) ? $endDate : '' }}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Project</label>
                                        <select name="project_id" class="form-control input-sm select2">
                                            <option value="">--Pilih Project--</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" {{ (isset($projectId) && $projectId == $project->id) ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Join Report -->
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Data Karyawan Join</h4>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Department</th>
                                                <th>Join Date</th>  
                                                <th>Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($joinedEmployees) && count($joinedEmployees) > 0)
                                                @foreach($joinedEmployees as $key => $employee)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $employee->nik }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td>{{ $employee->dept }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($employee->join_date)) }}</td>
                                                        <td>{{ $employee->unit }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terminate Report -->
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Data Karyawan Terminate</h4>
                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Department</th>
                                                <th>Join Date</th>
                                                <th>End Date</th>
                                                <th>Unit</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($terminatedEmployees) && count($terminatedEmployees) > 0)
                                                @foreach($terminatedEmployees as $key => $employee)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $employee->nik }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td>{{ $employee->dept }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($employee->join_date)) }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($employee->end_date)) }}</td>
                                                        <td>{{ $employee->unit }}</td>
                                                        <td>{{ $employee->reason }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        placeholder: "Pilih Project",
        allowClear: true,
        width: '100%'
    });

    // Submit form when project is selected
    $('.select2').on('change', function() {
        if (validateDates()) {
            $('#filterForm').submit();
        }
    });

    // Validate dates before submitting
    $('#filterForm').on('submit', function(e) {
        if (!validateDates()) {
            e.preventDefault();
            swal({
                title: "Peringatan",
                text: "Mohon isi tanggal mulai dan tanggal akhir terlebih dahulu",
                type: "warning"
            });
            return false;
        }
        return true;
    });

    function validateDates() {
        var startDate = $('input[name="start_date"]').val();
        var endDate = $('input[name="end_date"]').val();
        return startDate && endDate;
    }

    // Initialize collapse/expand functionality
    $('[data-action="collapse"]').on('click', function(e) {
        e.preventDefault();
        var $box = $(this).closest('.widget-box');
        var $body = $box.find('.widget-body');
        var $icon = $(this).find('[class*="fa-"]');
        
        $body.slideToggle(200);
        $icon.toggleClass('fa-chevron-up fa-chevron-down');
    });
});
</script>
@endpush

@push('styles')
<style>
.well {
    margin-bottom: 20px;
    background-color: #f5f5f5;
    padding: 15px;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}
.input-group-addon {
    border: 1px solid #ccc;
    background-color: #fff;
}
.btn {
    margin-top: 25px;
}
.widget-box {
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.widget-header {
    background: #f7f7f7;
    padding: 8px 15px;
    border-bottom: 1px solid #ddd;
    border-radius: 4px 4px 0 0;
}
.widget-title {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}
.widget-toolbar {
    float: right;
}
.table thead th {
    background: #f7f7f7;
    font-weight: 600;
}
.select2-container .select2-selection--single {
    height: 30px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important;
}
.header.smaller {
    font-size: 24px;
    margin: 0 0 20px;
}
</style>
@endpush

@endsection