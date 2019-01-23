<?php
namespace project\modules\_public\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => \yii\web\ErrorAction::class,
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}