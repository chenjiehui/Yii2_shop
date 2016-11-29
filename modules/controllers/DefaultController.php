<?php

namespace app\modules\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
        public function actionIndex()
        {
            if (\Yii::$app->session['admin']['isLogin']) {
                $this->layout = 'layout_admin';
                return $this->render('index');
            }
            else
            {
              return $this->redirect(['public/login']);
            }
        }

}
