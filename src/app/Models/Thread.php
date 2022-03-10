<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * threadsテーブルに接続する
 */
class Thread extends Model
{
    use HasFactory;

    protected $guarded = ['entry_id'];

    public const CREATED_AT = 'post_date';
    public const UPDATED_AT = null;
}
