<?php
	//分页类
	class Page {
		private $total;												//总记录
		private $pagesize;											//每页显示多少条
		private $limit;												//limit
		private $page;												//当前页码
		private $pagenum;											//总页码
		private $url;												//地址
		private $bothnum;											//两边保持数字分页的量
		private $paramt;  											//参数
		
		//构造方法初始化
		public function __construct($_total, $_pagesize, $_paramt='') {
			if(!empty($_paramt)){
			$_paramt=http_build_query($_paramt);
			$this->paramt = $_paramt;
			
			}
			$this->total = $_total;
			$this->pagesize = $_pagesize;
			$this->pagenum = ceil($this->total / $this->pagesize);
			$this->page = $this->setPage();
			$this->limit = "LIMIT ".($this->page-1)*$this->pagesize.",$this->pagesize";
			$this->url = $this->setUrl();
			if(!preg_match('/\?/',$this->url)){
				$this->url=$this->url.'?';
			}
			$this->bothnum = 2;
		}
		
		//拦截器
		public function __get($_key) {
			return $this->$_key;
		}
		
		//获取当前页码
		private function setPage() {
			if (!empty($_GET['page'])) {
				if ($_GET['page'] > 0) {
					if ($_GET['page'] > $this->pagenum) {
						return $this->pagenum;
					} else {
						return $_GET['page'];
					}
				} else {
					return 1;
				}
			} else {
				return 1;
			}
		}	
		
		//获取地址
		private function setUrl() {
			$_url = $_SERVER["REQUEST_URI"];
			$_par = parse_url($_url);
			if (isset($_par['query'])) {
				parse_str($_par['query'],$_query);
				unset($_query['page']);
				$_url = $_par['path'].'?'.http_build_query($_query);
			}
			return $_url;
		}

		//数字目录
		private function pageList() {
			if(!empty($this->paramt)){
				$paramts='&'.$this->paramt;
			}else{
				$paramts='';
			}
			$_pagelist='';
			for ($i=$this->bothnum;$i>=1;$i--) {
				$_page = $this->page-$i;
				if ($_page < 1) continue;
				$_pagelist .= ' <a href="'.$this->url.'&page='.$_page.$paramts.'">'.$_page.'</a> ';
			}
			$_pagelist .= ' <span class="me">'.$this->page.'</span> ';
			for ($i=1;$i<=$this->bothnum;$i++) {
				$_page = $this->page+$i;
				if ($_page > $this->pagenum) break;
				$_pagelist .= ' <a href="'.$this->url.'&page='.$_page.$paramts.'">'.$_page.'</a> ';
			}
			return $_pagelist;
		}
		
		//首页
		private function first() {
			if(!empty($this->paramt)){
				$paramts='&'.$this->paramt;
			}else{
				$paramts='';
			}
			if ($this->page > $this->bothnum+1) {
				return ' <a href="'.$this->url.$paramts.'">1</a> ...';
			}
		}
		
		//上一页
		private function prev() {
			if(!empty($this->paramt)){
				$paramts='&'.$this->paramt;
			}else{
				$paramts='';
			}
			if ($this->page == 1) {
				return '<span class="disabled">上一页</span>';
			}
			return ' <a href="'.$this->url.'&page='.($this->page-1).$paramts.'">上一页</a> ';
		}
		
		//下一页
		private function next() {
			if ($this->page == $this->pagenum) {
				return '<span class="disabled">下一页</span>';
			}
			if(!empty($this->paramt)){
				$paramts='&'.$this->paramt;
			}else{
				$paramts='';
			}
			return ' <a href="'.$this->url.'&page='.($this->page+1).$paramts.'">下一页</a> ';
		}
		
		//尾页
		private function last() {
			if(!empty($this->paramt)){
				$paramts='&'.$this->paramt;
			}else{
				$paramts='';
			}
			if ($this->pagenum - $this->page > $this->bothnum) {
				return ' ...<a href="'.$this->url.'&page='.$this->pagenum.$paramts.'">'.$this->pagenum.'</a> ';
			}
		}
		
		//分页信息
		public function showpage() {
			if($this->total<$this->pagesize){
				return '<span class="disabled">共 1 页/'.$this->total.'条记录</span>';
			}
			$_page='';
			$_page .= $this->prev();
			$_page .= $this->first();
			$_page .= $this->pageList();
			$_page .= $this->last();
			$_page .= $this->next();
			return $_page;
		}

		/**
		 * 获取AJAX分页html代码
		 * @param int $listcount总记录数
		 * @param int $pagesize分页大小
		 * @return string
		 */
		public static function show_page_ajax($listcount, $pagesize = 20, $pagefunction='goPage') {
		    $pagecount = @ceil($listcount / $pagesize);
		    $curpage = intval($_POST['page']);
		    
		    if ($curpage > $pagecount) {
		        $curpage = $pagecount;
		    }
		    if ($curpage < 1) {
		        $curpage = 1;
		    }
		    //这里写前台的分页
		    $centernum = 10; //中间分页显示链接的个数
		    $multipage = '<div class="pages"><div class="listPage">';
		    if ($pagecount <= 1) {
		        $back = '';
		        $next = '';
		        $center = '';
		     //   $gopage = '';
		    } else {
		        $back = '';
		        $next = '';
		        $center = '';
		        if ($curpage == 1) {
		            for ($i = 1; $i <= $centernum; $i++) {
		                if ($i > $pagecount) {
		                    break;
		                }
		                if ($i != $curpage) {
		                    $center .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . $i . ');">' . $i . '</a>';
		                } else {
		                    $center .= '<a class="none">' . $i . '</a>';
		                }
		            }
		            $next .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . ($curpage + 1) . ');" id="next">下一页</a>';
		        } elseif ($curpage == $pagecount) {
		            $back .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . ($curpage - 1) . ');" id="next">上一页</a>';
		            for ($i = $pagecount - $centernum + 1; $i <= $pagecount; $i++) {
		                if ($i < 1) {
		                    $i = 1;
		                }
		                if ($i != $curpage) {
		                    $center .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . $i . ');">' . $i . '</a>';
		                } else {
		                    $center .= '<a class="none">' . $i . '</a>';
		                }
		            }
		        } else {
		            $back .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . ($curpage - 1) . ');" id="next">上一页</a>';
		            $left = $curpage - floor($centernum / 2);
		            $right = $curpage + floor($centernum / 2);
		            if ($left < 1) {
		                $left = 1;
		                $right = $centernum < $pagecount ? $centernum : $pagecount;
		            }
		            if ($right > $pagecount) {
		                $left = $centernum < $pagecount ? ($pagecount - $centernum + 1) : 1;
		                $right = $pagecount;
		            }
		            for ($i = $left; $i <= $right; $i++) {
		                if ($i != $curpage) {
		                    $center .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . $i . ');">' . $i . '</a>';
		                } else {
		                    $center .= '<a class="none">' . $i . '</a>';
		                }
		            }
		            $next .= '<a href="javascript:;" onclick="' . $pagefunction . '(' . ($curpage + 1) . ');" id="next">下一页</a>';
		        }
		    }
		    $multipage .= $back . $center . $next . '</div></div>';

		    return $multipage;
		}



	}
?>