<?php

namespace Tests\Feature\Requests;

use App\Http\Requests\ThreadRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * ThreadRequestTest
 */
class ThreadRequestTest extends TestCase
{
    /**
     * Validation test
     *
     * @param array   $keys   項目名の配列
     * @param array   $values 値の配列
     * @param boolean $expect 期待値
     * @dataProvider threadDataProvider
     */
    public function testThreadValidation(array $keys, array $values, bool $expect): void
    {
        $dataList = array_combine($keys, $values);
        $request = new ThreadRequest();
        $rules = $request->rules();

        //Validatorファサードでバリデーターのインスタンスを取得
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    /**
     * dataProvider
     */
    public function threadDataProvider()
    {
        return [
            '正常系' => [
                ['message'],
                ['fuga'],
                true
            ],
            'message 必須エラー' => [
                ['message'],
                [''],
                false
            ],
            'message 最大バイト数エラー' => [
                ['message'],
                [str_repeat('a', 201)],
                false
            ]
        ];
    }
}
