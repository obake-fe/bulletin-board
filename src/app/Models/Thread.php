<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * partial match search about name column
     *
     * @param $query
     * @param string|null $keyword
     * @return mixed
     */
    public function scopeAuthorPartialMatch($query, string $keyword = null): mixed
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where('author', 'like', "%$keyword%");
    }

    /**
     * partial match search about message column
     *
     * @param $query
     * @param string|null $keyword
     * @return mixed
     */
    public function scopeMessagePartialMatch($query, string $keyword = null): mixed
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where('message', 'like', "%$keyword%");
    }
}
