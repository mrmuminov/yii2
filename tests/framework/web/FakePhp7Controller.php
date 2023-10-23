<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yiiunit\framework\web;

use yii\web\Controller;

/**
 * @author Brandon Kelly <branodn@craftcms.com>
 * @since 2.0.31
 */
class FakePhp7Controller extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAksi1(int $foo, bool $true, bool $false, float $bar = null): void
    {
    }

    public function actionStringy(string $foo = null): void
    {
    }
}
