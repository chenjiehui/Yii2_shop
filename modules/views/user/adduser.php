<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<link rel="stylesheet" href="/basic/web/assets/admin/css/compiled/new-user.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加新用户</h3>
            </div>

            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php if(Yii::$app->session->hasFlash('info'))
                        {
                            echo Yii::$app->session->getFlash('info');
                        }

                        ?>
                        <?php
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'new_user_form inline-input'],
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{error}{label}{input}</div>'
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'userName')->textInput(['class' => 'span9'])->label('用户账户'); ?>
                        <?= $form->field($model, 'userEmail')->textInput(['class' => 'span9'])->label('用户邮箱'); ?>
                        <?= $form->field($model, 'userPass')->passwordInput(['class' => 'span9'])->label('用户密码'); ?>
                        <?= $form->field($model, 'rePass')->passwordInput(['class' => 'span9'])->label('重复密码'); ?>
                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('创建', ['class' => 'btn-glow primary']); ?>
                            <span>或者</span>
                            <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">

                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧填写用户相关信息，包括用户账号，电子邮箱，以及密码
                    </div>
                    <h6>重要提示：</h6>
                    <p>用户可以管理后台功能模块</p>
                    <p>请谨慎添加</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end main container -->

