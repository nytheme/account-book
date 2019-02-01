<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
//use App\Budget;

class EditController extends Controller
{
    public function index()
    {
        $users = User::where('id',\Auth::user()->id)->get();
        
        $data = [
            'users' => $users,
            //'budgets' => $budgets
        ];
        
        return view('edit', $data);
    }
    
    /*public function store(Request $request)
    {
        $this->validate($request, [
            'budget' => 'required|max:50',
        ]);
        
        $budgets = new Budget;
        $budgets->user_id = $request->user_id;
        $budgets->budget = $request->budget;
        $budgets->day = $request->day;
        $budgets->save();

        return redirect()->back();
    }*/
    
    public function edit(Request $request, $id) {
        $users = User::find($id);
        return view('edit', ['users' => $users]);
    }
    
    public function update(Request $request, $id) {

        $users = User::find($id);
        $users->name = $request->name;
        $users->budget = $request->budget;
       
        $users->save();
 
        return redirect('show_exp');
    }
}
