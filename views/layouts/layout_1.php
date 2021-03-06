<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>京西商城</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="/basic/web/assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="/basic/web/assets/css/main.css">
    <link rel="stylesheet" href="/basic/web/assets/css/red.css">
    <link rel="stylesheet" href="/basic/web/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/basic/web/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="/basic/web/assets/css/animate.min.css">


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="/basic/web/assets/css/font-awesome.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/basic/web/assets/images/favicon.ico">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="/basic/web/assets/js/html5shiv.js"></script>
    <script src="/basic/web/assets/js/respond.min.js"></script>
    <![endif]-->


</head>
<body>

<div class="wrapper">
    <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <nav class="top-bar animate-dropdown">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['index/index'])?>">首页</a></li>

                    <li><a href="<?=\yii\helpers\Url::to(['cart/index'])?>">我的购物车</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['order/index'])?>">我的订单</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 no-margin">
                <ul class="right">
                    <?php if(Yii::$app->session['isLogin']==1):?>
                        欢迎您:<?= Yii::$app->session['loginname'];?><a href="<?=\yii\helpers\Url::to(['member/logout']) ?>">退出</a>
                    <?php else :?>
                        <li><a href="<?= \yii\helpers\Url::to(['member/sign-up']) ?>">注册</a></li>
                        <li><a href="<?= yii\helpers\Url::to(['member/auth']); ?>">登录</a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.container -->
    </nav><!-- /.top-bar -->
    <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
    <header>

        <div class="container no-padding">

            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo">
                    <a href="<?=\yii\helpers\Url::to(['index/index'])?> ">
                        <img alt="logo" src="/basic/web/assets/images/logo.PNG" width="233" height="54"/>
                    </a>
                </div><!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
                <div class="contact-row">
                    <div class="phone inline">
                        <i class="fa fa-phone"></i> 18188600860
                    </div>
                    <div class="contact inline">
                        <i class="fa fa-envelope"></i> chenjiehui0919@<span class="le-color">163.com</span>
                    </div>
                </div><!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <form>
                        <div class="control-group">
                            <input class="search-field" placeholder="搜索商品" />

                            <ul class="categories-filter animate-dropdown">
                                <li class="dropdown">

                                    <a class="dropdown-toggle"  data-toggle="dropdown">商品分类</a>

                                    <ul class="dropdown-menu" role="menu" >
                                        <?php
                                        foreach($this->params['menu'] as $top) :
                                        ?>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" ><?=$top['title'];?></a></li>
                                        <?php endforeach;?>
                                    </ul>

                                </li>
                            </ul>

                            <a style="padding:15px 15px 13px 12px" class="search-button" href="#" ></a>

                        </div>
                    </form>
                </div><!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
                <div class="top-cart-row-container">

                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                    <div class="top-cart-holder dropdown animate-dropdown">

                        <div class="basket">

                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="basket-item-count">
                                    <span class="count">2</span>
                                    <img src="/basic/web/assets/images/icon-cart.png" alt="" />
                                </div>

                                <div class="total-price-basket">
<!--                                    <span class="lbl">购物车</span>-->
                    <span class="total-price">
                        <span class="sign"></span><span class="value">购物车</span>
                    </span>
                                </div>
                            </a>

                            <ul class="dropdown-menu">
                                <?php foreach($this->params['cart'] as $k=>$pro): ?>
                                <li>
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 no-margin text-center">
                                                <div class="thumb">
                                                    <img alt="" src="/basic/web/assets/images/products/product-small-01.jpg" />
                                                </div>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 no-margin">
<!--                                                <div class="title">--><?//=$product['title']?><!--</div>-->
                                                <div class="price"><?=$pro['price']?></div>
                                            </div>
                                        </div>
                                        <a class="close-btn" href="#"></a>
                                    </div>
                                </li>
                                <?php endforeach;?>






                                <li class="checkout">
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <a href="<?=\yii\helpers\Url::to(['cart/index'])?>" class="le-button inverse">查看购物车</a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <a href="<?=\yii\helpers\Url::to(['order/check'])?>" class="le-button">去往收银台</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div><!-- /.basket -->
                    </div><!-- /.top-cart-holder -->
                </div><!-- /.top-cart-row-container -->
                <!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

        </div><!-- /.container -->
    </header>

