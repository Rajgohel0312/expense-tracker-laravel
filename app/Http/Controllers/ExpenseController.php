<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Income;
use Crypt;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function showExpense()
    {

        $expenses = Expenses::with('categories:id,category_name')->get();
        $expenseTotal = Income::sum('incomeAmount') - Expenses::sum('amount');
        return view('expenses.index', ['expenses' => $expenses, 'totalCount' => $expenseTotal]);
    }
    public function addExpenses()
    {
        return view('expenses.add');
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|integer',  // Add validation for category_id

            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        $expense = new Expenses;
        $expense->amount = $validated['amount'];
        $expense->category_id = $validated['category'];

        $expense->description = $validated['description'];
        $expense->date = $validated['date'];

        $expense->save();

        return back()->withSuccess('Expense Create Succefully');
    }
    public function addIncome()
    {
        return view('expenses.addIncome');
    }

    public function createIncome(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',


        ]);
        $income = new Income;
        $income->incomeAmount = $validated['amount'];
        $income->save();

        return back()->withSuccess('Income Create Succefully');
    }
    public function edit($encryptedId)
    {
        $decodedId = base64_decode($encryptedId);
        $expenseId = Crypt::decrypt($decodedId);

        $expenses = Expenses::findOrFail($expenseId);
        return view('expenses.edit', ['expenses' => $expenses]);
    }
    public function delete($hashed_id)
    {
        try {
            $id = Crypt::decryptString($hashed_id);
            $expense = Expenses::findOrFail($id);
            $expense->delete();

            return back()->withSuccess('Expense deleted successfully!');
        } catch (\Exception $e) {
            // If the decryption fails or other error happens
            return redirect()->back()->with('error', 'Invalid request.');
        }
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'category' => 'required|integer',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // Find the expense record
        $expenses = Expenses::findOrFail($id);

        // Update the expense
        $expenses->category_id = $request->category;
        $expenses->amount = $request->amount;
        $expenses->description = $request->description;
        $expenses->date = $request->date;

        // Save the changes
        $expenses->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Expense updated successfully!');
    }
}
