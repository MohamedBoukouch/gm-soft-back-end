<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDeplacment;
use Carbon\Carbon;
use App\Models\Tracking;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();

        return view('dashboard.index', ['projects' => $projects]);
    }
    public function getEmployeeStats()
    {
        $totalEmployees = User::count();
        $employeesByRole = User::select('role', DB::raw('count(*) as count'))
                                ->groupBy('role')
                                ->get()
                                ->pluck('count', 'role');

        return response()->json([
            'totalEmployees' => $totalEmployees,
            'employeesByRole' => $employeesByRole,
        ]);
    }

    public function getEmployeesByRole($role)
    {
        $employees = User::where('role', $role)->get(['firstname', 'lastname', 'email']);
        return response()->json([
            'employees' => $employees,
        ]);
    }
    /**
     * API endpoint to get projects.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderStats()
    {
        $pendingOrders = OrderDeplacment::where('is_accepte', 0)->count();
        $acceptedOrders = OrderDeplacment::where('is_accepte', 1)->count();
        $finishedOrders = OrderDeplacment::where('fine_mission', 1)->count();
        $notAcceptedOrders = OrderDeplacment::where('is_accepte', -1)->count();
        $verifiedOrders = OrderDeplacment::where('localisation_verify', 1)->count();

        return response()->json([
            'pendingOrders' => $pendingOrders,
            'acceptedOrders' => $acceptedOrders,
            'finishedOrders' => $finishedOrders,
            'notAcceptedOrders' => $notAcceptedOrders,
            'verifiedOrders' => $verifiedOrders,
        ]);
    }
    public function getProjects()
    {
        $projects = Project::all();

        return response()->json([
            'projects' => $projects,
        ]);
    }

    public function getVacationCounts()
    {
        $pendingCount = Vacation::where('status', 'pending')->count();
        $approvedCount = Vacation::where('status', 'approved')->count();
        $rejectedCount = Vacation::where('status', 'rejected')->count();

        return response()->json([
            'pending' => $pendingCount,
            'approved' => $approvedCount,
            'rejected' => $rejectedCount,
        ]);
    }
    public function getPendingVacationRequests()
    {
        $requests = Vacation::where('status', 'pending')->with('employee')->get();

        return response()->json([
            'requests' => $requests,
        ]);
    }

    public function approveVacationRequest($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->status = 'approved';
        $vacation->save();

        return response()->json(['message' => 'Vacation request approved']);
    }

    public function rejectVacationRequest($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->status = 'rejected';
        $vacation->save();

        return response()->json(['message' => 'Vacation request rejected']);
    }
    
public function getEmployeesByStatus()
    {
        try {
            $currentDate = now()->format('Y-m-d');

            $employees = User::where('role', '!=', 'Derictor')->get();

            $pointed = $employees->filter(function ($employee) use ($currentDate) {
                return Tracking::where('employee_id', $employee->id)
                    ->whereNotNull('start_time')
                    ->whereNull('end_time')
                    ->whereDate('start_time', $currentDate)
                    ->exists();
            });

            $paused = $employees->filter(function ($employee) use ($currentDate) {
                return Tracking::where('employee_id', $employee->id)
                    ->whereNotNull('start_time')
                    ->whereNull('end_time')
                    ->whereNotNull('pause_start_time')
                    ->whereNull('pause_end_time')
                    ->whereDate('pause_start_time', $currentDate)
                    ->exists();
            });

            $finished = $employees->filter(function ($employee) use ($currentDate) {
                return Tracking::where('employee_id', $employee->id)
                    ->whereNotNull('start_time')
                    ->whereNotNull('end_time')
                    ->whereDate('end_time', $currentDate)
                    ->exists();
            });

            $notPointed = $employees->filter(function ($employee) use ($currentDate) {
                return !Tracking::where('employee_id', $employee->id)
                    ->whereDate('created_at', $currentDate)
                    ->exists();
            });

            return response()->json([
                'pointed' => $pointed->values(),
                'paused' => $paused->values(),
                'finished' => $finished->values(),
                'not_pointed' => $notPointed->values(),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching employees by status: ', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching employees by status', 'error' => $e->getMessage()], 500);
        }
    }
}
