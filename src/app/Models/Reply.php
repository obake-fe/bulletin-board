<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * replies tableに接続する
 */
class Reply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const CREATED_AT = 'post_date';
    public const UPDATED_AT = null;

    /**
     * relation
     *
     * @return BelongsTo
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'thread_id', 'entry_id');
    }
}
