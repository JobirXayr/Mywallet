<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $year = date('Y');
        $month = date('m');

        $cashflow = DB::select('SELECT 
                                       CASE 
                                            WHEN type=1 THEN "income"
                                            ELSE "expense"
                                       END AS cashflow,
                                       SUM(amount) AS amount,
                                       MONTH(created_at) AS month
                                FROM cashflows 
                                WHERE active=1 AND
                                      YEAR(created_at)=? AND
                                      user_id=?
                                GROUP BY type, MONTH(created_at)
                                ORDER BY cashflow, MONTH (created_at)
                                ', [ $year, Auth::id() ]);

        if ($request->parameter == 30) {
            $statement = DB::select('SELECT SUM(a.amount) AS amount,
                                           b.name category,
                                           CASE 
                                                WHEN a.type=1 THEN "income"
                                                ELSE "expense"
                                           END AS cashflow
                                    FROM cashflows a
                                    INNER JOIN categories b ON b.id=a.category_id
                                    WHERE a.active=1 AND
                                          YEAR(a.created_at)=? AND
                                          MONTH(a.created_at)=? AND
                                          a.user_id=?
                                    GROUP BY a.type, a.category_id
                                    ORDER BY a.type
                                    ', [ $year, $month, Auth::id() ]);
        } else if ($request->parameter == 365) {
            $statement = DB::select('SELECT SUM(a.amount) AS amount,
                                           b.name category,
                                           CASE 
                                                WHEN a.type=1 THEN "income"
                                                ELSE "expense"
                                           END AS cashflow
                                    FROM cashflows a
                                    INNER JOIN categories b ON b.id=a.category_id
                                    WHERE a.active=1 AND
                                          YEAR(a.created_at)=? AND
                                          a.user_id=?
                                    GROUP BY a.type, a.category_id
                                    ORDER BY a.type
                                    ', [ $year, Auth::id() ]);
        } else {
            $statement = DB::select('SELECT SUM(a.amount) AS amount,
                                           b.name category,
                                           CASE 
                                                WHEN a.type=1 THEN "income"
                                                ELSE "expense"
                                           END AS cashflow
                                    FROM cashflows a
                                    INNER JOIN categories b ON b.id=a.category_id
                                    WHERE a.active=1 AND
                                          a.created_at >= DATE(NOW() - INTERVAL 7 DAY) AND
                                          a.user_id=?
                                    GROUP BY a.type, a.category_id
                                    ORDER BY a.type
                                    ', [ Auth::id() ]);
        }
        
        return response()->json(['cashflow' => $cashflow, 'statement' => $statement]);
    }
}
