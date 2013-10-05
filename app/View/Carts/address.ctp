<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#AddressCountry').change(function () {
            $.ajax({
                type: "GET",
                url: "/jkt/estore/users/getStates/" + $(this).val(),
                success: function (data) {
                    $('#AddressBland').html(data);
                }
            })
        });

        $('#CartsSelectAddress').change(function () {
            $.ajax({
                type: "GET",
                url: "/jkt/estore/carts/getAddress/" + $(this).val(),
                dataType: 'JSON',
                success: function (data) {
                    $.each(data, function (index, element) {
                        if (index == 'listCountries') {
                            $('#AddressCountry').html(element);
                        } else if (index == 'listStates') {
                            $('#AddressBland').html(element);
                        } else {
                            $('#' + index).val(element);
                        }

                    });
                    //data = JSON.parse(data);
                }
            })
        });

        $(function () {
            var dob = $("#AddressCusDob").attr('value');
            $("#AddressCusDob").datepicker();
            $("#AddressCusDob").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#AddressCusDob").datepicker("option", "changeYear", true);
            $("#AddressCusDob").datepicker("option", "yearRange", "1950:2012");
            $("#AddressCusDob").val(dob);
        });

    });
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
    <?php echo $this->Form->create('Customer', array('controller' => false, 'action' => false)); ?>
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
                <?php //echo $this->Form->input('Customer.country', array('options' => $countries, 'empty' => '--Select Country--', 'label' => false, 'div' => false, 'selected' => $billing['Customer']['country'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?>
                <?php echo $this->Form->input('Customer.country', array('label' => false, 'div' => false, 'value' => $billing['Customer']['Country']['landx'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> State/Province:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.State', array('label' => false, 'div' => false, 'value' => $billing['Customer']['State']['bezei'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> City:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.city', array('label' => false, 'div' => false, 'value' => $billing['Customer']['city'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> District:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.district', array('label' => false, 'div' => false, 'value' => $billing['Customer']['district'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Postal Code:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.postl_cod1', array('label' => false, 'div' => false, 'value' => $billing['Customer']['postl_cod1'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Street:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.street', array('label' => false, 'div' => false, 'value' => $billing['Customer']['street'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Building:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.building', array('label' => false, 'div' => false, 'value' => $billing['Customer']['building'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Floor:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.floor', array('label' => false, 'div' => false, 'value' => $billing['Customer']['floor'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> House No:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Customer.house_no', array('label' => false, 'div' => false, 'value' => $billing['Customer']['house_no'], 'class' => 'forgerttxt form-control', 'disabled' => 'disabled')); ?></td>
        </tr>
    </table>
    <?php echo $this->Form->end();?>
</td>
<td width="10">&nbsp;</td>
<td valign="top">
    <?php echo $this->Form->create('Carts', array('url' => 'createUpdateAddress', 'id' => 'shippingAddress', 'method' => 'POST'));
    echo $this->Form->hidden('Address.id', array('label' => false, 'div' => false, 'class' => 'form-control'));    
    ?>
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
            <td align="left">
                <?php echo $this->Form->input('Address.firstname', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Last Name:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.lastname', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Email Address:<span class="red">*</span>
            </td>
        </tr>
        <tr>
            <td align="left">
                <?php echo $this->Form->input('Address.e_mail', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Date of Birth:<span class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.cus_dob', array('label' => false, 'div' => false, 'class' => 'forgerttxt',  'type' => 'text', 'readonly' => true)); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Phone Number:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.tel1_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Mobile Number:<span class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.mob_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Fax:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.fax_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt form-control')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12">Country:<span
                    class="red"></span></td>
        </tr>
        <tr>
            <td align="left">
                <?php echo $this->Form->input('Address.country', array('options' => $countries, 'empty' => '--Select Country--', 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> State/Province:</td>
        </tr>
        <tr>
            <td align="left">
                <?php echo $this->Form->input('Address.bland', array('options' => $countries, 'empty' => '--Select State--', 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
            </td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> City:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.city', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> District:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.district', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Postal Code:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.postl_cod1', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Street:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.street', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Building:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.building', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> Floor:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.floor', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td width="462" align="left" class="grey12"> House No:</td>
        </tr>
        <tr>
            <td align="left"><?php echo $this->Form->input('Address.house_no', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
        </tr>
        <tr>
            <td align="left"><input name="input2" type="submit" value="Update Existing Address"
                                    class="submit_b">
            <input name="input3" type="submit" value="Create New Address"
                                    class="submit_b">
            </td>
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