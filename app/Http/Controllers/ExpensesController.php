<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expenses::all();

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|string|max:255',
            'date' =>'required|date'
        ]);

        Expenses::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        return view('expenses.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expense)
    {
    // Pass the $expense model instance to the edit view
    return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expense)
    {
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'category' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $expense->update([
        'name' => $request->name,
        'amount' => $request->amount,
        'category' => $request->category,
        'date' => $request->date,
    ]);

    return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
    }
}
