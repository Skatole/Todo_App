<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'posts';

    protected  $fillable = [
        'title',
        'task',
        'user_id',
        'is_task_done',
        'order',
        'dead_line'
    ];

	public function user() {
        return $this->belongsTo('App/Models/User');
    }
}
