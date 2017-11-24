<select onchange='tiaozhuang()' id="select">
	<option value='1'>选择报告</option>
	<?php foreach ($baogao as $v){ ?>
    <option value='<?php echo U("/Index/baogao/id/$v[id]") ?>'><?php if(isset($v['name'])){echo $v['name'];} ?></option>
    <?php } ?>
</select>
<script>
function tiaozhuang(){
	var url  = $('#select option:selected').val();
	if(url != 1){
		window.location.href=url; 
	}
}
</script>