<div class="center" style="margin-left: 10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left"><h1 class="heading">Welcome to My Account</h1></td>
            <td align="left">
                <?php echo $this->element('cpanel');?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->html->link('Continue Shopping',array('controller'=>'users','action'=>'productConfirmation'))?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->html->link('Address Book',array('controller'=>'users','action'=>'addressBook'))?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->html->link('Change Password',array('controller'=>'users',
                    'action'=>'changePassword'))?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->html->link('Logout',array('controller'=>'users',
                    'action'=>'logout'))?></td>
        </tr>
    </table>
</div>