<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * replies tableに接続する
 *
 * @property int $id
 * @property int $thread_id
 * @property string $author
 * @property string $message
 * @property string|null $image
 * @property \Illuminate\Support\Carbon $post_date
 * @property-read \App\Models\Thread|null $thread
 * @method static \Database\Factories\ReplyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply wherePostDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereThreadId($value)
 */
    class Reply extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * threads tableに接続する
 *
 * @property int $entry_id
 * @property string $author
 * @property string $message
 * @property string|null $image
 * @property \Illuminate\Support\Carbon $post_date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read int|null $replies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Thread authorPartialMatch(?string $keyword = null)
 * @method static \Database\Factories\ThreadFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread messagePartialMatch(?string $keyword = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread wherePostDate($value)
 */
    class Thread extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
    class User extends \Eloquent
    {
    }
}
