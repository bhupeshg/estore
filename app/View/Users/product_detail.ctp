<?php
$image = '';
if($this->Paginator->sortDir() == 'asc'){
	$image = $this->Html->image('arrow-top.gif',array('border'=>0,'alt'=>''));
}else if($this->Paginator->sortDir() == 'desc'){
	$image = $this->Html->image('arrow-bottom.gif',array('border'=>0,'alt'=>''));
}
?>
<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div class="center" style="margin-left: 10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left"><h1 class="heading">Product Catalogue</h1></td>
                        <td align="left">
                            <?php echo $this->element('cpanel');?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="200" valign="top" style="border-right:1px solid #ccc; padding-right:5px;">
									<table width="200" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td class="leftnavheading"><strong>You Searced for</strong></td>
										</tr>
										<tr>
											<td height="10"></td>
										</tr>
										<tr>
											<td>
												<ul class="searcherfor">
													<li><a href="#">asd</a></li>
													<li><a href="#">asd</a></li>
													<li><a href="#">asd</a></li>
												</ul>
											</td>
										</tr>
										<tr>
											<td height="10"></td>
										</tr>
										<?php echo $this->element('left'); ?>
										<?php echo $this->Form->create('Product',array('url'=>$newUrl, 'id' => 'searchProductDetail', 'method'=>'POST')); ?>
										<tr>
											<td class="leftnavheading"><strong>Refine your search by:</strong></td>
										</tr>
										<tr>
											<td height="10"></td>
										</tr>
										<tr>
											<td>
												<?php echo $this->Form->input("wgbez60-mvgr3", array("type" => "select", "options" => $gradeList, "class" => "chosen-select forgerttxt width200", "label" => false, "div" => false, "empty" => "-Grade/Quality-")); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php echo $this->Form->input("wgbez60-mvgr4", array("type" => "select", "options" => $finishingList, "class" => "chosen-select forgerttxt width200", "label" => false, "div" => false, "empty" => "-Surface Finish/Coating-")); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php echo $this->Form->input("wgbez60-mvgr2", array("type" => "select", "options" => $threadList, "class" => "chosen-select forgerttxt width200", "label" => false, "div" => false, "empty" => "-Thread-")); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php echo $this->Form->input("wgbez60-mvgr5", array("type" => "select", "options" => $standardList, "class" => "chosen-select forgerttxt width200", "label" => false, "div" => false, "empty" => "-Standard-")); ?>
											</td>
										</tr>
										<tr>
											<td height="10"></td>
										</tr>
										<tr>
											<td>
												<?php echo $this->Form->submit("Submit",array("class"=>"submit_b","label"=>false,"div"=>false)); ?> &nbsp; 
												<?php 
												$resetPage = "/users/productDetail/";
												if(isset($this->params['pass'][0]) && !empty($this->params['pass'][0])){
													$resetPage.= $this->params['pass'][0];
												}
												echo $this->Form->button('Reset',array('type' => 'button', 'onclick' => "location.href='".$this->Html->url($resetPage)."'","label"=>false,"div"=>false)); ?>
											</td>
										</tr>
										<?php echo $this->Form->end();?>
									</table>
                                </td>
                                <td valign="top">
                                    <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><strong>Socket head cap screws
                                                </strong></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="altrowstable" id="alternatecolor">
                                                    <tr>
                                                        <th>Family</th>
                                                        <th>Product Discription</th>
                                                        <th>
															<?php echo $this->Paginator->sort('Product.wgbez60-mvgr3', 'Grade/Quality');
															if($this->Paginator->sortKey() == 'Product.wgbez60-mvgr3'){
																echo ' '.$image; 
															}
															?>
														</th>
                                                        <th>
															<?php echo $this->Paginator->sort('Product.wgbez60-mvgr4', 'Surface Finish/Coating');
															if($this->Paginator->sortKey() == 'Product.wgbez60-mvgr4'){
																echo ' '.$image; 
															}
															?>
														</th>
                                                        <th>
															<?php echo $this->Paginator->sort('Product.wgbez60-mvgr2', 'Thread');
															if($this->Paginator->sortKey() == 'Product.wgbez60-mvgr2'){
																echo ' '.$image; 
															}
															?>
														</th>
                                                        <th>
															<?php echo $this->Paginator->sort('Product.wgbez60-mvgr5', 'Standard');
															if($this->Paginator->sortKey() == 'Product.wgbez60-mvgr5'){
																echo ' '.$image; 
															}
															?>
														</th>
                                                    </tr>
                                                    <?php
                                                    if (!empty($products)) {
                                                        foreach ($products as $product) {
                                                            ?>
                                                            <tr>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['ProductType']['parentgroupid'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php
                                                                    echo $this->Html->link($product['ProductType']['wgbez60-matkl'], array('controller' => 'users', 'action' => 'products', $product['Product']['id']));
                                                                    ?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr3'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr4'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr2'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr5'];?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                    ?>
                                                    <tr>
                                                        <td align="center" colspan="6">
                                                            Sorry no product available
                                                        </td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
									<?php 
									if($this->params['paging']['Product']['pageCount']>1){ ?>
									<table width="100%" cellpadding="2" cellspacing="1"  border="0"  class="borderTable">
										<tr>
											<td colspan="8">
											<?php /************** paging box ************/
											echo $this->element('pagination'); ?>
											</td>
										</tr>
									</table>
									<?php } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

</div>

</td>
<td width="21" valign="top" background="/unbrako/img/rightbar.jpg"></td>
</tr>
</table>