<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>文章列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>文章列表</p><a href='<?php echo U("/Article/add/cid/$cid") ?>'>添加新文章</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="2%">编号</td>
      <td width="15%">文章标题</td>
      <td width="5%">文章分类</td>
      <td width="10%">文章重要性</td>
      <td width="5%">是否显示</td>
      <td width="5%">排序</td>
      <td width="5%">添加日期</td>
      <td width="5%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td style="text-align:left"><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td><?php if(isset($v['typename'])){echo $v['typename'];} ?></td>
        <td><?php if(isset($v['article_type'])){echo $v['article_type'];} ?></td>
        <td><img src="<?php if($v['is_open']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td><?php if(isset($v['time'])){echo $v['time'];} ?></td>
        <td>
          <a href="<?php echo C('REWRITE_CONTENT') ?><?php if(isset($v['id'])){echo $v['id'];} ?>.html" target="_blank" title="查看"><img src="/Modules/admin/Tpl/public/images/icon_view.gif" border="0" height="16" width="16" /></a>&nbsp;
          <a href='<?php echo U("Article/update/id/$v[id]") ?>' title="编辑"><img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" /></a>&nbsp;
          <a href='<?php echo U("/Article/delete/id/$v[id]") ?>' onclick="if(!confirm('您确认要删除这篇文章吗？')){return false;};" title="移除"><img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16"></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>