<?php echo $content?>

        <footer id="footer" class="color-bg">

            <div class="container">
                <div class="row no-margin widgets-row">
                    <div class="col-xs-12  col-sm-4 no-margin-left">
                        <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                        <div class="widget">
                            <h2>推荐商品</h2>

                            <div class="body">
                                <ul>
                                <?php foreach( $this->params['tui'] as $pro):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="single-product.html"><?= $pro['title']?></a>
                                                <div class="price">
                                                    <div class="price-prev"><?= $pro['price']?></div>
                                                    <div class="price-current"><?= $pro['saleprice']?></div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="#" class="thumb-holder">
                                                    <img alt="" src="/basic/web/assets/images/blank.gif" data-echo="<?php echo $pro['cover'] ?>-covermiddle" />
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>



                                </ul>
                            </div><!-- /.body -->
                        </div> <!-- /.widget -->
                        <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-4 ">
                        <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                        <div class="widget">
                            <h2>促销商品</h2>
                            <div class="body">
                                <ul>
                                    <?php foreach( $this->params['sale'] as $pro):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="single-product.html"><?= $pro['title']?></a>
                                                <div class="price">
                                                    <div class="price-prev"><?= $pro['price']?></div>
                                                    <div class="price-current"><?= $pro['saleprice']?></div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="#" class="thumb-holder">
                                                    <img alt="" src="/basic/web/assets/images/blank.gif" data-echo="<?php echo $pro['cover'] ?>-covermiddle" />
                                                </a>
                                            </div>
                                        </div>

                                    </li>
                                    <?php endforeach;?>

                                </ul>
                            </div><!-- /.body -->
                        </div> <!-- /.widget -->
                        <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-4 ">
                        <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                        <div class="widget">
                            <h2>最新商品</h2>
                            <div class="body">
                                <ul>
                                    <?php foreach( $this->params['new'] as $pro):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="single-product.html"><?= $pro['title']?></a>
                                                <div class="price">
                                                    <div class="price-prev"><?= $pro['price']?></div>
                                                    <div class="price-current"><?= $pro['saleprice']?></div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="#" class="thumb-holder">
                                                    <img alt="" src="/basic/web/assets/images/blank.gif" data-echo="<?php echo $pro['cover'] ?>-covermiddle" />
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endforeach;?>

                                </ul>
                            </div><!-- /.body -->
                        </div><!-- /.widget -->
                        <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

                </div><!-- /.widgets-row-->
            </div><!-- /.container -->

            <div class="sub-form-row">
                <!--<div class="container">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                        <form role="form">
                            <input placeholder="Subscribe to our newsletter">
                            <button class="le-button">Subscribe</button>
                        </form>
                    </div>
                </div>--><!-- /.container -->
            </div><!-- /.sub-form-row -->

            <div class="link-list-row">
                <div class="container no-padding">
                    <div class="col-xs-12 col-md-4 ">
                        <!-- ============================================================= CONTACT INFO ============================================================= -->
                        <div class="contact-info">
                            <div class="footer-logo">
                                <img alt="logo" src="/basic/web/assets/images/logo.PNG" width="233" height="54"/>
                            </div><!-- /.footer-logo -->

                            <p class="regular-bold"> 请通过电话，电子邮件随时联系我们</p>

                            <p>
                                南山区科技园12栋, 深圳市南山区, 中国
                                <br>
                            </p>

                            <!--<div class="social-icons">
                                <h3>Get in touch</h3>
                                <ul>
                                    <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-pinterest"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-stumbleupon"></a></li>
                                    <li><a href="#" class="fa fa-dribbble"></a></li>
                                    <li><a href="#" class="fa fa-vk"></a></li>
                                </ul>
                            </div>--><!-- /.social-icons -->

                        </div>
                        <!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

                    <div class="col-xs-12 col-md-8 no-margin">
                        <!-- ============================================================= LINKS FOOTER ============================================================= -->
                        <div class="link-widget">
                            <div class="widget">
                                <h3>购物指南</h3>
                                <ul>
                                    <li><a href="category-grid.html">购物流程</a></li>
                                    <li><a href="category-grid.html">会员介绍</a></li>
                                    <li><a href="category-grid.html">生活团购</a></li>
                                    <li><a href="category-grid.html">常见问题</a></li>
                                    <li><a href="category-grid.html">大家电</a></li>
                                    <li><a href="category-grid.html">联系客服</a></li>

                                </ul>
                            </div><!-- /.widget -->
                        </div><!-- /.link-widget -->

                        <div class="link-widget">
                            <div class="widget">
                                <h3>配送方式</h3>
                                <ul>
                                    <li><a href="category-grid.html">上门自提</a></li>
                                    <li><a href="category-grid.html">限时送达</a></li>
                                    <li><a href="category-grid.html">服务查询</a></li>
                                    <li><a href="category-grid.html">配送费收取标准</a></li>
                                    <li><a href="category-grid.html">海外配送</a></li>
                                    <li><a href="category-grid.html">快递查询</a></li>

                                </ul>
                            </div><!-- /.widget -->
                        </div><!-- /.link-widget -->

                        <div class="link-widget">
                            <div class="widget">
                                <h3>售后服务</h3>
                                <ul>
                                    <li><a href="category-grid.html">售后政策</a></li>
                                    <li><a href="category-grid.html">价格保护</a></li>
                                    <li><a href="category-grid.html">退款说明</a></li>
                                    <li><a href="category-grid.html">返修/退换货</a></li>
                                    <li><a href="category-grid.html">取消订单</a></li>
                                    <li><a href="category-grid.html">常见问题</a></li>

                                </ul>
                            </div><!-- /.widget -->
                        </div><!-- /.link-widget -->
                        <!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
                </div><!-- /.container -->
            </div><!-- /.link-list-row -->

            <div class="copyright-bar">
                <div class="container">
                    <div class="col-xs-12 col-sm-6 no-margin">
                        <div class="copyright">
                            &copy; <a href="index.html">chenjiehui</a> - all rights reserved
                        </div><!-- /.copyright -->
                    </div>
                    <div class="col-xs-12 col-sm-6 no-margin">
                        <div class="payment-methods ">
                            <ul>
                                <li><img alt="" src="/basic/web/assets/images/payments/payment-visa.png"></li>
                                <li><img alt="" src="/basic/web/assets/images/payments/payment-master.png"></li>
                                <li><img alt="" src="/basic/web/assets/images/payments/payment-paypal.png"></li>
                                <li><img alt="" src="/basic/web/assets/images/payments/payment-skrill.png"></li>
                            </ul>
                        </div><!-- /.payment-methods -->
                    </div>
                </div><!-- /.container -->
            </div><!-- /.copyright-bar -->

        </footer><!-- /#footer -->
        <!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="/basic/web/assets/js/jquery-1.10.2.min.js"></script>
