<h2>Change Password</h2>
<?php
echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'changePassword', 'admin' => true));
?>
<table id="formst">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <?php echo $this->Session->flash('success'); ?>
            <?php echo $this->Session->flash('failure'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <div class="formc">
                <div class="rowb">
                    <div class="label">Old Password :</div>
                    <div class="inbx">
                        <?php echo $this->Form->input('User.old', array('label' => false, 'div' => false, 'type' => 'password')); ?>
                    </div>
                </div>
                <div class="rowb">
                    <div class="label">New Password :</div>
                    <div class="inbx">
                        <?php echo $this->Form->input('User.new', array('label' => false, 'div' => false, 'type' => 'password')); ?>
                    </div>
                </div>
                <div class="rowb">
                    <div class="label">Confirm Password :</div>
                    <div class="inbx">
                        <?php echo $this->Form->input('User.confirm', array('label' => false, 'div' => false, 'type' => 'password')); ?>
                    </div>
                </div>
                <div class="rowb">
                    <div class="inbx">
                        <?php echo $this->Form->end('buttons/submit.jpg');  ?>
                    </div>
                </div>
            </div>

        </td>
    </tr>
</table>