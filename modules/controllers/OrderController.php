<?php


namespace app\modules\controllers;


use app\models\Order;
use yii\data\Pagination;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionList()
    {
        $this->layout='layout_admin';
        $model=Order::find();
        $count=$model->count();
        $pageSize=\Yii::$app->params['pageSize']['order'];
        $pager=new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
        $orders=$model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('list',['pager'=>$pager,'orders'=>$orders]);


    }

}