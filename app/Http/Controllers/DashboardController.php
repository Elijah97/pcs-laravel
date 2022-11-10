<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $all_applications = DB::select(
            DB::raw(
                "SELECT *
                 FROM applications"
            )
        );

        $reviewed_applications = DB::select(
            DB::raw(
                "SELECT *
                 FROM applications
                 WHERE reviewStatus = 1
                 "
            )
        );

        $approved_applications = DB::select(
            DB::raw(
                "SELECT *
                 FROM applications
                 WHERE approveStatus = 1
                 AND reviewStatus = 1
                 "
            )
        );

        $revoked_applications = DB::select(
            DB::raw(
                "SELECT *
                 FROM applications
                 WHERE approveStatus = 2
                 "
            )
        );

        $pending_applications = DB::select(
            DB::raw(
                "SELECT *
                 FROM applications
                 WHERE reviewStatus = 0
                 "
            )
        );
        $current_date = date('Y-m-d');
        $current_budget = DB::select(
            DB::raw(
                "SELECT *
                 FROM budgets
                 WHERE '$current_date' BETWEEN dateFrom and dateTo 
                 "
            )
        );

        $total_users = DB::select(
            DB::raw(
                "SELECT *
                 FROM users 
                 "
            )
        );

        $total_categories = DB::select(
            DB::raw(
                "SELECT *
                 FROM categories 
                 "
            )
        );

        // return $current_budget;
        return view(
            'dashboard.analytics',
            [
                'all_applications' => $all_applications,
                'reviewed_applications' => $reviewed_applications,
                'approved_applications' => $approved_applications,
                'revoked_applications' => $revoked_applications,
                'pending_applications' => $pending_applications,
                'current_budget' => $current_budget,
                'total_users' => $total_users,
                'total_categories' => $total_categories,
            ]
        );
    }
}
