<?php

namespace App\Http\Requests;

use App\Rules\MaxByteRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * ThreadRequest
 */
class ThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // ルートからのみのアクセスを受け付ける
        return $this->path() === '/';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author' => ['required', 'max:20'],
            'message' => ['required', new MaxByteRule(200)]
        ];
    }
}
