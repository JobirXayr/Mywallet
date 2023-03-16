<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashflow;
use App\Models\Category;
use App\Http\Requests\CashflowRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CashflowController extends ActionController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income_categories = Category::where('type', 1)->get();
        $expense_categories = Category::where('type', -1)->get();
        $incomes = DB::select('SELECT a.id,
                                      a.amount,
                                      a.note,
                                      b.name category,
                                      c.name currency,
                                      a.created_at
                               FROM cashflows a, categories b, currencies c
                               INNER JOIN users d ON c.id=d.currency_id
                               WHERE a.type=1 AND
                                     a.active=1 AND
                                     a.category_id=b.id AND
                                     a.user_id=?
                               ORDER BY a.created_at DESC', [Auth::id()]);
        $expenses = DB::select('SELECT a.id,
                                       a.amount,
                                       a.note,
                                       b.name category,
                                       c.name currency,
                                       a.created_at
                                FROM cashflows a, categories b, currencies c
                                INNER JOIN users d ON c.id=d.currency_id
                                WHERE a.type=-1 AND
                                      a.active=1 AND
                                      a.category_id=b.id AND
                                      a.user_id=?
                                ORDER BY a.created_at DESC', [Auth::id()]);

        return view('cashflow.index', compact('income_categories', 'expense_categories', 'incomes', 'expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('cashflow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashflowRequest $request)
    {
        Cashflow::create([
            'user_id'     => auth()->user()->id,
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'type'        => $request->type,
            'note'        => $request->note
        ]);

        $this->proof_balance();
        return redirect()->route('cashflows.index')->with('message', 'Cash flow успешно создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cashflow $cashflow)
    {
        $categories = Category::where('type', $cashflow->type)->get();

        return view('cashflow.edit', compact('cashflow', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CashflowRequest $request, $id)
    {
        Cashflow::where('id', $id)->update([
            'amount'      => $request->amount,
            'type'        => $request->type,
            'category_id' => $request->category_id,
            'note'        => $request->note
        ]);

        $this->proof_balance();

        return redirect()->route('cashflows.index')->with('message', 'Cash flow успешно сохранен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cashflow::where('id', $id)->update([
            'active' => 0
        ]);

        $this->proof_balance();

        return redirect()->route('cashflows.index')->with('message', 'Cash flow удален.');
    }
}
