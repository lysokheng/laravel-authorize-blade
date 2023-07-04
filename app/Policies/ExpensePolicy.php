<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function updateExpense(User $user, Expense $expense): bool
    {
        return auth()->user()->role === config('settings.roles.admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function deleteExpense(User $user, Expense $expense): bool
    {
        return auth()->user()->role === config('settings.roles.admin');
    }
}
