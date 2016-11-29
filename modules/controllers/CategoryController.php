<?php


namespace app\modules\controllers;
use Yii;
use app\models\Category;
use yii\data\Pagination;
use yii\web\Controller;

class CategoryController extends Controller
{
    /**
     * 添加分类操作
     */
    public function actionAdd()
    {
        $model = new Category();
        $list = $model->getOptions();
        $this->layout = "layout_admin";
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->add($post)) {
                Yii::$app->session->setFlash("info", "添加成功");
            }
        }
        $model->title='';
        return $this->render("add", ['list' => $list, 'model' => $model]);
    }

    /**
     * 显示分类列表操作
     */
    public function actionList()
    {
        $this->layout = "layout_admin";
        $model = new Category;
        $cates = $model->getTreeList();
        return $this->render("cates", ['cates' => $cates]);
    }


    /**
     * @分类信息修改操作
     */
    public function actionMod()
    {
        $this->layout = "layout_admin";
        $cateid = Yii::$app->request->get("cateid");
        $model = Category::find()->where(['cateid' => $cateid])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        $list = $model->getOptions();
        return $this->render('add', ['model' => $model, 'list' => $list]);
    }

    /**
     * 分类信息删除操作
     */
    public function actionDel()
    {
        try {
            $cateid = Yii::$app->request->get('cateid');
            if (empty($cateid)) {
                throw new \Exception('参数错误');
            }
            $data = Category::find()->where(['parentid' => $cateid])->one();
            if ($data) {
                throw new \Exception('该分类下有子类，不允许删除');
            }
            if (!Category::deleteAll('cateid = :id', [":id" => $cateid])) {
                throw new \Exception('删除失败');
            }
        } catch(\Exception $e) {
            Yii::$app->session->setFlash('info', $e->getMessage());
        }
        return $this->redirect(['category/list']);
    }



}