<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{

    public function proof_balance() {

        $currency = Currency::where('id', auth()->user()->currency_id)->first();
        $query = DB::select('SELECT 
                                   CASE 
                                        WHEN type=1 THEN "income"
                                        ELSE "expense"
                                   END AS cashflow,
                                    SUM(amount) AS amount
                            FROM cashflows 
                            WHERE active=1 AND user_id=?
                            GROUP BY type
                            ORDER BY cashflow', [Auth::id()]);
        $diff = 0;
        
        if (sizeof($query) == 2) {
            $diff = number_format($query[1]->amount-$query[0]->amount, 2, '.', ' ');
        } else if (sizeof($query) == 1) {
            $diff = number_format($query[0]->amount, 2, '.', ' ');
        }

        $balance = $diff . ' ' . $currency->name;

        session()->forget('balance');
        session()->put('balance', $balance);
    }

    // Cash flow категории
    public function cashflow_categories(Request $request)
    {
        $categories = Category::where('type', $request->type)->get();
        
        echo '<label for="category">Категории</label>
        <select id="category" class="form-control" name="category_id">';
            foreach($categories as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        echo '</select>';
    }
}
