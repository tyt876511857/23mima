<header class='w1200'>
  <?php 
$attr =<<<Eof
type='logo'
Eof;
$c =<<<Eof

  <div id="header_top" style="background-image:url([field:litpic /]);">
  
Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
  	<a id="logo" href="/"></a>
  </div>
</header>