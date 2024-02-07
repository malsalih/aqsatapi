<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory;
    use LogsActivity;
    // protected $connection = 'mongodb';
    // protected $collection = 'activity_log';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'image',
        'balance',
        'qast',
        'qast_period',
        'last_payment',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->useLogName('customer')
        ->dontSubmitEmptyLogs();
    }
}
