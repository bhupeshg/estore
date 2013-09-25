<?php
if ($this->Session->read('uid')) {
    ?>

    <div class="cpaneluser">
        <span class="userpic"><img src="/unbrako/img/avatar1_small.jpg" width="29" height="29" alt=""/></span>
        <span class="welcomn example" data-dropdown="#dropdown-1">john Smith</span>
    </div>

    <div id="dropdown-1" class="dropdown dropdown-tip dropdown-anchor-right">
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->html->link('My Account', array('controller' => 'users', 'action' => 'myAccount'))?>
            </li>
            <li>
                <?php echo $this->html->link('Change Password', array('controller' => 'users', 'action' => 'changePassword'))?>
            </li>
            <li>
                <?php echo $this->html->link('Logout', array('controller' => 'users', 'action' => 'logout'))?>
            </li>
        </ul>
    </div>
<?php
}
?>