<?php

    namespace Tests\Unit\Rules;

    use App\Rules\MaxByteRule;
    use Tests\TestCase;

/**
 * MaxByteRuleTest
 */
class MaxByteRuleTest extends TestCase
{
    /**
     * custom validate rule test
     *
     * @return void
     */
    public function testPasses(): void
    {
        $rule = new MaxByteRule(200);

        // validation pass (set 200 byte)
        $this->assertTrue($rule->passes('message', str_repeat('a', 200)));
        // validation error (set 201 byte)
        $this->assertFalse($rule->passes('message', str_repeat('a', 201)));
    }
}
