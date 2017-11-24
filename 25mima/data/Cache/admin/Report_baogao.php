<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>报告管理</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>报告管理</p>
  <a href='<?php echo U("Report/countZheyeLevel") ?>'>统计特长人数</a>
  <a href='<?php echo U("Report/excel") ?>'>导入报告</a>
  <?php foreach ($data as $v){ ?>
  <a href='<?php echo U("Report/baogao_add/cid/$v[id]") ?>'>添加<?php if(isset($v['name'])){echo $v['name'];} ?></a>
  <?php } ?>
  </div>
  <div class="search" style="padding:15px">
  <form action="<?php echo U('report/baogao') ?>" method='get'>
	<input type="text" name="keyword" />
	<select name="cid">
		<option value="">全部</option>
		<?php foreach ($catechanpin as $vo){ ?>
		<option value="<?php if(isset($vo['id'])){echo $vo['id'];} ?>"><?php if(isset($vo['name'])){echo $vo['name'];} ?></option>
		<?php } ?>
	</select>
	
	<button type="submit">搜索</button>
  </form>
  </div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">所属基因</td>
	  <td width="10%">姓名</td>
	  <td width="10%">出报告时间</td>
      <td width="10%">样品盒编码</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php p($data[$v['cid']]['name']);?></td>
		<td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
		<td><?php echo $v['time5']!=0?date('Y-m-d H:i:s',$v['time5']):'暂没出报告';?></td>
        <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td>
          <?php if(!empty($v['tid'])){ ?>
          <a href="/index/Index/baogao/id/<?php if(isset($v['tid'])){echo $v['tid'];} ?>" target="_blank" title="查看"><img src="/Modules/admin/Tpl/public/images/icon_view.gif" width="16" height="16" border="0" /></a>
          <?php } ?>
          <a href='<?php echo U("Report/baogao_update/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>
          <a href='<?php echo U("/Report/baogao_delete/id/$v[id]") ?>' onclick="if(!confirm('确定删除？')){return false;};" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
          <?php if(empty($v['pdfurl'])) {?>
            <a href='<?php echo U("/Report/baogao_uppdf/id/$v[id]") ?>'  title="上传pdf">
              <img src="/Modules/admin/Tpl/public/images/up.gif" border="0" height="16" width="16" />
            </a>
          <?php } else {?>
            <a href='<?php echo U("/Report/baogao_uppdf/id/$v[id]") ?>'  title="重新上传pdf">
              <img src="/Modules/admin/Tpl/public/images/up.gif" border="0" height="16" width="16" />
            </a>
            <a href='<?php echo U("/Report/downloadpdf/id/$v[id]") ?>'  title="下载pdf">
              <img src="/Modules/admin/Tpl/public/images/down.gif" border="0" height="16" width="16" />
            </a>
          <?php } ?>

          <?php if(!empty($v['token'])) {?>
            <a href='<?php echo U("/Report/baogao_notifythird/id/$v[tid]/uid/$v[uid]") ?>'  title="通知第三方">
              <img src="/Modules/admin/Tpl/public/images/notify.png" border="0" height="30" width="28" />
            </a>
          <?php }?>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>