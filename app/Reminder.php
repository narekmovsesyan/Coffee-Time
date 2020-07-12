<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use SoftDeletes;

    protected $table = 'reminders';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'date_time', 'status',
    ];

    /**
     * @return mixed
     */
    public function users(){
        return $this->belongsToMany(User::class, 'reminders', 'id', 'user_id');
    }
}
