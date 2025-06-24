<?php

namespace App\Http\Controllers\HRD\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JoinTerminateController extends Controller
{
    public function reportjointerminate(Request $request)
    {
        // Get projects for dropdown
        $projects = DB::table('location')
                     ->select('id', 'name')
                     ->where('ID_COMPANY_INT', 0)
                     ->get();

        // Initialize variables
        $joinedEmployees = collect();
        $terminatedEmployees = collect();
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $projectId = $request->get('project_id');

        if ($startDate && $endDate) {
            // Query for joined employees
            $joinedEmployees = DB::table('employee')
                ->select(
                    'e.emp_number as nik',
                    'e.emp_firstname as name',
                    DB::raw("COALESCE(e.emp_middle_name, '') + ' ' + e.emp_lastname as full_name"),
                    'e.joined_date as join_date',
                    'md.name as project_name',
                    'd.name as dept',
                    'u.name as unit'
                )
                ->leftJoin('MD_COMPANY as md', 'e.location_id', '=', 'md.id')
                ->leftJoin('department as d', 'e.department_id', '=', 'd.id')
                ->leftJoin('unit as u', 'e.unit_id', '=', 'u.id')
                ->whereBetween('e.joined_date', [$startDate, $endDate]);

            // Query for terminated employees
            $terminatedEmployees = DB::table('emp_termination')
                ->select(
                    'e.emp_number as nik',
                    'e.emp_firstname as name',
                    DB::raw("COALESCE(e.emp_middle_name, '') + ' ' + e.emp_lastname as full_name"),
                    'e.joined_date as join_date',
                    'et.termination_date as end_date',
                    'md.name as project_name',
                    'd.name as dept',
                    'u.name as unit',
                    'et.reason',
                    'et.note'
                )
                ->leftJoin('MD_COMPANY as md', 'e.location_id', '=', 'md.id')
                ->leftJoin('department as d', 'e.department_id', '=', 'd.id')
                ->leftJoin('unit as u', 'e.unit_id', '=', 'u.id')
                ->join('emp_termination as et', 'e.emp_number', '=', 'et.emp_number')
                ->whereBetween('et.termination_date', [$startDate, $endDate]);

            // Filter by project if selected
            if ($projectId) {
                $joinedEmployees->where('e.location_id', $projectId);
                $terminatedEmployees->where('e.location_id', $projectId);
            }

            $joinedEmployees = $joinedEmployees->get();
            $terminatedEmployees = $terminatedEmployees->get();
        }

        return view('pages.manage.reports.komposisi_emp.join_terminate', compact(
            'projects',
            'joinedEmployees',
            'terminatedEmployees',
            'startDate',
            'endDate',
            'projectId'
        ));
    }
} 