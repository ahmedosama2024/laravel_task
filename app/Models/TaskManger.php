<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskManger extends Model
{
    protected $fillable = [
        'title',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    ## Relations

    /**
     * Get the user that owns the TaskManger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    ##Other methods

    public function remove()
    {
        $this->delete();
        return [
            'message' => __('tasks.delete')
        ];
    }
}
