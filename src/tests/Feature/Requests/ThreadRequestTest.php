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
     * カスタムリクエストのバリデーションテスト
     *
     * @param array   $keys   項目名の配列
     * @param array   $values 値の配列
     * @param boolean $expect 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataProviderThread
     */
    public function testThread(array $keys, array $values, bool $expect)
    {
        //入力項目（$item）とその値($data)
        $dataList = array_combine($keys, $values);

        $request = new ThreadRequest();
        //フォームリクエストで定義したルールを取得
        $rules = $request->rules();
        //Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($dataList, $rules);
        //入力情報がバリデーショルールを満たしている場合はtrue、満たしていな場合はfalseが返る
        $result = $validator->passes();
        //期待値($expect)と結果($result)を比較
        $this->assertEquals($expect, $result);
    }

    /**
     * dataProvider
     */
    public function dataProviderThread()
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
