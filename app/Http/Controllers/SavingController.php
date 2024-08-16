<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    
    public function index()
    {
        // get user id
        $userId = Auth::id();

        // Gets user
        $members = User::where('role', 'nasabah')->get();

        // Get all savings data in a single query
        $savings = Saving::orderByDesc('id')->get();

        // Calculate total deposit and withdrawal amounts directly
        // $total_incoming_cash = $savings->where('description', 'simpan')->sum('amount');
        // $total_cash_out = $savings->where('description', 'tarik')->sum('amount');
        $total_principal_savings = $savings->where('description', 'simpanan pokok')->sum('amount'); 
        $total_mandatory_savings = $savings->where('description', 'simpanan wajib')->sum('amount'); 

        $total_withdraws = $savings->where('description', 'tarik tunai')->sum('amount'); 

        $total_voluntary_savings = $savings->where('description', 'simpanan sukarela')->sum('amount') - $total_withdraws; 

        // Calculate total amount (kas masuk - kas keluar)
        $total_amount = $total_principal_savings + $total_mandatory_savings + $total_voluntary_savings;

        return view('savings.index', compact('savings', 'total_amount', 'members', 'total_principal_savings', 'total_mandatory_savings', 'total_voluntary_savings'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        // $userId = Auth::id();

        // jika penarikan tunai
        if($request->description == 'tarik tunai') {
            $saving_voluntary_member = Saving::where('description', 'simpanan sukarela')
                        ->where('user_id', $request->user_id) 
                        ->sum('amount');
            
            // jika simpanan sukarela > 0
            if($saving_voluntary_member == 0 || $saving_voluntary_member < $request->amount) {
                session()->flash('status', [
                    'message' => 'Gagal melakukan transaksi', 
                    'type' => 'danger' 
                ]);
                return redirect()->route('saving.index');
            }
        }

        $saving = Saving::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'savings_date' => now(),
            'amount' => $request->amount
        ]);


        if($saving->save()){
            return redirect()->route('saving.index');
        } else {
            dd('Data gagal Disimpan');
        }

    }

    public function show($id)
    {
                
        // Get all savings data in a single query
        $savings = Saving::where('user_id', $id)->get();

        $total_principal_savings = $savings->where('description', 'simpanan pokok')->sum('amount'); 
        $total_mandatory_savings = $savings->where('description', 'simpanan wajib')->sum('amount'); 

        $total_withdraws = $savings->where('description', 'tarik tunai')->sum('amount'); 

        $total_voluntary_savings = $savings->where('description', 'simpanan sukarela')->sum('amount') - $total_withdraws; 

        // Calculate total amount (kas masuk - kas keluar)
        $total_amount = $total_principal_savings + $total_mandatory_savings + $total_voluntary_savings;

        return view('savings.show', compact('savings', 'total_amount', 'total_principal_savings', 'total_mandatory_savings', 'total_voluntary_savings'));
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
