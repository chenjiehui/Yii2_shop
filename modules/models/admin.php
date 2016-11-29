<?php


namespace app\modules\models;


use yii\db\ActiveRecord;
use yii\web\User;
use Yii;

class admin extends ActiveRecord
{
    public $rePass;//针对数据库里没有的字段需要声明公共变属性，因为在admin这个数据库类里，属性就代表字段，所以adminUser,adminPass等无需声明
    public $rememberMe=false;
    public static function tableName()
    {
        return "{{%admin}}";
    }

    /**
     * 表单字段的验证规则
     * @return array
     */
    public function rules()
    {
        return[
            ['adminUser','required','message'=>'管理员账号不能为空','on'=>['login','seekpass','addManagers','modify']],

            ['adminUser','unique','message'=>'管理员账号已存在','on'=>'addManagers'],
            ['adminPass','required','message'=>'管理员密码不能为空','on'=>['login','changePass','addManagers','modify']],

            ['adminPass','validatePass','on'=>'login'],
            ['adminEmail','email','message'=>'邮箱格式不正确','on'=>['seekpass','addManagers','modify']],
            ['adminEmail','unique','message'=>'电子邮箱已被注册','on'=>'addManagers'],
            ['adminEmail','required','message'=>'邮箱不能为空','on'=>['seekpass','addManagers','modify']],
            ['adminEmail','validateEmail','on'=>'seekpass'],
            ['rePass','required','message'=>'重复密码不能为空','on'=>['changePass','addManagers','modify']],
            ['rePass','compare','compareAttribute'=>'adminPass','message'=>'两次密码不一致','on'=>['changePass','addManagers','modify']],
            ['rememberMe','boolean','on'=>'login'],
        ];
    }


    /**
     * 验证用户名和密码
     */
    public function validatePass()
    {
        if(!$this->hasErrors())
        {
            $data=self::find()->where('adminUser=:user and adminPass=:pass',[':user'=>$this->adminUser,':pass'=>$this->adminPass])->one();
            if(is_null($data))
            {
                $this->addError('adminPass','用户名或密码错误');
            }
        }
    }


    /**
     * 验证邮箱和用户名是否匹配
     */
    public function validateEmail()
    {
        if(!$this->hasErrors())
        {
             $data=self::find()->where('adminUser=:user and adminEmail=:email',[':user'=>$this->adminUser,':email'=>$this->adminEmail])->one();
            if(is_null($data))
            {
                $this->addError('adminEmail','用户名和邮箱不匹配');
            }
        }
    }

    /**
     * 执行登录方法
     * @param $data
     * @return bool
     */
    public function login($data)
    {
        $this->scenario='login';
        if($this->load($data) && $this->validate())
        {
            $lifetime=$this->rememberMe ? 24*3600 : 0 ;
            $session=Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin']=[
                'adminUser'=>$this->adminUser,

                'isLogin'=>1,

            ];
            $this->updateAll(['loginTime'=>time(),'loginIp'=>ip2long(Yii::$app->request->userIP)],'adminUser= :user',[':user'=>$this->adminUser]);//更新登录时间和登录ip
            return (bool)$session['admin']['isLogin'];

        }
        else{
            return false;
        }
    }
    /**
     * 执行找回密码操作前对接收数据进行验证
     */
    public function seekpass($data)
    {
        $this->scenario='seekpass';
        if($this->load($data) && $this->validate()) {
            //验证通过进行发送邮件操作
            $time = time();
            $token = $this->createToken($data['admin']['adminUser'], $time);
            $mailer = Yii::$app->mailer->compose('seekpass', ['adminUser' => $data['admin']['adminUser'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom(Yii::$app->params['adminEmail']);
            $mailer->setTo($this->adminEmail);
            $mailer->setSubject('京东商城-找回密码');
//            $mailer->setHtmlBody('请点击链接修改密码');
            if ($mailer->send())
            {
                return true;
            }

        }
        return false;
    }

    /**
     * 依据adminUser和登录时间来生成token方法
     */
    public function createToken($adminUser, $time)
    {
        return md5(md5($adminUser).base64_encode(Yii::$app->request->userIP).md5($time));
    }

    /**
     *修改密码方法
     */
    public function changePass($data)
    {
        $this->scenario='changePass';
        if($this->load($data) && $this->validate())//如果载入数据并且字段规则验证通过
        {
          return (bool)$this->updateAll(['adminPass'=>$data['admin']['adminPass']],'adminUser =:user',[':user'=>$data['admin']['adminUser']]);
        }
        return false;

    }

    /**
     *添加管理员方法
     */
    public function addManagers($data)
    {
        $this->scenario='addManagers';

        if($this->load($data) && $this->validate())
        {
            $admin=new admin();
            $admin->adminUser=$data['admin']['adminUser'];
            $admin->adminPass=$data['admin']['adminPass'];
            $admin->adminEmail=$data['admin']['adminEmail'];
            $admin->createTime=time();
            $admin->save();
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     *删除管理员方法
     */
    public function deleteManagers($adminId)
    {
       return (bool)$this->deleteAll('adminid = :id', [':id' => $adminId]);

    }

    /**
     * 显示管理员个人信息方法
     * @param $adminUser
     */
    public function show($adminUser)
    {
        $data=self::find()->where(['adminUser'=>$adminUser])->one();

        if($data)
        {
            return $data;
        }
        else
        {
            return false;
        }
    }

    /**
     *修改管理员个人信息前通过管理员id查询信息方法
     */
    public function modifyInfo($adminId)
    {
        $data=self::find()->where(['adminId'=>$adminId])->one();
        if($data)
        {
            return $data;
        }
        else{
            return false;
        }
    }

    /**
     *执行管理员信息修改方法
     */
    public function doModify($data)
    {
        $this->scenario='modify';
        if($this->load($data)&& $this->validate())
        {
            $adminId=Yii::$app->request->get('adminId');
            $user=self::findOne($adminId);
            $user->adminUser=$data['admin']['adminUser'];
            $user->adminEmail=$data['admin']['adminEmail'];
            $user->adminPass=$data['admin']['adminPass'];
            $user->save();
            return true;

        }
        else
        {
            return false;
        }


    }

    /**
     * 修改管理员密码方法
     */
    public function changeManagersPass($data)
    {
        $this->scenario='changePass';
        if($this->load($data)&& $this->validate())
        {
            $user = self::find()->where(['adminUser'=>$data['admin']['adminUser']])->one();//这里曾经有问题 2016-09-15 0:20
            $user->adminPass = $data['admin']['adminPass'];
            $user->save();//也可用update()
            return true;
        }
//        if($this->load($data)&& $this->validate())
//        {
//        return (bool)self::updateAll(['adminPass'=>$data['admin']['adminPass']],'adminUser =:user',[':user'=>$data['admin']['adminUser']]);//更新所有满足条件的记录
//        }


    }
}

