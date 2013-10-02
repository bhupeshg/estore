<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Address Book</h1></td>
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
        <td>
            <?php echo $this->Html->link('Add new Address', array('controller' => 'users', 'action' => 'addAddress'))?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" align="center" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td valign="top">
                                    <table width="100%" border="0" align="right" cellpadding="0"
                                           cellspacing="0">

                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0"
                                                       cellpadding="0" class="altrowstable"
                                                       id="alternatecolor">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Street Address</th>
                                                        <th>State</th>
                                                        <th>Country</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <?php
                                                    if (!empty($addresses)) {
                                                        foreach ($addresses as $address) {
                                                            ?>
                                                            <tr>
                                                                <td align="center">
                                                                    <?php echo ucfirst($address['Address']['firstname'] . ' ' . $address['Address']['lastname']);?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo $address['Address']['e_mail'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo $address['Address']['house_no'] . ' ' . $address['Address']['street'] . ' ,' . $address['Location']['bezei_city'] . ' ,' . $address['Address']['district'] . ' ' . $address['Address']['postl_cod1'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo $address['Location']['bezei'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo $address['Location']['landx'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <div>
                                                                        <p class="icssd">
                                                                            <?php echo $this->Html->link($this->Html->image('icons/edit.png'), array('controller' => 'users', 'action' => 'addAddress', $address['Address']['id']), array('escape' => false))?>
                                                                        </p>

                                                                        <p class="icssd">
                                                                            <?php echo $this->Html->link($this->Html->image('icons/1379634951_101.png'), array('controller' => 'users', 'action' => 'deleteAddress',$address['Address']['id']), array('escape' => false),'Are you sure you want to delete?')?>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" align="center">
                                                                No address has been added yet
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
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