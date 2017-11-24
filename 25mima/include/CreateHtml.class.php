<?php 
class CreateHtml{ 
	function mkdir($prefix='html'){ 
		$p=DIRECTORY_SEPARATOR; 
		$filePath=$prefix.$p;
		if(!is_dir($filePath)){ 
			//echo '没有这个目录'.$path; 
			mkdir($filePath,0755);
		}
		return $filePath.$p;
	}
	function start(){
		ob_start();
	}
	function end($filename,$prefix='html'){
		$info = ob_get_contents();
		$fileId = $filename;
		$postfix = '.html';
		$path = $this->mkdir($prefix);
		$fileName = $fileId.$postfix;
		$file=fopen($path.$fileName,'w+');
		fwrite($file,$info);
		fclose($file);
		ob_end_flush();
	}
}
?>