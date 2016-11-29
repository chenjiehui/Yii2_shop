

    <!-- ============================================================= HEADER : END ============================================================= -->		<!-- ========================================= MAIN ========================================= -->
    <main id="authentication" class="inner-bottom-md">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <section class="section sign-in inner-right-xs">
                        <h2 class="bordered">登录</h2>
                        <p>欢迎您回来，请您输入您的账户名密码</p>
                        <?php
                                if(Yii::$app->session->hasFlash('info'))
                                {
                                    echo Yii::$app->session->getFlash('info');
                                }
                        ?>

                        <div class="social-auth-buttons">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-qq"></i> 使用QQ账号登录</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-weibo"></i> 使用新浪微博账号登录</button>
                                </div>
                            </div>
                        </div>
                        <?php $form=\yii\bootstrap\ActiveForm::begin([

                            'fieldConfig'=>[
                                'template'=>'<div class="field-row">{error}{label}{input}</div>'
                            ],


                        ]);
                        ?>
                        <?=$form->field($model,'loginname')->textInput(['placeholder'=>'请输入用户名或邮箱'])->label('用户名/邮箱') ?>
                        <?=$form->field($model,'userPass')->passwordInput(['placeholder'=>'请输入密码'])->label('用户密码') ?>
                        <?=$form->field($model,'rememberMe')->checkbox()->label('记住我') ?>
                        <a href="<?= \yii\helpers\Url::to(['member/']) ?>">忘记密码</a>
                        <?=\yii\bootstrap\Html::submitButton('登录',['class'=>'le-button huge']) ?>

                        <?php \yii\bootstrap\ActiveForm::end(); ?>

                        <form role="form" class="login-form cf-style-1">



                    </section><!-- /.sign-in -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <section class="section register inner-left-xs">
                        <h2 class="bordered">新建账户</h2>
                        <p>创建一个属于你自己的账户</p>

                        <form role="form" class="register-form cf-style-1">
                            <div class="field-row">
                                <label>电子邮箱</label>
                                <input type="text" class="le-input">
                            </div><!-- /.field-row -->

                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">注册</button>
                            </div><!-- /.buttons-holder -->
                        </form>

                        <h2 class="semi-bold">加入我们您将会享受到前所未有的购物体验 :</h2>

                        <ul class="list-unstyled list-benefits">
                            <li><i class="fa fa-check primary-color"></i> 快捷的购物体验</li>
                            <li><i class="fa fa-check primary-color"></i> 便捷的下单方式</li>
                            <li><i class="fa fa-check primary-color"></i> 更加低廉的商品</li>
                        </ul>

                    </section><!-- /.register -->

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </main><!-- /.authentication -->
    <!-- ========================================= MAIN : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->

