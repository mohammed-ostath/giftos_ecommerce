<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
