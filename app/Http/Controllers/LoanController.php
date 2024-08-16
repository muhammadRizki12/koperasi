<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use DateTime;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    
    public function index()
    {
        // get user id
        $userId = Auth::id();

        // get user data
        $members = User::where('role', 'nasabah')->get();

        // Get all savings data in a single query
        $loans = Loan::orderByDesc('id')->get();

        // gets angsuran
        $installments = Installment::all(); 

        return view('loans.index', compact('loans', 'members', 'installments'));
    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        $loan = Loan::create([
            'user_id' => $request->user_id,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'monthly_installment' => $request->monthly_installment,
            'loan_date' => now(),
        ]);
        
        $currentDate = Carbon::now();

        for ($i=1; $i <= $request->monthly_installment; $i++) {             
            
            $nextMonth = $currentDate->addMonth();

            $installment = Installment::create([
                'loan_id' => $loan->id,
                'installment' => $i,
                'amount' => $request->amount / $request->monthly_installment,
                'installment_date' => $nextMonth,
                'status' => 'belum lunas'
            ]);

           $installment->save();
        }

        if($loan->save()){
            return redirect()->route('loan.index');
        } else {
            dd('Data gagal Disimpan');
        }
    }

    
    public function show($id)
    {
        // Get all savings data in a single query
        $loans = Loan::where('user_id', $id)->get();

        // gets angsuran
        $installments = Installment::all(); 

        return view('loans.show', compact('loans', 'installments'));        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
