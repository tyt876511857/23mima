<?php
Class GoodsAction extends CommonAction{
	protected $_auto = array(
                            array('goods_brief','value',''),
                            array('is_best','value','0'),
                            array('brand_id','value','0'),
                            array('is_new','value','0'),
                            array('is_hot','value','0'),
                            array('is_on_sale','value','0'),
                            array('is_alone_sale','value','0'),
                            array('is_shipping','value','0'),
                            array('click','value','50'),
							array('goods_number','value','100'),
                            array('goods_weight','value','0')
                            );
	//验证数据安全
	protected $_valid = array(
		array('goods_name',1,'必须有商品名','require'),
		array('goods_img',1,'必须有商品图片','require'),
        array('cat_id',1,'请选择栏目','non_zero'),
		array('click',1,'点击数必须是数字','number'),
		array('goods_number',1,'库存量必须是数字','number'),
    );
    public function __construct(){
    	parent::__construct();
		$this->table  = $this->goods;
		$this->fields = $this->db->desc_field($this->table);
	}
	//递归生成商品货号
	private function sn($id,$gid,$table){
		$sn = 'GS';							//商品货号前缀
		//生成商品货号码
		$str = 'QWERTYUIOPASDFGHJKLZXCVBNM';
		$sn = $sn . substr($str,rand(1,25),1) . $id;
		//查找数据库是否有相同货号
		$sql = 'select goods_id from '.$table.' where goods_sn=\''.$sn .'\' and goods_id<>'.$gid;
		$num = $this->db->getNum($sql);
		//如果有相同货号则重新生成
		if($num==0){
			return $sn;
		}else{
			return self::sn($id,$gid,$table);
		}
	}
	//获取商品类型
	private function goodsType(){
		$sql = 'select cat_id,typename from '.$this->goods_type.' where enabled=1';
		return $this->db->getAll($sql);
	}
	//整合数据
	protected function verify($goods_img,$goods_thumb){
		//如果有上传图片时取上传的图片、否则取文本框里的路径
		$_POST[$goods_img] = empty($_FILES[$goods_img]['name'])?$_POST['textfield']:Upload::up($goods_img);
		//判断是否有上传缩略图
		if(empty($_FILES[$goods_thumb]['name'])){//没有上传缩略图
			//如果有上传大图片则取处理上传的大图片、否则取文本框里的路径
			$cache_config = $this->shop_config();//调用商店系统配置
			$_POST[$goods_thumb] = empty($_FILES[$goods_img]['name'])?$_POST['textfield1']:Images::resizeimage($_POST[$goods_img],$cache_config['cfg_thumb_width'],$cache_config['cfg_thumb_height']);
		}else{//缩略图有上传图片时
			$_POST[$goods_thumb] = Upload::up($goods_img);
		}
		return parent::verify();
	}
	public function data($is_delete='0',$cid = 0,$pagesize='15'){
		$where = '';
		if($cid!=0){
			$list = $this->shop_goods_list();
			$list = Category::getChildsId($list,$cid);
			$list[]=$cid;
			$list = implode($list,',');
			$where = ' and cat_id in ('.$list.') ';
		}
		$sql = 'select goods_id from '.$this->table.' where is_delete='.$is_delete.$where;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,g.rank,goods_number,typename from '.$this->table.' as g left join '.$this->category.' as c on g.cat_id=c.id where is_delete='.$is_delete.$where.' order by goods_id desc limit '.$page*$pagesize.','.$pagesize;
		return $this->db->getAll($sql);
	}
	
	public function jlist(){
		$pagesize=30;
		$sql = 'select id from gs_goodspo ';
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select p.*,g.goods_name from gs_goodspo as p left join '.$this->table.' as g on p.gid=g.goods_id  order by p.gid asc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	
	public function jadd(){
		$sql = 'select goods_id as id,goods_name from '.$this->table.' where is_delete=0';
		$this->cgoods = $this->db->getAll($sql);
		$this->display();
	}
	
	public function jupdate(){
		
		$id = $this->get_id();
		$sql = 'select goods_id as id,goods_name from '.$this->table.' where is_delete=0';
		$this->cgoods = $this->db->getAll($sql);
		$Unfiltered=array('thumb','pdesc');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->goodspo,$id,$Unfiltered);
		
		$this->display('jadd');
	}
	
	//获取栏目、品牌、类型
	private function subjoin(){
		$cate = $this->shop_goods_list();
		$data[] = Category::multidimensional($cate);
		$brand_sql = 'select brand_id,brand_name from '.$this->brand;
		$data[] = $this->db->getAll($brand_sql);
		return $data;
	}
	public function index(){
		$id = empty($_GET['id'])?0:$_GET['id']+0;
		$this->list = $this->data(0,$id);
		$this->display();
	}
	//回收站 
	public function recycle(){
		$this->list = $this->data(1);
		$this->display();
	}
	//删除到回收站/还原
	public function totrack(){
		$type = (int) $_GET['type'];
		$msg  = $type ? '移入' : '还原';
		$id = $this->get_id();
		//删除的话把购物车的删除掉
		if($type){
			$sql = 'delete from '.$this->shopping.' where indent_id=0 and goods_id='.$id;
			$this->db->query($sql);
		}
		unlink(CACHE.'shop_goods.php');// 删除缓存
		$sql = 'update '.$this->goods.' set is_delete='.$type.' where goods_id='.$id;
		if($this->db->query($sql)){
			$this->success($msg.'成功',U('/Goods/index'));
		}

	}
	//彻底删除
	public function delete(){
		$id = $this->get_id();
		$sql = 'delete g,a,ga,gr from '.$this->goods.' g left join '.$this->goods_attr.' a on g.goods_id=a.goods_id left join '.$this->goods_gallery.' ga on g.goods_id=ga.goods_id left join '.$this->goods_group.' gr on g.goods_id=gr.goods_id where g.goods_id='.$id;
		$r = $this->db->query($sql);
		//事务
		//$r[] = 'delete from '.$this->goods .' where '.$this->db->desc_pri($this->goods).'='.$id;	//删除对应商品
		//$r[] = 'delete from '.$this->goods_attr .' where goods_id='.$id;			//删除对应商品属性
		//$r[] = 'delete from '.$this->goods_gallery .' where goods_id='.$id;			//删除对应商品相册
		//$r[] = 'delete from '.$this->goods_group .' where goods_id='.$id;			//删除对应商品搭配
		//$r = Tran($r);
		if($r){
			$this->success('删除成功！',U('/Goods/index'));
		}
	}
	
	//彻底删除
	public function jdelete(){
		$id = $this->get_id();
		$sql = 'delete from '.$this->goodspo.'  where id='.$id;
		$r = $this->db->query($sql);
		//事务
		//$r[] = 'delete from '.$this->goods .' where '.$this->db->desc_pri($this->goods).'='.$id;	//删除对应商品
		//$r[] = 'delete from '.$this->goods_attr .' where goods_id='.$id;			//删除对应商品属性
		//$r[] = 'delete from '.$this->goods_gallery .' where goods_id='.$id;			//删除对应商品相册
		//$r[] = 'delete from '.$this->goods_group .' where goods_id='.$id;			//删除对应商品搭配
		//$r = Tran($r);
		if($r){
			$this->success('删除成功！',U('/Goods/jlist'));
		}
	}
	
	//删除相册图片
	public function dele_gallery(){
		$id = $this->get_id();
		$r = $this->db->delete($this->goods_gallery,$id);
		$r?redirect():$this->error('删除失败');
	}
	public function add(){
		$this->cache_goods_list = $this->shop_goods();
		list($this->cate,$this->brand) = $this->subjoin();
		$this->gallery =array();
		$this->goods_type = $this->goodsType();

		$this->type_info  = '';
		$this->goods_group=array();
		//获取救命报告
		$sql = 'select id,name from '.$this->bg_tuoye.' where id<10';
		$this->baogao = $this->db->getAll($sql);
		$this->display();
	}
	public function update(){
		$this->cache_goods_list = $this->shop_goods();
		list($this->cate,$this->brand) = $this->subjoin();
		$id = $this->get_id();
		$Unfiltered=array('goods_brief','goods_name','goods_brief1');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->goods,$id,$Unfiltered);
		$sql = 'select * from '.$this->goods_gallery .' where goods_id='.$id;
		$this->gallery = $this->db->getAll($sql);
		$this->goods_type = $this->goodsType();
		$sql ='select * from '.$this->goods_group.' where goods_id='.$id;
		$this->goods_group = $this->db->getAll($sql);
		$this->type_info = $this->get_type_info($this->field['goods_type'],$id);
		//如果没有对应的商品属性则为无
		$this->type_info = $this->type_info==''?'':$this->type_info;
		//获取救命报告
		$sql = 'select id,name from '.$this->bg_tuoye.' where id<10';
		$this->baogao = $this->db->getAll($sql);
		$this->display('add');
	}
	public function runadd(){
		unlink(CACHE.'shop_goods.php');// 删除缓存
		$_POST['goods_weight'] = $_POST['goods_weight']*$_POST['weight_unit'];
		$_POST['goods_img1'] = empty($_FILES['goods_img1']['name'])?$_POST['textfield2']:Upload::up('goods_img1');
		//判断是添加还是修改
		$type = empty($_GET['type'])?'add':'update';
		//取得将插入的ID
		if($type=='add'){
			$sql = 'select max(goods_id) as id from '.$this->goods;
			$id = $this->db->getRow($sql);
			$id = $id['id']+1;
		}elseif($type=='update'){
			$id = $gid = $_POST['goods_id']+0;//获得当前商品goods_id
			//删除商品对应的搭配商品
			$sql = 'DELETE FROM '.$this->goods_group.' WHERE  goods_id='.$id;
			$this->db->query($sql);
		}
		//增加搭配商品
		if(!empty($_POST['goods_group'])){
			foreach($_POST['goods_group'] as $v){
				$sql = 'insert into '.$this->goods_group.' (goods_id,group_goods_id) values('.$id.','.$v.')';
				$this->db->query($sql);
			}
		}
		//处理图片并验证数据安全
		$data = $this->verify('goods_img','goods_thumb');
		//如果商品货号为空则生成商品货号
		if($data['goods_sn']==''){
			$id = str_pad($id,6,'0',STR_PAD_LEFT);
			$sn = $this->sn($id,$data['goods_id'],$this->goods);
			$data['goods_sn'] = $sn;
		}else{
			//查看当前货号是否已被注册
			$sql = 'select goods_id from '.$this->goods.' where goods_sn=\''.$data['goods_sn'] .'\' and goods_id<>'.$data['goods_id'];
			$this->db->query($sql);
			$num = mysql_affected_rows();
			if($num>0){
				$data['goods_sn'] = $this->sn($id,$data['goods_id'],$this->goods);
			}
		}

		if($type == 'add'){
			$r = $this->db->insert($this->goods,$data);
			$gid = mysql_insert_id();//获得当前商品goods_id
		}elseif($type == 'update'){
			$r = $this->db->update($this->goods,$data);
			//删除对应静态文件
			if(file_exists('html/goods_'.$data['goods_id'].'.html')){
				unlink('html/goods_'.$data['goods_id'].'.html');
			}
		}
		//添加商品相册
		if(!empty($_FILES['img_url']['name'][0])){
			$data = Upload::up('img_url',2);
			foreach($data as $k=>$v){
				$sql = 'insert into '.$this->goods_gallery .'(goods_id,img_url,img_desc) values ('.$gid.",'$v','".$_POST['img_desc'][$k]."')";
				$this->db->query($sql);
			}
		}

		//判断是否有商品属性
		if(!empty($_POST['attr_id_list'])){
			$sql = 'delete FROM '.$this->goods_attr.' WHERE goods_id='.$gid;
			$this->db->query($sql);
			foreach($_POST['attr_id_list'] as $k=>$v){
				if(!empty($_POST['attr_value_list'][$k])){
					$id = $_POST['attr_id_list'][$k];
					$value = $_POST['attr_value_list'][$k];
					$price = $_POST['attr_price_list'][$k];
					$sql = "insert INTO $this->goods_attr (goods_id,attr_id,attr_value,attr_price) VALUES ($gid,$id,'$value',$price)";
					$this->db->query($sql);
				}
			}
		}

		if($r){
			$str = $type=='add'?'增加商品成功！':'修改商品成功！';
			$this->success($str,U('/Goods/index'));
		}
	}
	
	public function runjadd(){
		unlink(CACHE.'shop_goods.php');// 删除缓存
		
		$_POST['thumb'] = empty($_FILES['thumb']['name'])?$_POST['thumb']:Upload::up('thumb');
		//判断是添加还是修改
		$type = empty($_POST['type'])?'add':'update';
		
		if($type=='update'){
			$data['id']=$_POST['id'];
		}else{
			$data['createtime']=time();
		};
		if(!empty($_POST['ishidden'])){
			$data['ishidden']=$_POST['ishidden'];
		};
		$data['title']=$_POST['title'];
		$data['gid']=$_POST['gid'];
		$data['pdesc']=$_POST['desc'];
		$data['thumb']=$_POST['thumb'];
		
		if($type == 'add'){
			$r = $this->db->insert($this->goodspo,$data);
			
		}elseif($type == 'update'){
			$r = $this->db->update($this->goodspo,$data);
			//删除对应静态文件
			if(file_exists('html/goods_'.$data['gid'].'.html')){
				unlink('html/goods_'.$data['gid'].'.html');
			}
		}

		if($r){
			$str = $type=='update'?'修改成功！':'增加成功';
			$this->success($str,U('/Goods/jlist'));
		}
	}
	public function type_info(){
		$id = $this->get_id();
		p($this->get_type_info($id));
	}
	//获取并组合商品具体属性
	public function get_type_info($id,$goods_id=0){
		if($goods_id==0){
			$sql = 'select * from '.$this->attribute.' where cat_id='.$id;
		}else{
			$sql = 'select *,a.attr_id from '.$this->attribute.' as a left join (select * from '.$this->goods_attr.' where goods_id='.$goods_id.') as g on a.attr_id=g.attr_id where cat_id='.$id;
		}
		$this->attrTable = $this->db->getAll($sql);
		$str = '';
		foreach($this->attrTable as $v){
			$v['attr_value']=empty($v['attr_value'])?'':$v['attr_value'];
			$v['attr_price']=empty($v['attr_price'])?'0':$v['attr_price'];
			if($v['attr_input_type']==0){//手工录入
				$str .= '<tr><td class="label">'.$v['attr_name'].'：</td><td><input type="hidden" name="attr_id_list[]" value="'.$v['attr_id'].'"><input name="attr_value_list[]" type="text" value="'.$v['attr_value'].'" size="40">  <input type="hidden" name="attr_price_list[]" value="0"></td></tr>';
			}elseif($v['attr_input_type']==1){
				$attr = array_filter(explode(',',trim($v['attr_values'])));
				$option = '';
				$selected = '';
				foreach($attr as $a){
					$selected=trim($a) == trim($v['attr_value'])?'selected=selected':'';
					$option .= '<option value="'.$a.'" '.$selected.'>'.$a.'</option>';
				}
				if($v['attr_type']==1){//单选属性
					$str .= '<tr><td class="label">'.$v['attr_name'].'：</td><td><input type="hidden" name="attr_id_list[]" value="'.$v['attr_id'].'"><select name="attr_value_list[]"><option value="">请选择...</option>'.$option.'</select>  <input type="hidden" name="attr_price_list[]" value="0"></td></tr>';
				}elseif($v['attr_type']==2){//复选属性
					$str .= '<tr><td class="label"><a href="javascript:;" onclick="addSpec(this)">[+]</a>'.$v['attr_name'].'</td><td><input type="hidden" name="attr_id_list[]" value="'.$v['attr_id'].'"><select name="attr_value_list[]"><option value="">请选择...</option>'.$option.'</select> 属性价格 <input type="text" name="attr_price_list[]" value="'.$v['attr_price'].'" size="5" maxlength="10"></td></tr>';
				}
			}elseif($v['attr_input_type']==2){//多行文本
				$str .= '<tr style="height:80px;"><td class="label">'.$v['attr_name'].'：</td><td><input type="hidden" name="attr_id_list[]" value="'.$v['attr_id'].'"><textarea name="attr_value_list[]" rows="5" cols="40">'.$v['attr_value'].'</textarea> <input type="hidden" name="attr_price_list[]" value="0"></td></tr>';
			}
			
		}
		return  $str;
	}
	//编辑器图片上传
	public function upload(){
		if ( isset( $_GET['fetch'] ) ) {
	        header( 'Content-Type: text/javascript' );
	        echo 'updateSavePath(['. json_encode('uploads') .']);';
	        return;
	    }
	   $info = Upload::up('upfile',1);
	    if($info){
	    	//去除title属性
	    	if($_POST['Filename'] == $_POST['pictitle']){
	    		$_POST['pictitle']='';
	    	}
	    	$data = array(
	    		'url' => $info[0]['savename'],

	    		'title'=>htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
	    		'original'=>$info[0]['name'],
	    		'state'=>'SUCCESS'
	    	);
	    	echo json_encode($data);
	    }
	}
}
?>