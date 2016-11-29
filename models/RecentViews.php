<?php


namespace app\models;

class RecentViews
{
    //设定最近浏览过的商品
    function setrecentViews($product)
    {
        $recentViews = isset($_COOKIE['recentViews']) ? explode(',', $_COOKIE['recentViews']) : array();
        //如果已经存在，则删除之前的记录
        $temp = array_flip($recentViews);
        unset($temp[$product]);
        $recentViews = array_flip($temp);
        if (count($recentViews) == 10) {   //  超过了需要展示的最大数量,删除最早添加的记录
            array_shift($recentViews);
        }
        array_push($recentViews, $product);
        setcookie("recentViews", implode(',', $recentViews), time() + 3600);
    }


    //获取最近浏览过的商品
    function getrecentViews(){

        $recentViews = isset($_COOKIE['recentViews']) ? explode(',', $_COOKIE['recentViews']) : array();
        return $recentViews;
    }
}