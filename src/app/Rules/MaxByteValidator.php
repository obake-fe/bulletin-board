<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * MaxByteValidator
 *
 * バイト数を引数に取り、指定のバイト以下のバリデートを行う。
 */
class MaxByteValidator implements Rule
{
    protected int $maxBytes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $maxBytes)
    {
        $this->maxBytes = $maxBytes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $trim = str_replace(array("\r\n", "\r", "\n"), '', $value);
        $Length = strlen($trim);
        return $this->maxBytes >= $Length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must not be greater than {$this->maxByte} bytes.';
    }
}
