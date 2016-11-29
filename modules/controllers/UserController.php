<?php


namespace app\modules\controllers;
use app\models\Profile;
use Yii;



use app\models\User;
use yii\data\Pagination;
use yii\web\Controller;

class UserController extends Controller
{

    /**
     * 添加用户操作
     */
    public function actionAdduser()
    {
        $this->layout='layout_admin';
        $model=new User();
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            if($data=$model->addUser($data))
            {
                Yii::$app->session->setFlash('info','用户添加成功！');
                return $this->redirect(['user/user-list']);

            }
            else
            {
                Yii::$app->session->setFlash('info','用户添加失败！');
            }
        }

        $model->userPass='';
        $model->rePass='';
        return $this->render('adduser',['model'=>$model]);
        
    }

    public function actionUserList()
    {
        $this->layout='layout_admin';
        $model = User::find();
        $count=$model->count();
        $pageSize=Yii::$app->params['pageSize']['user'];
        $pager=new Pagination(['pageSize'=>$pageSize,'totalCount'=>$count]);
        $users=$model->offset($pager->offset)->limit($pager->limit)->all();

        return $this->render('user-list',['users'=>$users,'pager'=>$pager]);

    }


}