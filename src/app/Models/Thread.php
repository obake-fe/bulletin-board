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
     * @param $str
     * @return mixed
     */
    public function scopeAuthorPartialMatch($query, $str): mixed
    {
        return $query->where('author', 'like', "%$str%");
    }

    /**
     * partial match search about message column
     *
     * @param $query
     * @param $str
     * @return mixed
     */
    public function scopeMessagePartialMatch($query, $str): mixed
    {
        return $query->where('message', 'like', "%$str%");
    }
}