<script src="/basic/web/assets/js/jquery-migrate-1.2.1.js"></script>
<script src="/basic/web/assets/js/bootstrap.min.js"></script>
<script src="/basic/web/assets/js/gmap3.min.js"></script>
<script src="/basic/web/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="/basic/web/assets/js/owl.carousel.min.js"></script>
<script src="/basic/web/assets/js/css_browser_selector.min.js"></script>
<script src="/basic/web/assets/js/echo.min.js"></script>
<script src="/basic/web/assets/js/jquery.easing-1.3.min.js"></script>
<script src="/basic/web/assets/js/bootstrap-slider.min.js"></script>
<script src="/basic/web/assets/js/jquery.raty.min.js"></script>
<script src="/basic/web/assets/js/jquery.prettyPhoto.min.js"></script>
<script src="/basic/web/assets/js/jquery.customSelect.min.js"></script>
<script src="/basic/web/assets/js/wow.min.js"></script>
<script src="/basic/web/assets/js/scripts.js"></script>
<!--<script>-->
<!--    $("#createlink").click(function(){-->
<!--        $(".billing-address").slideDown();-->
<!--    });-->
<!---->
<!--</script>-->
<script>
    $("#createlink").click(function(){
        $(".billing-address").slideDown();
    });
    $(".minus").click(function(){
        var cartid = $("input[name=productnum]").attr('id');
        var num = parseInt($("input[name=productnum]").val()) - 1;
        if (parseInt($("input[name=productnum]").val()) <= 1) {
            var num = 1;
        }
        var total = parseFloat($(".value.pull-right span").html());
        var price = parseFloat($(".price span").html());
        changeNum(cartid, num);
        var p = total - price;
        if (p < 0) {
            var p = "0";
        }
        $(".value.pull-right span").html(p + "");
        $(".value.pull-right.ordertotal span").html(p + "");
    });
    $(".plus").click(function(){
        var cartid = $("input[name=productnum]").attr('id');
        var num = parseInt($("input[name=productnum]").val()) + 1;
        var total = parseFloat($(".value.pull-right span").html());
        var price = parseFloat($(".price span").html());
        changeNum(cartid, num);
        var p = total + price;
        $(".value.pull-right span").html(p + "");
        $(".value.pull-right.ordertotal span").html(p + "");
    });
    function changeNum(cartid, num)
    {
        $.get('<?php echo yii\helpers\Url::to(['cart/mod']) ?>', {'productnum':num, 'cartid':cartid}, function(data){
            location.reload();
        });
    }
    var total = parseFloat($("#total span").html());
    $(".le-radio.express").click(function(){
        var ototal = parseFloat($(this).attr('data')) + total;
        $("#ototal span").html(ototal);
    });
    $("input.address").click(function(){
        var addressid = $(this).val();
        $("input[name=addressid]").val(addressid);
    });
</script>

</body>
</html>



