<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['savings_date', 'description', 'user_id', 'amount'];
    
    public function member() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
