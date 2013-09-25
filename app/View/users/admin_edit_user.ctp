<h2>Edit User</h2>
<?php
echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'editUser', 'admin' => true));
echo $this->Form->hidden('Customer.id');
echo $this->Form->hidden('Customer.konda');
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
                <?php if ($this->request->data['Customer']['konda'] != 'RL') { ?>
                    <div class="rowb">
                        <div class="label">Verify Status :</div>
                        <div class="inbx">
                            <?php
                            $options = array('0' => 'Pending', '1' => 'In Progress', '2' => 'Verified');
                            echo $this->Form->input('Customer.verify_status', array('options' => $options, 'label' => false, 'div' => false, 'class' => 'adminSelect', 'autocomplete' => 'off'));
                            ?>
                        </div>
                    </div>
                    <div class="rowb">
                        <div class="label">New Credit Limit :</div>
                        <div class="inbx">
                            <?php echo $this->Form->input('Customer.klimk', array('label' => false, 'div' => false,)); ?>
                        </div>
                    </div>
                    <div class="rowb">
                        <div class="label">New Days Limit :</div>
                        <div class="inbx">
                            <?php echo $this->Form->input('Customer.ztag2', array('label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="rowb">
                        <div class="label">Price List Group :</div>
                        <div class="inbx">
                            <?php
                            $price_list = array('R1' => 'Retail1', 'R2' => 'Retail2', 'W1' => 'Dealer1', 'W2' => 'Dealer2', 'OE1' => 'OEM1', 'OE2' => 'OEM2');
                            echo $this->Form->input('Customer.pltyp', array('options' => $price_list, 'class' => 'adminSelect', 'label' => false, 'div' => false, 'autocomplete' => 'off'));
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="rowb">
                    <div class="label">Login Status :</div>
                    <div class="inbx">
                        <?php
                        $opt = array('0' => 'De-Activate', '1' => 'Activate');
                        echo $this->Form->input('Customer.status', array('options' => $opt, 'class' => 'adminSelect', 'label' => false, 'div' => false, 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>
                <div class="rowb">
                    <div class="label">De-Activate Reason :</div>
                    <div class="inbx">
                        <?php
                        if ($this->request->data['Customer']['verify_status'] != '2') {
                            if (empty($this->request->data['Customer']['deactive_reason'])) {
                                echo $this->Form->input('Customer.deactive_reason', array('label' => false, 'div' => false, 'type' => 'textarea', 'cols' => '47', 'value' => 'User will be sent an activation email after the successful verification to activate their account.'));
                            } else {
                                echo $this->Form->input('Customer.deactive_reason', array('label' => false, 'div' => false, 'type' => 'textarea', 'cols' => '47'));
                            }
                        } else {
                            echo $this->Form->input('Customer.deactive_reason', array('label' => false, 'div' => false, 'type' => 'textarea', 'cols' => '47'));
                        }
                        ?>
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