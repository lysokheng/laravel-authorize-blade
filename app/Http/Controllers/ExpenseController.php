<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::has('expenseType')->paginate(10);
        return view('expenses.index')->with('expenses', $expenses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenseTypes = ExpenseType::pluck('title', 'id');
        return view('expenses.create')->with('expenseTypes', $expenseTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Expense::create($request->all());
        return redirect()->route('expenses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $this->authorize('updateExpense', $expense);
        return view('expenses.edit')->with('expense', $expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->title = $request->get('title');
        $expense->expense_date = $request->get('expense_date');
        $expense->amount = $request->get('amount');
        $expense->description = $request->get('description');
        $expense->save();
        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index');
    }
}
