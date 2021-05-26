<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLogs extends BaseModel
{
    protected $table = 'sms_logs';

    protected $guarded = ['id'];
}
