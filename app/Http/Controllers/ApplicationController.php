<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->orderBy('categories.id', 'ASC')
            ->get();
        return view('dashboard.application.apply', ['categories' => $categories]);
    }


    public function addApplication(Request $request)
    {

        $rules = array(
            'categoryId' => 'required',
            'project' => 'required',
            'details' => 'required|max:255',
            // 'item[0]' => 'required',
            // 'desc[0]' => 'required',
            // 'qty[0]' => 'required',
            // 'unitPrice[0]' => 'required',
            // 'totalPrice[0]' => 'required',
        );
        $validator = $request->validate($rules); {
            if (!$validator) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $categoryId = $request->input('categoryId');
                $project = $request->input('project'); 
                $details = $request->input('details'); 
                $uniqueId = Str::upper(Str::random(16));


                for($i = 0; $i < count($request->item); $i++){
                    $app = new Application;
                    $app->categoryId = $categoryId;
                    $app->project = $project;
                    $app->details = $details;
                    $app->uniqueId = $uniqueId;
                    $app->item = $request->input('item')[$i];
                    $app->desc = $request->input('desc')[$i];
                    $app->qty = $request->input('qty')[$i];
                    $app->unitPrice = $request->input('unitPrice')[$i];
                    $app->totalPrice = $request->input('totalPrice')[$i];
                    $app->ApplicantId = Auth::user()->id;
                    $app->reviewStatus = 0;
                    $app->approveStatus = 0;
                    $app->save();
                }

                return Redirect::back()->with('success', 'Application sent');
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applications()
    {
        $index = 1;
        if (Auth::user()->type == 0 ||  Auth::user()->type == 99) {
            $applications = DB::select(
                DB::raw(
                    "
            SELECT
                applications.id,
                applications.project,
                applicant.rank,
                applicant.names,
                applicant.phone,
                applicant.department,
                applications.project,
                categories.name as categoryName,
                applications.created_at,
                applications.qty,
                applications.totalPrice,
                applications.reviewStatus,
                applications.reviewerId,
                reviewer.rank as reviewerRank,
                reviewer.names as reviewerName,
                applications.approveStatus,
                applications.approverId,
                approver.rank as approverRank,
                approver.names as approverName
    
            FROM applications 
            JOIN categories
            ON categories.id = applications.categoryId
            JOIN users applicant
            ON applicant.id = applications.applicantId
            LEFT JOIN users reviewer
            ON reviewer.id = applications.reviewerId
            LEFT JOIN users approver
            ON approver.id = applications.approverId  
            "
                )
            );
        } elseif (Auth::user()->type == 1) {
            $dept = Auth::user()->department;
            $applications = DB::select(
                DB::raw(
                    "
            SELECT
                applications.id,
                applications.title,
                applicant.rank,
                applicant.names,
                applicant.phone,
                applicant.department,
                applications.title,
                categories.name as categoryName,
                applications.created_at,
                applications.qty,
                applications.totalPrice,
                applications.neededBy,
                applications.reviewStatus,
                applications.reviewerId,
                reviewer.rank as reviewerRank,
                reviewer.names as reviewerName,
                applications.approveStatus,
                applications.approverId,
                approver.rank as approverRank,
                approver.names as approverName
    
            FROM applications 
            JOIN categories
            ON categories.id = applications.categoryId
            JOIN users applicant
            ON applicant.id = applications.applicantId
            LEFT JOIN users reviewer
            ON reviewer.id = applications.reviewerId
            LEFT JOIN users approver
            ON approver.id = applications.approverId
            WHERE applicant.department = '$dept'   
            "
                )
            );
        } else {
            $id = Auth::user()->id;
            $applications = DB::select(
                DB::raw(
                    "
            SELECT
                applications.id,
                applications.title,
                applicant.rank,
                applicant.names,
                applicant.phone,
                applicant.department,
                applications.title,
                categories.name as categoryName,
                applications.created_at,
                applications.qty,
                applications.totalPrice,
                applications.neededBy,
                applications.reviewStatus,
                applications.reviewerId,
                reviewer.rank as reviewerRank,
                reviewer.names as reviewerName,
                applications.approveStatus,
                applications.approverId,
                approver.rank as approverRank,
                approver.names as approverName
    
            FROM applications 
            JOIN categories
            ON categories.id = applications.categoryId
            JOIN users applicant
            ON applicant.id = applications.applicantId
            LEFT JOIN users reviewer
            ON reviewer.id = applications.reviewerId
            LEFT JOIN users approver
            ON approver.id = applications.approverId
            WHERE applications.applicantId = $id  
            "
                )
            );
        }


        return view('dashboard.application.applications', ['applications' => $applications, 'index' => $index]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $application = DB::select(
            DB::raw(
                "
        SELECT
            applications.id,
            applications.title,
            applicant.rank,
            applicant.names,
            applicant.phone,
            applicant.department,
            applications.title,
            categories.name as categoryName,
            applications.reason,
            applications.created_at,
            applications.qty,
            applications.totalPrice,
            applications.neededBy,
            applications.reviewStatus,
            applications.reviewerId,
            applications.reviewedDate,
            reviewer.rank as reviewerRank,
            reviewer.names as reviewerName,
            applications.approveStatus,
            applications.approverId,
            applications.approvedDate,
            approver.rank as approverRank,
            approver.names as approverName

        FROM applications JOIN categories
        ON categories.id = applications.categoryId
        JOIN users applicant
        ON applicant.id = applications.applicantId
        LEFT JOIN users reviewer
        ON reviewer.id = applications.reviewerId
        LEFT JOIN users approver
        ON approver.id = applications.approverId
        WHERE applications.id = $id
        "
            )
        );
        return view('dashboard.application.application', ['application' => $application]);
    }

    public function changeReviewStatus(Request $request)
    {
        $id = $request->input('applicationId');
        $reviewStatus = $request->input('reviewStatus');
        $reviewedDate = date('Y-m-d');

        if ($reviewStatus == 0) {
            $reviewerId = null;
            $reviewedDate = null;
        } else {
            $reviewerId = $request->input('reviewerId');
            $reviewedDate = date('Y-m-d');
        }

        $update = Application::where('id', $id)->update(
            array(
                'reviewerId' => $reviewerId,
                'reviewStatus' => $reviewStatus,
                'reviewedDate' => $reviewedDate,
            )
        );

        if ($update) {
            return redirect()->back()->with('success', 'Application successfull reviewed ');
        }
        return $request;
    }

    public function changeApproveStatus(Request $request)
    {
        $id = $request->input('applicationId');
        $approveStatus = $request->input('approveStatus');
        $approvedDate = date('Y-m-d');
        $requestedAmount = $request->input('requestedAmount');
        $dateExpected = $request->input('dateExpected');

        $budget = DB::select(
            DB::raw(
                "
        SELECT
        *
        FROM budgets 
        WHERE '$dateExpected' BETWEEN dateFrom and dateTo  
        "
            )
        );

        if ($approveStatus == 1) {
            $approverId = $request->input('approverId');
            if ($requestedAmount > $budget[0]->amount) {
                return redirect()->back()->with('warning', 'Requested amount can not be higher than the budget ');
            } else {
                $remaining = $budget[0]->amount - $requestedAmount;
                $expenses = $budget[0]->expenses + $requestedAmount;
                $updateBudget = Budget::where('id', $budget[0]->id)->update(
                    array(
                        'amount' => $remaining,
                        'expenses' => $expenses,
                    )
                );
            }
        } elseif ($approveStatus == 0) {
            $approverId = null;
        } else {
            $approverId = $request->input('approverId');
        }

        $update = Application::where('id', $id)->update(
            array(
                'approverId' => $approverId,
                'approveStatus' => $approveStatus,
                'approvedDate' => $approvedDate,
            )
        );

        if ($update) {
            if ($approveStatus == 0) {
                return redirect()->back()->with('warning', 'Application still pending.. ');
            } elseif ($approveStatus == 1) {
                return redirect()->back()->with('success', 'Application successfull Approved. ');
            } else {
                return redirect()->back()->with('error', 'Application revoked ');
            }
        }
    }
    public function createPDF(Request $request)
    {

        $from = $request->input('downloadFrom');
        $to = $request->input('downloadTo');
        if ($from != '' && $to != '') {
            if (Auth::user()->type == 0 ||  Auth::user()->type == 99) {
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId  
                WHERE applications.created_at BETWEEN '$from' AND '$to'
                "
                    )
                );
            } elseif (Auth::user()->type == 1) {
                $dept = Auth::user()->department;
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId
                WHERE applicant.department = '$dept'
                AND applications.created_at BETWEEN '$from' AND '$to'   
                "
                    )
                );
            } else {
                $id = Auth::user()->id;
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId
                WHERE applications.applicantId = $id  
                AND applications.created_at BETWEEN '$from' AND '$to'
                "
                    )
                );
            }
        } else {
            if (Auth::user()->type == 0 ||  Auth::user()->type == 99) {
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId  
                "
                    )
                );
            } elseif (Auth::user()->type == 1) {
                $dept = Auth::user()->department;
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId
                WHERE applicant.department = '$dept'   
                "
                    )
                );
            } else {
                $id = Auth::user()->id;
                $applications = DB::select(
                    DB::raw(
                        "
                SELECT
                    applications.id,
                    applications.title,
                    applicant.rank,
                    applicant.names,
                    applicant.phone,
                    applicant.department,
                    applications.title,
                    categories.name as categoryName,
                    applications.created_at,
                    applications.qty,
                    applications.totalPrice,
                    applications.neededBy,
                    applications.reviewStatus,
                    applications.reviewerId,
                    reviewer.rank as reviewerRank,
                    reviewer.names as reviewerName,
                    applications.approveStatus,
                    applications.approverId,
                    approver.rank as approverRank,
                    approver.names as approverName
        
                FROM applications 
                JOIN categories
                ON categories.id = applications.categoryId
                JOIN users applicant
                ON applicant.id = applications.applicantId
                LEFT JOIN users reviewer
                ON reviewer.id = applications.reviewerId
                LEFT JOIN users approver
                ON approver.id = applications.approverId
                WHERE applications.applicantId = $id  
                "
                    )
                );
            }
        }

        // return view('dashboard.application.reports.all', ['applications' => $applications]);
        view()->share('applications', $applications);
        $pdf = PDF::loadView('dashboard.application.reports.all', array($applications))->setPaper('a4', 'landscape')->setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $name = "Report";
        $date = date('r');
        return $pdf->download($name . '-' . $date . '.pdf');
    }

    public function createSinglePDF($id)
    {
        $application = DB::select(
            DB::raw(
                "
        SELECT
            applications.id,
            applications.title,
            applicant.rank,
            applicant.names,
            applicant.phone,
            applicant.department,
            applicant.serv_no,
            applicant.function,
            applicant.unit,
            applications.title,
            categories.name as categoryName,
            applications.created_at,
            applications.qty,
            applications.totalPrice,
            applications.reason,
            applications.neededBy,
            applications.reviewStatus,
            applications.reviewerId,
            applications.reviewedDate,
            reviewer.rank as reviewerRank,
            reviewer.names as reviewerName,
            applications.approveStatus,
            applications.approverId,
            applications.approvedDate,
            approver.rank as approverRank,
            approver.names as approverName

        FROM applications 
        JOIN categories
        ON categories.id = applications.categoryId
        JOIN users applicant
        ON applicant.id = applications.applicantId
        LEFT JOIN users reviewer
        ON reviewer.id = applications.reviewerId
        LEFT JOIN users approver
        ON approver.id = applications.approverId
        WHERE applications.id = $id  
        "
            )
        );

        // return view('dashboard.application.reports.single', ['application' => $application]);
        view()->share('application', $application);
        $pdf = PDF::loadView('dashboard.application.reports.single', array($application))->setPaper('a4', 'landscape')->setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $name = "Report";
        $date = date('r');
        return $pdf->download($application[0]->names . '-' . $date . '.pdf');
    }
}
