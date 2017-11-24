<?php
class Upload{
	static private $uploaddir='';
	static private $type=array("jpg","gif","bmp","jpeg","png");
	//$array 0:单文件上传 1:编辑器上传 其他多文件上传
	static function up($img_name,$array=0){
		self::$uploaddir=ROOT."uploads/";
		if($array==0){// 单文件上传
			$file = $_FILES[$img_name]["name"];
			self::typeTrue($file);
			$uploadfile = self::get_file_name($file);
			if(!move_uploaded_file($_FILES[$img_name]['tmp_name'],$uploadfile)){
				echo"传输失败！";
			}
			$uploadfile = '/'.substr($uploadfile,strlen(ROOT));
			return $uploadfile;
		}else if($array==1){
			$files	 =	 self::dealFiles($_FILES);
			$data = array();
			foreach($files as $k => $v){
	            //过滤无效的上传
	            if(!empty($v['name'])) {
	                self::typeTrue($v['name']);
	                $uploadfile = self::get_file_name($v['name']);
	                if(!move_uploaded_file($files[$k]['tmp_name'],$uploadfile)){
						echo"传输失败！";
					}
					$uploadfile = substr($uploadfile,strlen(ROOT.'/uploads'));
					$data[0]['name'] = $v['name'];
					$data[0]['savename'] = $uploadfile;
		        }
	        }
	        return $data;
		}else{// 多文件上传
			$_FILES[$img_name]["name"] = array_filter($_FILES[$img_name]["name"]);//删除空数值
			foreach($_FILES[$img_name]["name"] as $k=>$v){
				self::typeTrue($v);
				$uploadfile = self::get_file_name($v);
				if(!move_uploaded_file($_FILES[$img_name]['tmp_name'][$k],$uploadfile)){ 
					echo"传输失败！";
				}
				$uploadfile = '/'.substr($uploadfile,strlen(ROOT));
				$data[] = $uploadfile;
			}
			return $data;
		}
	}
	/**
     * 转换上传文件数组变量为正确的方式
     * @access private
     * @param array $files  上传的文件变量
     * @return array
     */
    static function dealFiles($files) {
        $fileArray  = array();
        $n          = 0;
        foreach ($files as $key=>$file){
            if(is_array($file['name'])) {
                $keys       =   array_keys($file);
                $count      =   count($file['name']);
                for ($i=0; $i<$count; $i++) {
                    $fileArray[$n]['key'] = $key;
                    foreach ($keys as $_key){
                        $fileArray[$n][$_key] = $file[$_key][$i];
                    }
                    $n++;
                }
            }else{
               $fileArray[$key] = $file;
            }
        }
       return $fileArray;
    }
		
	//判断上传文件格式是否正确
	static private function typeTrue($file){
		if(!in_array(strtolower(substr(strrchr($file,'.'),1)),self::$type)){
				$text=implode('.',self::$type);  
				echo '<script>';
				echo "alert('您只能上传以下类型文件: ",$text,"');";
				echo 'history.go(-1)';
				echo '</script>';
				die();
		}
	}
	//得到图片并取得文件名
	static private function get_file_name($file){
		$filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。  
		$time=date("mdHis").rand(1000,9999);//取当前上传的时间加随机数
		$uploaddir = self::$uploaddir.date('y/m/d/');
		if(!file_exists($uploaddir)){
			mkdir($uploaddir,0777,true);
		}
		$filename[0]=$time;//取文件名t替换  
		$sname=implode(".",$filename); //上传后的文件名  
		$uploadfile=$uploaddir.$sname;//上传后的文件名地址
		return $uploadfile;
	}
}
?>