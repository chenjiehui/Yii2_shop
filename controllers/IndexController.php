<?php
namespace app\controllers;

use app\models\Product;
use app\models\RecentViews;
use Yii;

class IndexController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = "layout_1";
        $data['tui'] = Product::find()->where('istui = "1" and ison = "1"')->orderby('createtime desc')->limit(8)->all();
        $data['new'] = Product::find()->where('ison = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['hot'] = Product::find()->where('ison = "1" and ishot = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['all'] = Product::find()->where('ison = "1"')->orderby('createtime desc')->limit(7)->all();

        $views=new RecentViews();
        $recentviews=$views->getRecentViews();
        $viewData=[];
        foreach($recentviews as $k => $viewId)
        {
            $product = Product::find()->where(['productid' =>$viewId ])->one();
            $viewData[$k]['cover'] = $product->cover;
            $viewData[$k]['title'] = $product->title;
            $viewData[$k]['price'] = $product->price;


        }

        return $this->render("index", ['data' => $data,'viewData'=>$viewData]);
    }
}
