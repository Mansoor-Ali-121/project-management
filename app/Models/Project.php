<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'location',
        'status',
        'deadline',
    ];

    // Relations
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function applications() {
        return $this->hasMany(ProjectApplication::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}