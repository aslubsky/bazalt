<?php

namespace Framework\System\Multilingual\tests;

use Framework\System\Multilingual as Multilingual;

class ArrayTranslateTest extends \Tests\BaseCase
{
    /**
     * @var Multilingual\ArrayTranslate
     */
    protected $tr = null;

    protected function setUp()
    {
        $this->tr = new Multilingual\ArrayTranslate(Multilingual\Domain::root());
        $this->tr->messages([
            'Test' => [
                'string'    => 'Test',
                'translation' => 'Success'
            ],
            '%d review' => [
                'string'    => 'Test',
                'translations' => [
                    "%d відгук",
                    "%d відгука",
                    "%d відгуків"
                ]
            ]
        ]);
        $this->tr->pluralExpression('nplurals=3; plural=((n%10==1) && (n%100!=11)) ? 0 : (( (n%10>=2) && (n%10<=4) && (n%100<10 || n%100>=20)) ? 1 : 2 );');
    }

    protected function tearDown()
    {
        $this->tr = null;
    }

    public function testTranslate()
    {
        $this->assertEquals('Success', $this->tr->translate('Test'));
    }

    public function testPluralTranslate()
    {
        $this->assertEquals('0 відгуків', $this->tr->translate('%d review', '%d reviews'));

        $this->assertEquals('1 відгук', $this->tr->translate('%d review', '%d reviews', 1));

        $this->assertEquals('2 відгука', $this->tr->translate('%d review', '%d reviews', 2));

        $this->assertEquals('5 відгуків', $this->tr->translate('%d review', '%d reviews', 5));
    }
    /**
     * @expectedException Exception

    public function testFetchError()
    {
    }*/
}