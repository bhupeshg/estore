<div class="center">
    Please Select below your user type to get register: <br/><br/>
    <?php echo $this->Html->link($this->Html->image('wholesale.jpg'),array('controller'=>'users','action'=>'wholesalerTerms'),array('escape'=>false));?>
    <?php echo $this->Html->link($this->Html->image('oem.png'),array('controller'=>'users','action'=>'register',3),array('escape'=>false));?>
    <br/><br/>
    <?php echo $this->Html->link($this->Html->image('customer.jpg'),array('controller'=>'users','action'=>'register',1),array('escape'=>false));?>
    <?php echo $this->Html->link($this->Html->image('govt_emp.png'),array('controller'=>'users','action'=>'register',4),array('escape'=>false));?>
    <br/>
</div>