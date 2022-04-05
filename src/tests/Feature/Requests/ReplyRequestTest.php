<?php

namespace Tests\Feature\Requests;

use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * ReplyRequestTest
 */
class ReplyRequestTest extends TestCase
{
    /**
     * Validation test
     *
     * @param array   $keys   項目名の配列
     * @param array   $values 値の配列
     * @param boolean $expect 期待値
     * @dataProvider replyDataProvider
     */
    public function testReplyValidation(array $keys, array $values, bool $expect): void
    {
        $dataList = array_combine($keys, $values);
        $request = new ReplyRequest();
        $rules = $request->rules();

        //Validatorファサードでバリデーターのインスタンスを取得
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    /**
     * dataProvider
     */
    public function replyDataProvider()
    {
        return [
            '正常系' => [
                ['author', 'message'],
                ['hoge', 'fuga'],
                true
            ],
            'author 必須エラー' => [
                ['author', 'message'],
                ['', 'fuga'],
                false
            ],
            'author 最大文字数エラー' => [
                ['author', 'message'],
                [str_repeat('a', 21), 'fuga'],
                false
            ],
            'message 必須エラー' => [
                ['author', 'message'],
                ['hoge', ''],
                false
            ],
            'author 最大バイト数エラー' => [
                ['author', 'message'],
                ['hoge', str_repeat('a', 201)],
                false
            ]
        ];
    }
}
