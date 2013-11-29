<?php $this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id = ui.id WHERE ul.id=".intval($_SESSION['id']), $this->ERROR_QUERY); ?>
<?php $this->result_to_array(); ?>
<div class="userRow">
<?php if(strlen($this->rst['profile_image'])==0): ?>
	<img src="<?=SERVER_URL?>/user_upload/default_user.png" width="48" height="50" align="middle"><?=$this->rst['username']?></div>
<?php else:?>
	<img src="<?=SERVER_URL?>/user_upload/<?=intval($_SESSION['id'])?>/<?=$this->rst['profile_image']?>" width="48" height="50" align="middle"><?=$this->rst['username']?></div>
<?php endif;?>
    <div style="font-size:11px;"><a href="<?=SERVER_URL?>?editprofile">edit profile</a></div>
	<div class="containers">
      <div class="profileTable">
        <div class="profileTableRow">
          <div class="profileTableCell">		  
            <div class="quickInfo">       				
                <dl>
                   <dt>邮箱地址</dt>
                   <dd  class="redText"><?=$this->rst['email']?></dd>
                </dl>
                
                <dl>
                   <dt>城市</dt>
                   <dd><?=$this->rst['city']?></dd>
                </dl>
                
                <dl>
                   <dt>會員參加日期</dt>
                   <dd><?php echo date("F m, Y", strtotime($this->rst['join_date']));?></dd>
                </dl>
				
				<dl>
                   <dt>电话号码</dt>
                   <dd><?=$this->rst['phone']?></dd>
                </dl>
                
                <dl>
                   <dt>關於我</dt>
                   <dd class="grayText9">
				   <?php if(strlen($this->rst['aboutme'])==0): ?>
						<br/><!-- add row -->
				   <?php else: ?>
							<?=$this->rst['aboutme']?></dd>
					<?php endif; ?>
                </dl>
            </div>			
            <div class="adModBlue">
            <div class="adModBlueContent">
              <h3>最新IN GIRL动态</h3>
              <div class="adModContentInnerText userCurrentActivity">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">    
				<?php $this->result = null; ?>
				<?php $this->query("SELECT * FROM user_activity ORDER BY date_added DESC LIMIT 6", $this->ERROR_QUERY); ?>
				<?php if($this->return_rows() > 0): ?>
				<?php foreach($this->result_to_object() as $obj): ?>
						<tr>							
							<td><img src="<?=SERVER_URL?><?=getImageById($obj->uid)?>" width="21" height="21" alt="a"></td>
							<td><span style="font-size:11px;"><?=$obj->content?></span>&nbsp;<span class="userTimeText"><?=elapseTime($obj->date_added)?></span></td>
						</tr>
				<?php endforeach; $this->result = null; ?>
				<?php endif; ?>
				</table>						
              </div>
            </div>
          </div>
          
          </div>
          <div class="profileTableCell">
            <div class="quickPtSumm">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="quickPtSummValue">
                  <td><?=getTotalPoints(intval($_SESSION['id']))?></td>
                  <td></td>
                  <td></td>
                </tr>
                <!--<tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>-->
                <tr class="quickPtSummLabel">
                  <td>points</td>
                  <td>forwards</td>
                  <td>reviews</td>
                </tr>
              </table>
            </div><!--quickPtSumm -->
            
            <div class="quickPtBar">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="ptStart">0</td>
                  <td class="ptEnd">100000</td>
                </tr>
              </table>
              <div class="quickPtBarGray">
                <div class="quickPtBlue" style="width:<?php echo $barWidth = '8%'; ?>"> 
                  
                </div>
                <div class="redMarkerDiv" style="left:<?php echo $markerOne = '15%'; ?>"></div>
                <div class="redMarkerDiv" style="left:<?php echo $markerTwo = '35%'; ?>"></div>
                <div class="redMarkerDiv" style="left:<?php echo $markerThree = '55%'; ?>"></div>
                <div class="redMarkerDiv" style="left:<?php echo $markerFour = '100%'; ?>"></div>
              </div>
            </div><!--quickPtBar -->
         
            <div id="levelSummary">
             <!-- <h3>Party Girl <span class="redText">3</span> level</h3>
              <p class="note"><span class="grayText9">Only</span> 2500 <span class="grayText9">points to</span> Party Girl <span class="redText">4</span></p>
              <div class="kosStandardTable">
                <div class="kosStandardTableRow">
                  <div class="kosStandardTableCell">
                    <div id="levelSummaryUserAv"><img src="images/placeholderUserAvatar.jpg" width="132" height="172" alt="avatar"></div>
                  </div><!--profileTableCell -->
                  <!--<div class="kosStandardTableCell">
                  	<div id="levelSummaryLevels">
                  	  <ul>
                  	    <li><img src="images/levelsIcon/iconCompact.gif" width="37" height="37"></li>
                  	    <li><img src="images/levelsIcon/iconGift.gif" width="36" height="37"></li>
                  	    <li><img src="images/levelsIcon/iconLipstick.gif" width="36" height="37"></li>
                  	    <li><img src="images/levelsIcon/iconCreamNA.gif" width="39" height="38">
                  	      <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div>
                  	    <!--</li>
                  	    <li><img src="images/levelsIcon/iconBlowerNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
                  	    <!--<li><img src="images/levelsIcon/iconPerfumeNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
                  	    <!--<li><img src="images/levelsIcon/iconBagsNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
                  	    <!--<li><img src="images/levelsIcon/iconWatchesNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
                  	    <!--<li><img src="images/levelsIcon/iconShoesNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
                  	    <!--<li><img src="images/levelsIcon/iconDiamondNA.gif" width="39" height="38">
                        <!--apply lock div --><!--<div class="lock"><img src="images/iconLock.gif" width="19" height="20"></div></li>
               	      <!--</ul>
                  	</div>
                  </div><!--profileTableCell -->
                <!--</div>
              </div>-->
              
            </div>
            
            
            
            
          </div>
        </div>
      </div>
    </div>
    
    <div class="containers">
      <div class="profileTable">
        <div class="profileTableRow">
          <div class="profileTableCell">
           <?php include_once("view/points_summary.php"); ?>
            
          </div><!--profileTableCell -->
          <div class="profileTableCell">
           <!-- <h3>Reviews <span class="grayText9">(20)</span></h3>
            <div class="review">
              <div class="kosStandardTable" style="width:100%">
                <div class="kosStandardTableRow">
                  <div class="kosStandardTableCell" style="width:200px;">
                    <div class="productImage"><img src="images/reviews/imgProductOne.jpg" width="181" height="114"></div>
                  </div>
                  <div class="kosStandardTableCell">
                    <div class="productQuickInfo">
                      <h4>Product Name</h4>
                      <div class="productQuickInfoDescription">Product Description here</div>
                      <div class="productQuickInfoViewProd"><a href="#">View Product</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="productQuickInfoComment">Content for  class "productQuickInfoComment" Goes Here</div>
              <div class="productQuickInfoViewProd"><a href="#">View Review</a></div>
            </div><!--review ends -->
            
            <!--<div class="review">
              <div class="kosStandardTable" style="width:100%">
                <div class="kosStandardTableRow">
                  <div class="kosStandardTableCell" style="width:200px;">
                    <div class="productImage"><img src="images/reviews/imgProductTwo.jpg" width="181" height="114"></div>
                  </div>
                  <div class="kosStandardTableCell">
                    <div class="productQuickInfo">
                      <h4>美妆小窍门— —夏日美艳荧光妆容 </h4>
                      <div class="productQuickInfoDescription">奥法师舒服撒叫姐姐哦。我减肥无菌辅巾奥加万佛阿娇哦。今晚发哦积分凤飞飞！骄傲家具欧文而家。</div>
                      <div class="productQuickInfoViewProd"><a href="#">查看产品</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="productQuickInfoComment">阿萨德。安防解按时大大爱上大声地放军减</div>
              <div class="productQuickInfoViewProd"><a href="#">查看评论</a></div>
            </div><!--review ends -->
            
            <!--<div class="menu_rev_nav">
              <ul>
                <li><a href="#" class="navBtnFst">First</a></li>
                <li><a href="#" class="navBtnPrev">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#" class="navBtnNxt">Next</a></li>
                <li><a href="#" class="navBtnLst">Last</a></li>
              </ul>
            </div>
            
            -->
          </div><!--profileTableCell -->
        </div>
      </div>
    </div>
