<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Loan;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    
    public function index()
    {
        $members = User::where('role', 'nasabah')->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        // Create a new product
        $member = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'role' => 'nasabah',
        ]);

        $saving = Saving::create([
            'user_id' => $member->id,
            'description' => 'simpanan pokok',
            'savings_date' => now(),
            'amount' => 500000
        ]);

        if($member->save() && $saving->save()){
            session()->flash('status', [
                'message' => 'Berhasil menambahkan member', 
                'type' => 'success' 
            ]);
            return redirect()->route('member.index');
        } else {
            dd('Data gagal Disimpan');
        }

    }

    public function show($id)
    {
        $member = User::find($id);
        return view('members.show', compact('member'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $member = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
        ]);

        // update table customer
        if($member){
            return redirect()->route('member.show', $id);
        } else {
            dd('Data gagal Disimpan');
        }
    }

    public function destroy($id)
    {
        $member = User::find($id);
        
        $saving = Saving::where('user_id', $id)->delete();
        $loan = Loan::where('user_id', $id)->delete();
        
        if($member->delete()) {
            return redirect()->route('member.index')->with('success', 'Data berhasil dihapus!');
        } else {
            dd('Data gagal Dihapus');
        }
    }
}
