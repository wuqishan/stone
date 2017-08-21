@extends('admin.common.base')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/global.css') }}" media="all">
@show
@section('content')

    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <h1>Laytpl + Laypage结合动态渲染数据并分页</h1></blockquote>
        <fieldset class="layui-elem-field">
            <legend>演示</legend>
            <div class="layui-field-box">
                <div>
                    <form>
                        <input type="text" name="name"/>
                        <button type="button" id="search">搜索</button>
                    </form>
                    <table class="site-table table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="selected-all"></th>
                            <th>姓名</th>
                            <th>年龄</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <!--内容容器-->
                        <tbody id="con">
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Layui</td>
                            <td>Beginner</td>
                            <td>2016-11-16 11:50</td>
                            <td>
                                <a href="/detail-1" target="_blank"
                                   class="layui-btn layui-btn-normal layui-btn-mini">预览</a>
                                <a href="/manage/article_edit_1" class="layui-btn layui-btn-mini">编辑</a>
                                <a href="javascript:;" data-id="1" data-opt="del"
                                   class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--分页容器-->
                    <div id="paged"></div>
                </div>
            </div>
        </fieldset>
    </div>

@endsection

@section('js')
    @parent
    <script>

            //搜索
            $('#search').on('click', function () {
                var $this = $(this);
                var name = $this.prev('input[name=name]').val();
                if (name === '' || name.length === 0) {
                    layer.msg('请输入关键字！');
                    return;
                }
                //调用get方法获取数据
                paging.get({
                    t: Math.random(),
                    name: name //获取输入的关键字。
                });
        });
    </script>
@endsection