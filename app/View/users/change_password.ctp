<?php
echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'changePassword'));
?>
<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Change Password</h1></td>
                    <td align="left">
                        <?php echo $this->element('cpanel');?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="greyborder">
                <tr>
                    <td align="left" valign="top">
                        <table width="97%" border="0" align="center" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td height="10" colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" class="registerheading">FILL THE INFORMATION</td>
                            </tr>
                            <tr>
                                <td height="10" colspan="2"></td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12" colspan="2">Old Password<span
                                        class="red">*</span></td>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <?php echo $this->Form->input('User.old', array('label' => false, 'div' => false, 'type' => 'password', 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12" colspan="2">New Password<span
                                        class="red">*</span></td>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <?php echo $this->Form->input('User.new', array('label' => false, 'div' => false, 'type' => 'password', 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12" colspan="2">Confirm Password<span
                                        class="red">*</span></td>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <?php echo $this->Form->input('User.confirm', array('label' => false, 'div' => false, 'type' => 'password', 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->end('buttons/submit.jpg');  ?>
                                </td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
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