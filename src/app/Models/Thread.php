<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * threads tableに接続する
 */
class Thread extends Model
{
    use HasFactory;

    protected $guarded = ['entry_id'];

    public const CREATED_AT = 'post_date';
    public const UPDATED_AT = null;

    /**
     * relation
     *
     * @return HasMany
     */
    public function reply(): HasMany
    {
        return $this->hasMany(Reply::class, 'thread_id', 'entry_id');
    }


    /**
     * partial match search about name column
     *
     * @param Builder     $query
     * @param string|null $keyword
     * @return Builder
     */
    public function scopeAuthorPartialMatch(Builder $query, string $keyword = null): Builder
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where('author', 'like', "%$keyword%");
    }

    /**
     * partial match search about message column
     *
     * @param Builder     $query
     * @param string|null $keyword
     * @return Builder
     */
    public function scopeMessagePartialMatch(Builder $query, string $keyword = null): Builder
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where('message', 'like', "%$keyword%");
    }
}
