<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * replies tableに接続する
 */
class Reply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const CREATED_AT = 'post_date';
    public const UPDATED_AT = null;
}
