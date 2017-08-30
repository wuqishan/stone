<div class="layui-header header header-demo">
    <div class="layui-main">
        <div class="admin-login-box">
            <a class="logo" style="left: 0;" href="http://beginner.zhengjinfan.cn/demo/beginner_admin/">
                <span style="font-size: 22px;">BeginnerAdmin</span>
            </a>
            <div class="admin-side-toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="admin-side-full">
                <i class="fa fa-life-bouy" aria-hidden="true"></i>
            </div>
            <div class="admin-refresh-iframe">
                <i class="layui-icon layui-anim" aria-hidden="true">&#x1002;</i>
            </div>
        </div>
        <ul class="layui-nav admin-header-item" id="menu">
            <li class="layui-nav-item">
                <a href="javascript:;" module-id="0">内容管理</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;" module-id="1">网站管理</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">清除缓存</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">浏览网站</a>
            </li>
            <li class="layui-nav-item" id="video1">
                <a href="javascript:;">视频</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;" class="admin-header-user">
                    <img src="{{ asset('admin/images/0.jpg') }}" />
                    <span>beginner</span>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;"><i class="fa fa-user-circle" aria-hidden="true"></i> 个人信息</a>
                    </dd>
                    <dd>
                        <a href="javascript:;"><i class="fa fa-gear" aria-hidden="true"></i> 设置</a>
                    </dd>
                    <dd id="lock">
                        <a href="javascript:;">
                            <i class="fa fa-lock" aria-hidden="true" style="padding-right: 3px;padding-left: 1px;"></i> 锁屏 (Alt+L)
                        </a>
                    </dd>
                    <dd>
                        <a href="login.html"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
                    </dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav admin-header-item-mobile">
            <li class="layui-nav-item">
                <a href="login.html"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
            </li>
        </ul>
    </div>
</div>