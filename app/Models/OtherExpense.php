<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherExpense extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'other_expenses';

    protected $dates = [
        'date_spent',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'expense_id',
        'amount',
        'date_spent',
        'description',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function expense()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_id');
    }

    public function getDateSpentAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateSpentAttribute($value)
    {
        $this->attributes['date_spent'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
