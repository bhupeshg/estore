<?php
if ($this->Session->read('uid')) {
    ?>

    <div class="cpaneluser">
        <span class="userpic">
            <?php echo $this->Html->image('avatar.png',array('width'=>'29','height'=>'29'));?>
        </span>
        <span class="welcomn example" data-dropdown="#dropdown-1">john Smith</span>
    </div>

    <div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link('My Account', array('controller' => 'users', 'action' => 'myAccount'))?>
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