@extends('_main_layout')

@section('title', 'Terminate Report')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb"></ul>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="header smaller lighter blue">Laporan Karyawan Terminate</h3>
                    
                    <!-- Filter -->
                    <div class="well">
                        <form method="GET" action="{{ route('report_emp_terminate') }}" id="filterForm">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="start_date" class="form-control" value="{{ isset($startDate) ? $startDate : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" name="end_date" class="form-control" value="{{ isset($endDate) ? $endDate : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Project</label>
                                        <select name="project_id" class="form-control select2">
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
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Data -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Data Karyawan Terminate</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Department</th>
                                            <th>Tanggal Terminate</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($arr) && count($arr) > 0)
                                            @foreach($arr as $key => $employee)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $employee->nik }}</td>
                                                    <td>{{ $employee->emp_fullname }}</td>
                                                    <td>{{ isset($employee->dept) ? $employee->dept : '-' }}</td>
                                                    <td>{{ isset($employee->termination_date) ? date('d-m-Y', strtotime($employee->termination_date)) : '-' }}</td>
                                                    <td>{{ isset($employee->reason) ? $employee->reason : '-' }}</td>
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
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.well {
    margin-bottom: 20px;
    padding: 20px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    font-weight: 600;
    margin-bottom: 8px;
}
.panel {
    margin-top: 20px;
}
.panel-heading {
    padding: 12px 15px;
}
.table {
    margin-bottom: 0;
}
.table th {
    background: #f8f9fa;
    font-weight: 600;
    padding: 8px !important;
}
.table > thead > tr > th,
.table > tbody > tr > td {
    padding: 6px 8px !important;
    vertical-align: middle;
    line-height: 1.2;
}
.table-hover > tbody > tr:hover {
    background-color: #f5f5f5;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Pilih Project",
        allowClear: true,
        width: '100%'
    });

    $('#filterForm').on('submit', function(e) {
        var startDate = $('input[name="start_date"]').val();
        var endDate = $('input[name="end_date"]').val();
        
        if (!startDate || !endDate) {
            e.preventDefault();
            swal({
                title: "Peringatan",
                text: "Mohon isi tanggal mulai dan tanggal akhir",
                type: "warning"
            });
        }
    });
});
</script>
@endpush

@endsection