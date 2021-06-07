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
        'is_task_done',
        'order',
        'dead_line'
    ];



    public function user()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }

    public function referencedUser()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'reference_id');
    }
}
