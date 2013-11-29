<div class="menu_bottom">
      <ul>
		<?php if(isset($_SESSION['id'])): ?>
				<?$this->GetBottomMenuInSession()?>			 
				<?php foreach($this->result_to_object() as $obj): ?>				
					<li><a href="<?=SERVER_URL?>?<?=strtolower(trim($obj->menu_link))?>"><?=$obj->menu_text?></a></li>				
				<?php endforeach; ?>
		<?php else: ?>
				<?$this->GetBottomMenu()?>
				<?php foreach($this->result_to_object() as $obj): ?>				
					<li><a href="<?=SERVER_URL?>?<?=strtolower(trim($obj->menu_link))?>"><?=$obj->menu_text?></a></li>				
				<?php endforeach; ?>
		<?php endif; ?>
      </ul>
    </div><!--menu_bottom-->
    <div class="footer_menu">
      <ul>
        <li><a href="#">SHOP		</a></li>
        <li><a href="#">Delivery		</a></li>
        <li><a href="#">FAQS		</a></li>
        <li><a href="#">Sitemap</a></li>
      </ul>
    </div>
  </div>
</div><!--main_cont-->
<div id="copyright">Copyright &copy; 2012 Kosmeyin Group Limited. -  <span id="copychinese">Kosmeyin 因我 IN - 最新最适合你的亚洲美妆资讯和产品</span></div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32380622-1']);
  _gaq.push(['_setDomainName', 'kosmeyin.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>