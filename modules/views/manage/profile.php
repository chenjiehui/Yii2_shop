<!DOCTYPE html>
<html>

<body>
<!-- main container -->
<div class="content">
    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>管理员信息</h3>

            <!-- Users table -->
            <div class="row-fluid table">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span2">
                            管理员ID
                        </th>
                        <th class="span2">
                            <span class="line"></span>管理员账号
                        </th>
                        <th class="span2">
                            <span class="line"></span>管理员密码
                        </th>
                        <th class="span3">
                            <span class="line"></span>管理员邮箱
                        </th>
                        <th class="span3">
                            <span class="line"></span>最后登录IP
                        </th>

                        <th class="span2">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>
                                <?php echo $data->adminId; ?>
                            </td>
                            <td>
                                <?php echo $data->adminUser; ?>
                            </td>
                            <td>
                                <?php echo $data->adminPass; ?>
                            </td>
                            <td>
                                <?php echo $data->adminEmail; ?>
                            </td>
                            <td>
                                <?php echo long2ip($data->loginIp); ?>
                            </td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to(['manage/modify','adminId'=>$data->adminId]);?>">修改信息</a>
                            </td>

                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <!-- end main container -->

</body>

</html>