<hr />
<div class="mq-ment w1000">
  <ul>
    <li><a href="/news_13.html">美舍•美圈</a></li>
    <li><a href="/news_13.html">同城美汇</a>
      <ul>
        <li><a href="">4516</a></li>
      </ul>
    </li>
    <li><a href="/news_13.html">美圈达人</a>
      <ul>
        <li><a href="">达人精选</a></li>
        <li><a href="">定制服务</a></li>
      </ul>
    </li>
    <?php 
$attr =<<<Eof
typeid='13' type='news'
Eof;
$c =<<<Eof

    <li><a href="[field:url /]">[field:typename /]</a></li>
    
Eof;

	$data = $this->taglib->_type($attr,$c);eval($data);?>
  </ul>
  <form action="">
    <input type="text" name="k">
    <input type="submit" name="submit" value="">
  </form>
</div>