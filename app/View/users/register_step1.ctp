<div class="center">
    Please Select below your user type to get register: <br/><br/>
    <?php echo $this->Html->link($this->Html->image('wholesale'),array('controller'=>'users','action'=>'wholesalerTerms'),array('escape'=>false));?><br/><br/>
    <?php echo $this->Html->link($this->Html->image('customer'),array('controller'=>'users','action'=>'register',1),array('escape'=>false));?><br/>
</div>