<?php


namespace app\modules\controllers;
use Yii;


use app\modules\models\admin;
use yii\web\Controller;

class PublicController extends Controller
{
    /**
     * 登录操作
     * @return string
     */
    public function actionLogin()
    {
        $this->layout=false;
        $model=new admin();
        if(Yii::$app->request->isPost)
        {

            $post=Yii::$app->request->post();
            if($model->login($post))
            {
                $this->redirect(['default/index']);//跳转到index页面
                Yii::$app->end();
            }
        }
        return $this->render('login',['model'=>$model]);
    }

    /**
     *注销操作
     */
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        if(!isset(Yii::$app->session['admin']['isLogin']))
        {
            $this->redirect(['public/login']);//跳转到login页面，注意跳转地址是在数组里[]
            Yii::$app->end();

        }
        $this->goBack();
    }

    /**
     * 发送邮件找回密码操作
     * @return string
     */
    public function actionSeekpassword()
    {
        $this->layout=false;
        $model=new admin();
        if(Yii::$app->request->isPost)
        {
            $post=Yii::$app->request->post();

            if($model->seekpass($post)&& $model->validate())
            {
                Yii::$app->session->setFlash('info','电子邮件已经发送成功，请查收！');
            }

        }
        return $this->render('seekPassword',['model'=>$model]);
    }
}