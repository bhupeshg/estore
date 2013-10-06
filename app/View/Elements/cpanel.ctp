<?php
if ($this->Session->read('uid')) {
    ?>

    <div class="cpaneluser">
        <span class="welcomn example" data-dropdown="#dropdown-1"><span class="userpic">
            <?php echo $this->Html->image('avatar.png',array('width'=>'24','height'=>'24'));?>
        </span> <?php echo ucfirst($this->Session->read('firstname')).' '.ucfirst($this->Session->read('lastname'))?></span>
    </div>

    <div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link('My Account', array('controller' => 'users', 'action' => 'myAccount'))?>
            </li>
            <li>
                <?php echo $this->Html->link('View Cart', array('controller' => 'carts', 'action' => 'view'))?>
            </li>
            <li>
                <?php echo $this->Html->link('My Account', array('controller' => 'users', 'action' => 'addressBook'))?>
            </li>
            <li>
                <?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'changePassword'))?>
            </li>
            <li>
                <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'))?>
            </li>
        </ul>
    </div>
<?php
}
?>