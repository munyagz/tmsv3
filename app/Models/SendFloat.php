<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendFloat extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'send_floats';

    protected $dates = [
        'date_sent',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_sent',
        'amount',
        'transaction_ref',
        'sent_to_id',
        'sent_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateSentAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateSentAttribute($value)
    {
        $this->attributes['date_sent'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function sent_to()
    {
        return $this->belongsTo(User::class, 'sent_to_id');
    }

    public function sent_by()
    {
        return $this->belongsTo(User::class, 'sent_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
