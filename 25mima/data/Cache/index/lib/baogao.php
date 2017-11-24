<select onchange='tiaozhuang()' id="select">
	<option value='1'>选择报告</option>
    <option value='/index/Index/baogao'>小天才示例报告</option>
    <option value='/index/Index/baogao/id/2'>特长示例报告</option>
    <option value='/index/Index/baogao/id/5'>肥胖示例报告</option>
</select>
<script>
function tiaozhuang(){
	var url  = $('#select option:selected').val();
	if(url != 1){
		window.location.href=url; 
	}
}
</script>