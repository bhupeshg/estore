<script type="text/javascript">
    $(document).ready(function () {

    })
</script>
<table width="925" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left"><h1 class="heading">Shopping Cart</h1></td>
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
<table width="98%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">
    <?php echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'addAddress')); ?>
    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0"
           class="flbtm">
        <tr>
            <td height="30" align="center" bgcolor="#4c8ffc" class="wite15">Billing
                Address
            </td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">First Name:<span
                    class="red">*</span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['firstname']) ? $billing['Customer']['firstname'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Last Name:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['lastname']) ? $billing['Customer']['lastname'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Email Address:<span class="red">*</span>
            </td>
        </tr>
        <tr>
            <td align="left"><input name="textfield"
                                    value="<?php echo isset($billing['Customer']['e_mail']) ? $billing['Customer']['e_mail'] : ''; ?>"
                                    disabled="disabled" type="text" class="forgerttxt form-control" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Date of Birth:<span class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['cus_dob']) ? $billing['Customer']['cus_dob'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Phone Number:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['tel1_number']) ? $billing['Customer']['tel1_number'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Mobile Number:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['mob_number']) ? $billing['Customer']['mob_number'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Fax:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield" type="text" class="forgerttxt form-control"
                                    value="<?php echo isset($billing['Customer']['fax_number']) ? $billing['Customer']['fax_number'] : ''; ?>"
                                    disabled="disabled" id="textfield"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Country:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left">
                <?php //echo $this->Form->input('Address.country', array('options' => $countries, 'empty' => '--Select Country--', 'label' => false, 'div' => false, 'selected' => $billing['Customer']['country'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?>
                <?php echo $this->Form->input('Address.country', array('label' => false, 'div' => false, 'value' => $billing['Customer']['Country']['landx'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> State/Province:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.State', array('label' => false, 'div' => false, 'value' => $billing['Customer']['State']['bezei'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> City:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.city', array('label' => false, 'div' => false, 'value' => $billing['Customer']['city'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> District:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.district', array('label' => false, 'div' => false, 'value' => $billing['Customer']['district'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Postal Code:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.postl_cod1', array('label' => false, 'div' => false, 'value' => $billing['Customer']['postl_cod1'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Street:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.street', array('label' => false, 'div' => false, 'value' => $billing['Customer']['street'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Building:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.building', array('label' => false, 'div' => false, 'value' => $billing['Customer']['building'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Floor:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.floor', array('label' => false, 'div' => false, 'value' => $billing['Customer']['floor'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> House No:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.house_no', array('label' => false, 'div' => false, 'value' => $billing['Customer']['house_no'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
    </table>
    <?php echo $this->Form->end();?>
</td>
<td width="10">&nbsp;</td>
<td valign="top">
    <?php echo $this->Form->create('User', array('url' => 'address', 'id' => 'shippingAddress', 'method' => 'POST')); ?>
    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0"
           class="flbtm">
        <tr>
            <td height="30" align="center" bgcolor="#4283ec" class="wite15">Shipping
                Address
            </td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Choose existing<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left">
                <?php echo $this->Form->input("select_address", array("type" => "select", "options" => $shippingAddressList, "class" => "forgerttxt", "label" => false, "div" => false, "empty" => "-Select Address-")); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">First Name:<span
                    class="red">*</span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Last Name:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Address Line 1:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Address Line 2:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Suburb/City:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Country:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> State/Province:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Zip/Postcode:</td>
        </tr>
        <tr>
            <td align="left"><input name="textfield2" type="text" class="forgerttxt"
                                    id="textfield2"></td>
        </tr>
        <tr>
            <td height="10" align="left"></td>
        </tr>
        <tr>
            <td align="left"><input name="input2" type="button" value="Submit"
                                    class="submit_b"></td>
        </tr>
        <tr>
            <td height="10" align="left"></td>
        </tr>
    </table>
    <?php echo $this->Form->end();?>
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