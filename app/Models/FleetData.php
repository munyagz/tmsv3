<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FleetData extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'fleet_datas';

    protected $dates = [
        'journey_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_number',
        'journey_date',
        'vehicle_reg_no',
        'destination',
        'customer_name',
        'invoice_number',
        'amount_paid_in',
        'amount_paid_out',
        'profit_loss',
        'user_id',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getJourneyDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setJourneyDateAttribute($value)
    {
        $this->attributes['journey_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
