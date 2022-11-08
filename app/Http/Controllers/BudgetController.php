<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $budgets = DB::table('budgets')
            ->select('budgets.*')
            ->orderBy('budgets.id', 'ASC')
            ->get();
        return view('dashboard.budget.budget', ['budgets' => $budgets, 'index' => $index]);
    }

    public function addBudget(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'dateFrom' => 'required',
            'dateTo' => 'required',
            'amount' => 'required',
            'description' => 'required|max:255',
        );

        $validator = $request->validate($rules); {
            if (!$validator) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $budget = new Budget;
                $budget->name = $request->input('name');
                $budget->dateFrom = $request->input('dateFrom');
                $budget->dateTo = $request->input('dateTo');
                $budget->amount = $request->input('amount');
                $budget->description = $request->input('description');
                $budget->status = 1;
                $budget->save();

                return Redirect::back()->with('success', 'Budget created successfully.');
            }
        }
    }

    public function viewDetails(Request $request, $id)
    {
        $budget = Budget::find($id);

        if ($request->ajax()) {
            return response()->json([
                'data' => $budget
            ]);
        }

        return view('dashboard.budget.edit', [
            'budget' => $budget
        ]);
    }

    public function updateBudget(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $amount = $request->input('amount');
        $description = $request->input('description');

        $update = Budget::where('id', $id)->update(
            array(
                'name' => $name,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'amount' => $amount,
                'description' => $description,
            )
        );

        if ($update) {
            return redirect()->back()->with('success', 'Category successfully update');
        }
    }

    public function suspend($id)
    {
        $pend = DB::update("UPDATE budgets SET status = 0 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'Budget successfully suspended');
        }
    }

    public function activate($id)
    {
        $pend = DB::update("UPDATE budgets SET status = 1 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'Budget successfully activated');
        }
    }

    public function delete($id)
    {
        $delete = DB::delete("DELETE FROM budgets WHERE id = '$id'");
        if ($delete) {
            return redirect()->back()->with('success', 'Budget successfully deleted');
        }
    }
}
