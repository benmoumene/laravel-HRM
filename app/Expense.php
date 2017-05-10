<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Expense extends Model
{
    use SoftDeletes;

    protected $dates = ['entryDate'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projects_id',
        'expenseNo',50,
        'amount',
        'note',
        'entryDate',
        'users_id',
    ];

    public function project() {
        return $this->belongsTo('App\Project','projects_id');
    }
    public function item() {
        return $this->hasMany('App\ExpenseItem','expenses_id');
    }
    public function entry() {
        return $this->belongsTo('App\User','users_id');
    }

    function setEntryDateAttribute($value)
    {
        $this->attributes['entryDate'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}