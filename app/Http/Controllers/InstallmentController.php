<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {   
        
        $installment = Installment::create([
            'loan_id' => $id,
            'installment' => 1,
            'amount' => $request->amount,
            'installment_date' =>now(),
        ]);

        if($installment->save()){
            return redirect()->route('loan.index');
        } else {
            dd('Data gagal Disimpan');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $installment = Installment::where('id', $id)->update([
            'status' => $request->status == 'lunas' ? 'belum lunas' : 'lunas',
        ]);

        return redirect()->route('loan.index');
        
    }

    public function destroy($id)
    {
        //
    }
}
