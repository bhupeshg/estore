<?php 
$mIdSearch = 'products/';
if(isset($this->data['Product']) || !empty($this->params['named'])){
	if(isset($this->params['pass'][0]) && !empty($this->params['pass'][0])){
		$mIdSearch.= $this->params['pass'][0]."/";
	}
	if(isset($this->data['Product']['m_id']) && !empty($this->data['Product']['m_id'])){
		$mIdSearch.= "m_id:".$this->data['Product']['m_id']."/";
	}elseif(isset($this->params['named']['m_id']) && !empty($this->params['named']['m_id'])){
		if(!isset($this->data['Product']['m_id'])){
			$mIdSearch.= "m_id:".$this->params['named']['m_id']."/";
		}
	}
}

?>
<?php echo $this->Form->create('Product',array('url'=>$mIdSearch, 'id' => 'searchProductDetail', 'method'=>'POST')); ?>
<tr>
	<td class="leftnavheading"><strong>Search</strong></td>
</tr>
<tr>
	<td height="10"></td>
</tr>
<tr>
	<td>
		<?php echo $this->Form->input('Product.m_id',array("id"=>"textfield",'label'=>false,'div'=>false,"maxlength"=>"100","type"=>"text")); ?>
	</td>
</tr>
<tr>
	<td height="5"></td>
</tr>
<tr>
	<td class="paddingleft1">
		<?php echo $this->Form->submit("Submit",array("class"=>"submit_b","label"=>false,"div"=>false)); ?>
	</td>
</tr>
<?php echo $this->Form->end();?>
<tr>
	<td>&nbsp;</td>
</tr>