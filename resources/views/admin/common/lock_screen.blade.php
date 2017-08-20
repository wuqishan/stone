<!--锁屏模板 start-->
<script type="text/template" id="lock-temp">
    <div class="admin-header-lock" id="lock-box">
        <div class="admin-header-lock-img">
            <img src="{{ asset('admin/images/0.jpg') }}"/>
        </div>
        <div class="admin-header-lock-name" id="lockUserName">beginner</div>
        <input type="text" class="admin-header-lock-input" value="输入密码解锁.." name="lockPwd" id="lockPwd" />
        <button class="layui-btn layui-btn-small" id="unlock">解锁</button>
    </div>
</script>
<!--锁屏模板 end -->