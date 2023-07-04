<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'expense_type_id',
        'title',
        'expense_date',
        'amount',
        'description'
    ];

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }
}
