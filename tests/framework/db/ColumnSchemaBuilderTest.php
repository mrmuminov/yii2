<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yiiunit\framework\db;

use yii\db\ColumnSchemaBuilder;
use yii\db\Expression;
use yii\db\Schema;

abstract class ColumnSchemaBuilderTest extends DatabaseTestCase
{
    /**
     * @param string $type
     * @param int $length
     * @return ColumnSchemaBuilder
     */
    public function getColumnSchemaBuilder($type, $length = null)
    {
        return new ColumnSchemaBuilder($type, $length, $this->getConnection());
    }

    /**
     * @return array
     */
    public static function typesProvider(): array
    {
        return [
            ['integer NULL DEFAULT NULL', Schema::TYPE_INTEGER, null, [
                ['unsigned'], ['null'],
            ]],
            ['integer(10)', Schema::TYPE_INTEGER, 10, [
                ['unsigned'],
            ]],
            ['timestamp() WITH TIME ZONE NOT NULL', 'timestamp() WITH TIME ZONE', null, [
                ['notNull'],
            ]],
            ['timestamp() WITH TIME ZONE DEFAULT NOW()', 'timestamp() WITH TIME ZONE', null, [
                ['defaultValue', new Expression('NOW()')],
            ]],
            ['integer(10)', Schema::TYPE_INTEGER, 10, [
                ['comment', 'test'],
            ]],
        ];
    }

    /**
     * @dataProvider typesProvider
     *
     * @param string $expected The expected result.
     * @param string $type The column type.
     * @param int|null $length The column length.
     * @param mixed $calls The method calls.
     */
    public function testCustomTypes(string $expected, string $type, int|null $length, mixed $calls): void
    {
        $this->checkBuildString($expected, $type, $length, $calls);
    }

    /**
     * @param string $expected
     * @param string $type
     * @param int|null $length
     * @param array $calls
     */
    public function checkBuildString($expected, $type, $length, $calls): void
    {
        $builder = $this->getColumnSchemaBuilder($type, $length);
        foreach ($calls as $call) {
            $method = array_shift($call);
            \call_user_func_array([$builder, $method], $call);
        }

        self::assertEquals($expected, $builder->__toString());
    }
}
