<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";

    # allowed status
    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
