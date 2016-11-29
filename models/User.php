<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\debug\models\search\Profile;
use Yii;

class User extends ActiveRecord
{
    public $loginname;
    public $rePass;
    public $rememberMe;

    public static function tableName()  //该方法须是静态方法
    {
        return '{{%user}}';

    }



    public function rules()
    {
       return[
         ['userName','required','message'=>'用户名不能为空','on'=>['addUser']],
         ['userName','unique','message'=>'用户名已存在','on'=>'addUser'],
         ['userPass','required','message'=>'密码不能为空','on'=>['addUser','login']],
         ['rePass','required','message'=>'重复密码不能为空','on'=>'addUser'],
         ['rePass','compare','compareAttribute'=>'userPass','message'=>'两次密码不一样','on'=>'addUser'],
         ['userEmail','required','message'=>'邮箱不能为空','on'=>['addUser']],
         ['userEmail','unique','message'=>'邮箱已存在','on'=>'addUser'],
         ['userEmail','email','message'=>'邮箱格式不正确','on'=>['addUser','login']],

         ['loginname', 'required', 'message' => '登录用户名不能为空', 'on' => ['login']],
         ['userPass','validatePass','on'=>'login'],
       ];
    }

    /**
     *添加用户信息方法
     */
    public function addUser($data)
    {
        $this->scenario='addUser';
        if($this->load($data)&& $this->validate())
        {
            $user=new User();
            $user->userName=$data['User']['userName'];
            $user->userPass=$data['User']['userPass'];
            $user->userEmail=$data['User']['userEmail'];
            $user->createTime=time();
            return $user->save() ? $user->save(): null;
        }

    }

    /**
     * 查询关联数据库的数据
     * @return \yii\db\ActiveQuery
     */

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['userId' => 'userId']);
    }

    /**
     *验证邮箱或用户名和密码是否匹配
     */

    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $loginname = "userName";
            if (preg_match('/@/', $this->loginname)) {
                $loginname = "userEmail";
            }
            $data = self::find()->where($loginname.' = :loginname and userPass = :pass', [':loginname' => $this->loginname, ':pass' => $this->userPass])->one();
            if (is_null($data)) {
                $this->addError("userPass", "用户名或者密码错误");
            }
        }
    }
//    public function validateEmail()
//    {
//        if(!$this->hasErrors())
//        {
//            $data=self::find()->where('userPass=:pass and userEmail=:email',[':pass'=>$this->userPass,':email'=>$this->userEmail])->one();
//            if(is_null($data))
//            {
//                $this->addError('userEmail','邮箱和密码不匹配');
//            }
//        }
//    }



    /**
     *用户登录方法
     */
    public function login($data)
    {
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {

            $lifetime = $this->rememberMe ? 24*3600 : 0;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['loginname'] = $this->loginname;
            $session['isLogin'] = 1;
            return (bool)$session['isLogin'];
        }
        return false;
    }


}
