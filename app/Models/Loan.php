<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['user_id', 'desc', 'amount', 'monthly_installment', 'loan_date'];
    
    public function member() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function installment() {
        return $this->belongsTo(Installment::class, 'id');
    }
}
