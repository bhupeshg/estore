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

/*
        $('#AddressBland').change(function () {
            var country = $('#AddressCountry').val();
            $.ajax({
                type: "GET",
                url: "/jkt/estore/users/getCities/" + country + "/" + $(this).val(),
                success: function (data) {
                    $('#AddressCity').html(data);
                }
            })
        });
*/

        $(function () {
            var dob = $("#datepicker").attr('value');
            $("#datepicker").datepicker();
            $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#datepicker").datepicker("option", "changeYear", true);
            $("#datepicker").datepicker("option", "yearRange", "1950:2012");
            $("#datepicker").val(dob);
        });

    });
</script>
<?php
echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'addAddress'));
if ($edit) {
    echo $this->Form->hidden('Address.id');
}
?>
<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Add New Address</h1></td>
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
                                <td colspan="2" align="left" class="registerheading">GENERAL INFORMATION</td>
                            </tr>
                            <tr>
                                <td height="10" colspan="2"></td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">First Name<span
                                        class="red">*</span></td>
                                <td align="left" class="grey12">Last Name<span
                                        class="red">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.firstname', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.lastname', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">Email Address<span
                                        class="red">*</span></td>
                                <td align="left" class="grey12">Date of Birth<span
                                        class="red">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.e_mail', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'type' => 'email')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.cus_dob', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'id' => 'datepicker', 'type' => 'text', 'readonly' => true)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">
                                    Phone No
                                </td>
                                <td align="left" class="grey12">
                                    Mob Number
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.tel1_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.mob_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12">Fax</td>
                            </tr>
                            <tr>
                                <td align="left"><?php echo $this->Form->input('Address.fax_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
                            </tr>
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" class="registerheading">BILL TO ADDRESS</td>
                            </tr>
                            <tr>
                                <td height="10" colspan="2"></td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">Country<span
                                        class="red">*</span></td>
                                <td align="left" class="grey12">Province/Region<span
                                        class="red">*</span></td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.country', array('options' => $countries, 'empty' => '--Select Country--', 'label' => false, 'div' => false, 'class' => 'forgerttxt', 'autocomplete' => 'off')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.bland', array('options' => $states, 'empty' => '--Select State--', 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">City<span
                                        class="red">*</span></td>
                                <td align="left" class="grey12">District<span
                                        class="red">*</span></td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.city', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.district', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">Postal Code<span
                                        class="red">*</span></td>
                                <td align="left" class="grey12">Street<span
                                        class="red">*</span></td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.postl_cod1', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.street', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="462" align="left" class="grey12">BUILDING</td>
                                <td align="left" class="grey12">Floor</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.building', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Form->input('Address.floor', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12">HOUSE_NO<span
                                        class="red">*</span></td>
                            </tr>
                            <tr>
                                <td width="462" align="left">
                                    <?php echo $this->Form->input('Address.house_no', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
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