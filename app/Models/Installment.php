<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['loan_id', 'installment', 'amount', 'installment_date', 'status'];
    
    public function loans() {
        return $this->hasMany(Loan::class, 'loan_id');
    }
}
