<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'iscompleted'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setUser(User $user)
    {
    	$this->user()->associate($user);
    }

    public function isCompleted(): bool
    {
        return (bool)$this->getAttribute('iscompleted');
    }
}
