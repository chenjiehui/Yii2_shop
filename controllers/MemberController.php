<?php


namespace app\controllers;
use Yii;


use app\models\User;
use yii\web\Controller;

class MemberController extends CommonController
{

    /**
     * 用户登录操作
     */
    public function actionAuth()
    {

        $this->layout='layout_menu';
        $model=new User();
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            if($model->login($data))
            {
                Yii::$app->session->setFlash('info','登录成功');
                return $this->goBack();

            }
            else
            {
                Yii::$app->session->setFlash('info','登录失败');
                $model->loginname='';

            }

        }

        $model->userPass='';
        return $this->render('auth',['model'=>$model]);
    }


    /**
     * 注销登录操作
     */
    public function actionLogout()
    {
        Yii::$app->session->remove('loginname');
        Yii::$app->session->remove('isLogin');
//        unset($_COOKIE['recentViews']);
        if (!isset(Yii::$app->session['isLogin']))
        {
            return $this->goBack(Yii::$app->request->referrer);
        }
    }


}