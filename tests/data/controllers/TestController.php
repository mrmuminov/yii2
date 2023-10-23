<?php

namespace yiiunit\data\controllers;

use yii\web\Controller;
use yii\web\ErrorAction;

class TestController extends Controller
{
    public $layout = '@yiiunit/data/views/layout.php';

    private array $actionConfig = [];

    public function setActionConfig($config = []): void
    {
        $this->actionConfig = $config;
    }

    public function actions()
    {
        return [
            'error' => array_merge([
                'class' => ErrorAction::class,
                'view' => '@yiiunit/data/views/error.php',
            ], $this->actionConfig),
        ];
    }
}
