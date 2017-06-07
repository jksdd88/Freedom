<?php
/* Smarty version 3.1.30, created on 2017-01-12 11:11:41
  from "E:\AMP\www\FreedomPHP\app1\views\new_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5877565d88fbf5_28364048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c982255db2d92f221ebdd34ced221a00045ba85' => 
    array (
      0 => 'E:\\AMP\\www\\FreedomPHP\\app1\\views\\new_header.tpl',
      1 => 1484016118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:new_publics.tpl' => 1,
  ),
),false)) {
function content_5877565d88fbf5_28364048 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
">
    <meta name="Description" content="<?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
">
    <?php echo $_smarty_tpl->tpl_vars['robots']->value;?>

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <?php $_smarty_tpl->_subTemplateRender("file:new_publics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body>
<!--头部开始-->
<div class="header-space"></div>
<div class="header_new">
    <div class="header_box_new">
        <a href="javascript:;" class="logo_new">点点客</a>
        <ul id="nav" class="nav_new">
            <li><a href="/index" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "index") {?>now_new<?php }?>">首页</a></li>
            <li class="nav-child_new" id="t-pro">
                <a href="/prouducts/index" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "prouducts") {?>now_new<?php }?>">产品<i></i></a>
                <!--产品与服务展开开始-->
                <div id="nav-hover" class="nav-hover_new">
                    <div class="nav-hover-bg_new"></div>
                    <div class="nav-hover-inner_new">
                        <ul  class="nav-hover-inner-list_new">
                            <li>
                                <!-- <h2 class="nav-h2-txt1_new">商品电商软件</h2> -->
                                <div class="nav-cont_new">
                                    
                                    <a href="/landingpage/rrd" class="nav-cont-box_new mb20"><h2 class="nav-h2-txt2_new">人人店-适合商品类电商 </h2>
                                        <h3 class="nav-h3-txt_new">店铺装修深度自定义</h3>
                                        <h3 class="nav-h3-txt_new">多组合营销工具可全网营销</h3>
                                        <h3 class="nav-h3-txt_new">数据魔方提供店铺分析</h3>
                                        <h3 class="nav-h3-txt_new">一键分销快速裂变销售网络</h3></a>
                                    <a href="/industryedition/store" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">微小店-适合入门级电商</h2>
                                        <h3 class="nav-h3-txt_new">永久免费</h3>
                                        <h3 class="nav-h3-txt_new">海量装修模板，一键搬家</h3>
                                        <h3 class="nav-h3-txt_new">智脑数据库，助力完成运营数据策略</h3>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">服务电商O2O</h2>-->
                                <div class="nav-cont_new">
                                    <a href="/landingpage/arrivals" class="nav-cont-box_new mb20"><h2 class="nav-h2-txt2_new">到店-适合服务类企业</h2>
                                        <h3 class="nav-h3-txt_new">支付、WIFI等多入口用户沉淀</h3>
                                        <h3 class="nav-h3-txt_new">会员个性化营销，提高复购率</h3>
                                        <h3 class="nav-h3-txt_new">拼团推客分享优惠、裂变营销老带新</h3>
                                        <h3 class="nav-h3-txt_new">大数据中心，全方位解决运营数据</h3></a>
                                    <a href="/landingpage/wsy" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">微商易-更适合微商企业</h2>
                                        <h3 class="nav-h3-txt_new">为微商企业提供品牌、运营、团队</h3>
                                        <h3 class="nav-h3-txt_new">管理、财务一体化解决方案</h3>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">广义电商软件</h2>-->
                                <div class="nav-cont_new">
                                    <a href="/landingpage/panda" class="nav-cont-box_new mb20"><h3 class="nav-h2-txt2_new">熊猫优惠-适合服务类企业 </h3>
                                        <h3 class="nav-h3-txt_new">熊猫支付:五码合一，一码付</h3>
                                        <h3 class="nav-h3-txt_new">熊猫伙伴:支付即粉丝支付即营销</h3>
                                        <h3 class="nav-h3-txt_new">熊猫商圈:发现身边精致生活</h3>
                                    </a>
                                    <a href="/landingpage/whb" class="nav-cont-box_new f-mgt2"><h3 class="nav-h2-txt2_new">微伙伴</h3>
                                        <h3 class="nav-h3-txt_new">微信官网及多种营销工具</h3>
                                        <h3 class="nav-h3-txt_new">多个行业版本</h3>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">移动广告投放</h2>-->
                                <div class="nav-cont_new">
                                    <a href="javascript:;" class="nav-cont-box_new"><h3 class="nav-h2-txt2_new">
                                        免费工具</h3>
                                        <a href="/index/saomalogin?type=1" class="nav-cont-box_new"><h3 class="nav-h3-txt_new font16">微排版</h3></a>
                                        <a href="/index/saomalogin?type=2" class="nav-cont-box_new"><h3 class="nav-h3-txt_new font16">微名片</h3></a>
                                    </a>
                                </div>
                            </li>

                            <!--
                            <li>
                                <h2 class="nav-h2-txt1_new">移动广告投放</h2>
                                <div class="nav-cont_new">
                                    <a href="/internetadteam/landing" class="nav-cont-box_new"><h3 class="nav-h2-txt2_new">品牌类广告投放 </h3><h3 class="nav-h3-txt_new">提升品牌知名度</h3></a>
                                    <a href="/internetadteam/landing" class="nav-cont-box_new"><h3 class="nav-h2-txt2_new">效果类广告投放</h3><h3 class="nav-h3-txt_new">提升产品销售额</h3></p></a>
                                    <a href="/internetadteam/landing" class="nav-cont-box_new"><h3 class="nav-h2-txt2_new">所有广告产品</h3><h3 class="nav-h3-txt_new">移动平台广告投放</h3></p></a>
                                </div>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>
                <!--产品与服务展开结束-->
            </li>
            <li id="service">
                <a href="javascript:;" class="nav-li_new">服务<i></i></a>
                <div class="nav-hover_new">
                    <div class="nav-hover-bg_new"></div>
                    <div class="nav-hover-inner_new">
                        <ul class="nav-hover-inner-list_new">
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">商品电商软件</h2>-->
                                <div class="nav-cont_new">
                                    <a href="http://www.rrdshang.com/" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        人人电商学院 </h2></a>
                                    <a href="javascript:goTalk();" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        售前咨询 </h2></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li id="t-case">
                <a href="javascript:;" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "mod") {?>now_new<?php }?>">案例<i></i></a>
                <div class="nav-hover_new">
                    <div class="nav-hover-bg_new"></div>
                    <div class="nav-hover-inner_new">
                        <ul class="nav-hover-inner-list_new">
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">商品电商软件</h2>-->
                                <div class="nav-cont_new">
                                    <a href="javascript:;" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        案例中心 </h2></a>
                                    <a href="/modrrd" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        人人店案例 </h2></a>
                                    <a href="/mod" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        微伙伴案例 </h2></a>
                                </div>
                            </li>
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">商品电商软件</h2>-->
                                <div class="nav-cont_new">
                                    <a href="javascript:;" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        干货帮 </h2></a>
                                    <a href="/dry" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        创收类 </h2></a>
                                    <a href="/dry" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        获客类 </h2></a>
                                    <a href="/dry" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        转化类 </h2></a>
                                    <a href="/dry" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        复购类 </h2></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!--干货与案例展开结束-->
            <li id="loginMenu_new" data-line="none">
                <a href="javascript:;"><span>登录</span> </a>
                <div class="loginMenu-hover_new">
                    <div class="loginMenu-hover-left_new">
                        <a href="http://supplier.wsy188.com/login" target="_blank" rel="nofollow" title="微商易"><span>微商易</span></a>
                        <a href="javascript:;" class="login_btn" target="_blank" title="微伙伴"><span style="padding-left:0;">微伙伴</span></a>
                        <a href="/index/saomalogin?type=1" title="微排版"><span>微排版</span></a>
                        <a href="/index/saomalogin?type=2" title="微名片"><span>微名片</span></a>
                        <a href="http://dj.hf-dodoca.com" target="_blank"title="登录店+"><span>登录店+</span></a>
                    </div>
                    <div class="loginMenu-hover-right_new">
                        <a href="http://mch.wxrrd.com/auth/login" class="login-rrd_new" title="登录人人店" target="_blank">登录人人店 </a>
                        <a href="http://www.daodian100.com/login" class="login-dd_new" title="登录到店" target="_blank">登录到店</a>
                        <a href="http://mch.ddkwxd.com/auth/login" class="login-whb_new" title="登录微小店">登录微小店</a>
                    </div>
                </div>
            </li>
            <li><a href="/internetadteam/landing" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "ad") {?>now_new<?php }?>">广告</a></li>
            <li><a href="/channel/index" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "qudaozs") {?>now_new<?php }?>">软件代理</a></li>
            <li id="t-wm"><a href="javascript:;" class="nav-li_new <?php if ($_smarty_tpl->tpl_vars['tab_index']->value == "about") {?>now_new<?php }?>">我们</a>
                <div class="nav-hover_new">
                    <div class="nav-hover-bg_new"></div>
                    <div class="nav-hover-inner_new">
                        <ul class="nav-hover-inner-list_new">
                            <li>
                                <!--<h2 class="nav-h2-txt1_new">商品电商软件</h2>-->
                                <div class="nav-cont_new">
                                    <a href="/about/about" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        关于点点客 </h2></a>
                                    <a href="/about/employee" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        员工与环境 </h2></a>
                                    <a href="/about/job" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        工作机会 </h2></a>
                                    <a href="/about/contact" class="nav-cont-box_new"><h2 class="nav-h2-txt2_new">
                                        联系我们 </h2></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="t-line"></li>
        </ul>
    </div>
</div>
<!--头部结束-->
<!--
<div class="help_box" style="display:none; background-image: url(<?php echo $_smarty_tpl->tpl_vars['source_domain']->value;?>
/whb/pc/site/images/r_float_bg.png);">
    
    <div class="u-qq" id="docaht_wsl_open" style="cursor:pointer;opacity:1;">
        <h3 id="consultation" style="margin-top:-8px;margin-left:-9px; height: 20px; width: 110px;" class="free_go">在线咨询</h3>
    </div>
    
    <a class="free_go" href="javascript:;">服务热线</a>
    <b id="custel" class="tels">40088 15150</b>
    <a id="tryOut" href="/index/reg" target="_blank"><h3>免费试用</h3></a>
    <a  href="/guidefront/index" target="_blank"><h3>产品指南</h3></a>
    <a href="/channel/index" id="help_qq">软件代理</a>

    <div id="qq_list" style="width:300px; height:65px;padding-left: 20px;">
        <a href="javascript:;" class="close_qq"></a>
        <div class="area_qq" style="width:265px;">
            <p class="bg_gray" style="float:none;width:230px;"><b>田经理</b><span> 18302120067</span><a href="http://wpa.qq.com/msgrd?v=3&uin=2966145273&site=dodocawebot&menu=yes" class="qq_ico">2966145273</a></p>
            <p class="bg_gray" style="float:none;width:230px;"><b>杨经理</b><span> 15800550061</span><a href="http://wpa.qq.com/msgrd?v=3&uin=1253707072&site=dodocawebot&menu=yes" class="qq_ico">1253707072</a></p>
        </div>
    </div>
</div>
-->
<div class="t-zxzc">
    <div class="t-kf u-qq" id="docaht_wsl_open"><img src="<?php echo $_smarty_tpl->tpl_vars['source_domain']->value;?>
/whb/pc/site/images/index/t-e1.png"><p>在线支持</p></div>
    <a class="t-phone tels " id="custel">4008815150<p class="font14 grey999 f-tac">热线电话</p></a>
</div>
<!--登录开始-->
<div id="login_box" style="display:none;height:290px;">
    <ul>
        <li class="user_li"><input type="text" name="username" id="username_login" value="" class="input1" placeholder="请输入登录帐号"></li>
        <li class="user_li pwd_li"><input type="password" name="password" id="password_login"  value="" class="input1" placeholder="请输入密码"></li>
        <li class="user_li" style="background-position: -16px -93px;">
            <input type="text" name="verify" id="verify_login"  value="" class="input1" placeholder="请输入验证码" style="width:135px">
            <img id="img_imgcode" class="imgcode"  title="点击刷新" src="" style="cursor: pointer;margin-bottom: -15px;margin-left: -2px; width: 50px;height: 38px;float:right;" onclick="javascript:imcref();"/>
        </li>
        <li class="get_li">
            <label class="lab1"><input type="checkbox" name="is_rem" id="is_rem" checked="true" class="input3">记住密码</label>
            <a href="/index/resetpsd" target="_blank" class="forget-pw" id="forget-pw-safe">忘记密码?</a>
        </li>
        <li><input style="cursor:pointer;" type="button" onclick="iframe_win();" class="input4" value="登录" /></li>
    </ul>
    <div id="close_login"></div>
</div>
<?php echo '<script'; ?>
>

    function imcref(){
        $('#img_imgcode').attr('src','/icv/imgcode?'+Math.random());
    }
    $(function(){
        imcref();
    });
<?php echo '</script'; ?>
>
<!--登录结束--><?php }
}
