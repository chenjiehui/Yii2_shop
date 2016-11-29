<?php


namespace app\modules\controllers;
use Yii;

use yii\web\Controller;
use app\modules\models\admin;
use yii\data\Pagination;

class ManageController extends Controller
{

    /**
     * 通过邮件修改密码操作
     * @return string
     */
    public function actionMailchangepass()
    {
        {
            $this->layout = false;
            $time = Yii::$app->request->get('timestamp');
            $adminUser = Yii::$app->request->get('adminUser');
            $token = Yii::$app->request->get('token');
            $model = new admin();
            $myToken = $model->createToken($adminUser, $time);
            if ($token != $myToken || (time() - $time > 3000)) {
                $this->redirect(['public/login']);
                Yii::$app->end();
            }
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                if ($model->changePass($data)) {
                    Yii::$app->session->setFlash('info', '密码修改成功！');
                } else {
                    Yii::$app->session->setFlash('info', '密码修改失败咯！');
                }
            }


            $model->adminUser = $adminUser;

            return $this->render('mailchangepass', ['model' => $model]);
        }
    }
    /**
     * @return string
     * 管理员列表查看操作
         */
     public function actionManagers()
    {

        if (\Yii::$app->session['admin']['isLogin']) {
            $this->layout = 'layout_admin';
            $model = admin::find();
            $count = $model->count();//分页功能开始
            $pageSize = Yii::$app->params['pageSize']['manage'];
            $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
            $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
            return $this->render('managers', ['managers' => $managers, 'pager' => $pager]);

        }
        else
        {
            return $this->redirect(['public/login']);
        }
    }
    /**
     *新增管理员操作
     */
    public function actionReg()
    {
        if (\Yii::$app->session['admin']['isLogin']) {
            $this->layout = 'layout_admin';
            $model = new admin();
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                if ($model->addManagers($data)) {
                    Yii::$app->session->setFlash('info', '管理员添加成功！');

                    return $this->redirect(['manage/managers']);
                } else {
                    Yii::$app->session->setFlash('info', '管理员添加失败!');

                }
            }
            return $this->render('reg', ['model' => $model]);
        }
        else{
            return $this->redirect(['public/login']);
        }

    }

    /**
     * 删除管理员操作
     */
    public function actionDel()
    {
        $this->layout=false;
        if(Yii::$app->request->isGet)
        {
            $adminId = (int)Yii::$app->request->get("adminId");
            if (empty($adminId) || $adminId == 1)
            {
                $this->redirect(['manage/managers']);
                return false;
            }
            $model = new Admin;
            if ($model->deleteManagers($adminId))
            {
                Yii::$app->session->setFlash('info', '删除成功');
                $this->redirect(['manage/managers']);
            }
            else
            {
                Yii::$app->session->setFlash('info', '删除失败');
                $this->redirect(['manage/managers']);

            }



        }


    }

    /**
     *管理员个人详细信息展示操作
     */
    public function actionProfile()
    {
        $this->layout='layout_admin';
        $model=new admin;
        if(Yii::$app->request->isGet)
        {


            $adminUser=Yii::$app->request->get('adminUser');
            if($data=$model->show($adminUser))
            {
                return $this->render('profile',['data'=>$data]);
            }
            else
            {
                return $this->redirect(['default/index']);
            }


        }



    }

    /**
     *管理员个人信息修改操作_接收管理员ID获取信息
     */
    public function actionModify()
    {
        $this->layout='layout_admin';
        $model=new admin();
        if(Yii::$app->request->isGet)
        {
            $adminId=Yii::$app->request->get('adminId');
            if($data=$model->modifyInfo($adminId))
            {
                return $this->render('modify',['data'=>$data]);
            }
            else
            {
                $this->redirect(['default/index1']);
            }
        }


    }

    /**
     *执行管理员信息修改操作
     */
    public function actionDomodify()
    {
        $this->layout='layout_admin';
        $model=new admin();
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            if($model->doModify($data))
            {
                Yii::$app->session->setFlash('info','信息修改成功');
                return $this->redirect(['manage/managers']);//redirect的地址实际上是选择控制器和操作再渲染出页面，不是直接调用视图
            }
            else
            {   $adminId=Yii::$app->request->get('adminId');
                $data=$model->modifyInfo($adminId);
                Yii::$app->session->setFlash('info','信息修改失败');
                return $this->render('modify',['data'=>$data,'model'=>$model]);
//                 return $this->redirect(['manage/profile']);
            }
        }

        
    }

    /**
     *修改管理员密码操作
     */
    public function actionChangepass()
    {
        $this->layout='layout_admin';
        $model=admin::find()->where(['adminUser'=>\Yii::$app->session['admin']['adminUser']])->one();//查询该用户名下的信息
        if(Yii::$app->request->isPost)
        {
            $model=new admin();
            $data=Yii::$app->request->post();
            if($model->changeManagersPass($data))
            {
                Yii::$app->session->setFlash('info','密码修改成功');

            }
            else
            {
                Yii::$app->session->setFlash('info','密码修改失败');

            }

        }
        $model->adminUser=\Yii::$app->session['admin']['adminUser'];
        return $this->render('changepass',['model'=>$model]);
        //问题：修改密码成功之后，再页面里再输入修改密码，就修改失败了,
        //原因是再次渲染changepass页面上，$model->adminUser值没有了，需要再赋值一下

        
    }
}