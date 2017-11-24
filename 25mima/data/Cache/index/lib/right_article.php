<?php 
$attr =<<<Eof
type='right_banner'
Eof;
$c =<<<Eof

<a href="[field:url /]">
    <img src="[field:litpic /]" alt="">
    <p>[field:content /]</p>
    <span>了解更多</span>
</a>

Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
<div class="right_lxwm">
    <h3>联系我们</h3>
    <?php 
$attr =<<<Eof
type='right_ewm'
Eof;
$c =<<<Eof

    <p>[field:content /]</p>
    <img src="[field:litpic /]" alt="">
    </a>
    
Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
    <span>扫一扫关注23密码</span>
</div>