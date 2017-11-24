<?php
/*
file mysql.php
作用: 数据库类
*/
defined('HSJ')||die('您没有权限进入此页面');
class Mysql{
	private static $ins = null;
	private $conn = null;

	final protected function __construct(){
		$this->connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
		$this->select_db(C('DB_NAME'));
		$this->setChar(C('DB_CHAR'));
	}

	public static function getIns(){
		if(!(self::$ins instanceof self)){
			self::$ins = new self();
		}
		return self::$ins;
	}

	private function connect($h,$u,$p){
		$this->conn = mysql_connect($h,$u,$p);
		if(!$this->conn){
			$err = new Exception('连接失败');
            throw $err;
		}
	}
	
	private function select_db($db){
		$sql = 'use ' . $db;
		$this->query($sql);
	}

	private function setChar($char){
		$sql = 'set names '.$char;
		return $this->query($sql);
	}

	public function query($sql){
		$rs = mysql_query($sql,$this->conn);
		Log::write($sql);
		if(!$rs){
			echo '<br />'.$sql;
			echo '<br />您此次数据库操作有误：'.mysql_error();
			$uri = __ROOT__."data/email/index.php";
			// 参数数组
			$data = array (
			        'address' => '734303275@qq.com',
			        'title'   => '网站出错',
			        'FromName'=> rand(1,9999),
			        'body'    => $sql.'<Br />错误'.mysql_error().'<br />页面'.$_SERVER['HTTP_REFERER']
			// 'password' => 'password'
			);
			 
			$ch = curl_init();
			// print_r($ch);
			curl_setopt ( $ch, CURLOPT_URL, $uri );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
			$return = curl_exec ($ch);
			curl_close ($ch);
		}
		return $rs;
	}
	//得到表信息
	private function desc($table){
		$sql = 'desc '.$table;
		return $this->query($sql);
	}
	//得到表字段
	public function desc_field($table){
		$data = $this->desc($table);
		while($rs = mysql_fetch_assoc($data)){
			$fields[]= $rs['Field'];
		}
		return $fields;
	}
	//得到表主键
	public function desc_pri($table){
		$data = $this->desc($table);
		while($rs = mysql_fetch_assoc($data)){
			if($rs['Key'] == 'PRI'){
				return $rs['Field'];
			}
		}

	}
	//把需要增加or修改的数据组合成字符串并去除主键 
	private function AtoS($table,$data){
		$pri = $this->desc_pri($table);// 主键
		$key = '';
		$values='';
		foreach($data as $k=>$v){
			if($k == $pri){
				continue;
			}
			$key.=$k.',';
			if(is_array($v)){
				$v = implode(',',$v);
			}
			$values.='\''.$v.'\',';
		}
		$key = substr($key,0,-1);
		$values = substr($values,0,-1);
		return array($key,$values,$pri);
	}
	//数据增加操作
	public function insert($table,$data){
		$array = $this->AtoS($table,$data);
		list($k,$v,$p) = $array;
		$sql = 'insert into '.$table.' ('.$k.') values ('.$v.')';
		return $this->query($sql);
	}
	//数据修改操作
	public function update($table,$data){
		$pri = $this->desc_pri($table);
		$sql = 'update '.$table.' set ';
		foreach($data as $k=>$v){
			if(is_array($v)){
				$v = implode(',',$v);
			}
			$sql .= $k.'=\''.$v.'\', ';
		}
		$sql = substr($sql,0,-2);
		$sql .= ' where '.$pri .'='.$data[$pri];
		return $this->query($sql);
	}
	//数据删除操作
	public function delete($table,$id){
		$pri = $this->Desc_pri($table);
		$sql = 'delete from '.$table.' where '.$pri.' in('.$id.')';
		return $this->query($sql);
	}
	//得到所有行数据
	public function getAll($sql,$array=null) {
        $rs = $this->query($sql);
        $list = array();
        while($row = mysql_fetch_assoc($rs)){
            $list[] = $row;
        }
        return _html($list,$array);
    }
	//得到table中主键=id的一行数据
	public function getField($table,$id,$array=null){
		$pri = $this->Desc_pri($table);
		$sql = 'select * from '.$table.' where '.$pri.'='.$id;
		$rs = $this->query($sql);
        return _html(mysql_fetch_assoc($rs),$array);
	}
	//得到一行数据
	public function getRow($sql,$array=null){
        $rs = $this->query($sql);
        return _html(mysql_fetch_assoc($rs),$array);
    }
    //取得结果集中行的数目
    public function getNum($sql){
    	$rs = $this->query($sql);
    	return mysql_num_rows($rs);
    }

    /**
     * 
     * @param type $str
     */
    public function escape_str($str,$like = FALSE) {
        if(is_array($str)) {
            foreach($str as $key =>$value) {
                $str[$key] = mysql_real_escape_string($value, $like);
            }
            return $str;
        }
        if(is_object(self::getIns())) {
            $str = mysql_real_escape_string($str);
        }
        return $str;
    }


    /********防注入*********
    public function filter($html){
            $farr = array(
                '/<(\/?)(script|style|html|iframe|body|title|link|meta|\?|\%)([^>]*?)>/isU',//i?frame|
                "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU", 
            );
            $tarr = array(
                "＜\\1\\2\\3＞",
                "\1\\2",
            );
            $html = preg_replace($farr, $tarr, $html);
            return $html;
        }

    public function disData($d, $p = FALSE){
		// $p = TRUE : insert
		if($p){
			$kl = "";
			$vl = "";
			foreach($d as $k => $v){
				$kl .= ",`{$k}`";
				$vl .= ",'". $this->filter((addslashes($v)))."'";
			}
			return "(".substr($kl, 1).") values(".substr($vl, 1).")";
		}else{
			$s = "";
			foreach($d as $k => $v){
				$s .= ",`{$k}`='".$this->filter(addslashes($v))."'";
			}
			return substr($s, 1);
		}	
	}
	/********防注入*********/
}
?>