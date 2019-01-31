<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Budget;

class EditController extends Controller
{
    public function index()
    {
        $users = User::all();
        $budgets = Budget::where('user_id',\Auth::user()->id)->get();
        
        $data = [
            'users' => $users,
            'budgets' => $budgets
        ];
        
        return view('edit_bud', $data);
    }
    
    public function edit(Request $request, $id) {
        $budgets = Budget::find($id);
        return view('edit_bud', ['budgets' => $budgets]);
    }
    
    public function update(Request $request, $id) {

        $budgets = Budget::find($id);
        $budgets->user_id = $request->user_id;
        $budgets->budget = $request->budget;
        $budgets->day = $request->day;
        $budgets->save();
 
        return redirect('show_exp');
    }
}
