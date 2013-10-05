<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#CustomerCountry').change(function () {
            $.ajax({
                type: "GET",
                url: "/estore/users/getStates/" + $(this).val(),
                success: function (data) {
                    $('#CustomerBland').html(data);
                }
            })
        });

        /*$('#CustomerBland').change(function () {
         var country = $('#CustomerCountry').val();
         $.ajax({
         type: "GET",
         url: "/jkt/estore/users/getCities/" + country + "/" + $(this).val(),
         success: function (data) {
         $('#CustomerCity').html(data);
         }
         })
         });*/

        $(function () {
            $("#datepicker").datepicker();
            $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
            $("#datepicker").datepicker("option", "changeYear", true);
            $("#datepicker").datepicker("option", "yearRange", "1950:2012");
        });

    });
</script>
<?php
echo $this->Form->create('Users', array('controller' => 'users', 'action' => 'register', 'type' => 'file'));
echo $this->Form->hidden('User.user_type', array('value' => $user_type));
?>
<table width="925" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left"><h1 class="heading">Customer Registration Form</h1></td>
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
    <td width="462" align="left" class="grey12">Email Address<span
            class="red">*</span></td>
    <td align="left" class="grey12">Password<span
            class="red">*</span>
    </td>
</tr>
<tr>
    <td align="left">
        <?php echo $this->Form->input('Customer.e_mail', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'type' => 'email')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('User.password', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'type' => 'password')); ?>
    </td>
</tr>
<tr>
    <td width="462" align="left" class="grey12">Customer Legal Name<span
            class="red">*</span></td>
    <td align="left" class="grey12">Date of Birth<span
            class="red">*</span>
    </td>
</tr>
<tr>
    <td align="left">
        <?php echo $this->Form->input('Customer.cus_leg_name', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.cus_dob', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'id' => 'datepicker', 'type' => 'text', 'readonly' => true)); ?>
    </td>
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
        <?php echo $this->Form->input('Customer.firstname', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.lastname', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
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
        <?php echo $this->Form->input('Customer.tel1_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.mob_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
</tr>
<tr>
    <td align="left" class="grey12">Fax</td>
</tr>
<tr>
    <td align="left"><?php echo $this->Form->input('Customer.fax_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?></td>
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
        <?php echo $this->Form->input('Customer.country', array('options' => $countries, 'empty' => '--Select Country--', 'label' => false, 'div' => false, 'class' => 'forgerttxt', 'autocomplete' => 'off')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.bland', array('options' => $states, 'empty' => '--Select State--', 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
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
        <?php echo $this->Form->input('Customer.city', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'type' => 'text')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.district', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
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
        <?php echo $this->Form->input('Customer.postl_cod1', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.street', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
</tr>
<tr>
    <td width="462" align="left" class="grey12">BUILDING</td>
    <td align="left" class="grey12">Floor</td>
</tr>
<tr>
    <td align="left">
        <?php echo $this->Form->input('Customer.building', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left">
        <?php echo $this->Form->input('Customer.floor', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
</tr>
<tr>
    <td align="left" class="grey12">HOUSE_NO<span
            class="red">*</span></td>
</tr>
<tr>
    <td width="462" align="left">
        <?php echo $this->Form->input('Customer.house_no', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
</tr>
<tr>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
</tr>

<!-- In case of wholesaler registration -->

<?php
if ($user_type == 2 || $user_type == 3) {
    ?>
    <tr>
        <td colspan="2" align="left" class="registerheading">BUSINESS INFORMATION</td>
    </tr>
    <tr>
        <td height="10" colspan="2"></td>
    </tr>
    <tr>
        <td width="462" align="left" class="grey12">Applying Credit
            Limit<span class="red"></span></td>
        <td align="left" class="grey12">UPS Account No</td>
    </tr>
    <tr>
        <td align="left">
            <?php echo $this->Form->input('Customer.klime', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
        </td>
        <td align="left">
            <?php echo $this->Form->input('Customer.ups_acc_no', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
        </td>
    </tr>
    <tr>
        <td width="462" align="left" class="grey12">UPS ZIP Code<span
                class="red"></span></td>
        <td align="left" class="grey12">Business Type</td>
    </tr>
    <tr>
        <td align="left">
            <?php echo $this->Form->input('Customer.ups_zip', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
        </td>
        <td align="left">
            <?php echo $this->Form->input('Customer.kdgrp', array('options' => $business_types, 'empty' => '--Busniess Type--', 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
        </td>
    </tr>
    <tr>
        <td width="462" align="left" class="grey12">Year of
            Establishment(Firm)<span class="red"></span></td>
        <td align="left" class="grey12">Legal ID/License</td>
    </tr>
    <tr>
        <td align="left">
            <?php echo $this->Form->input('Customer.year_estd', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
        </td>
        <td align="left"><label for="fileField"></label>
            <?php echo $this->Form->input('Customer.stceg', array('label' => false, 'div' => false, 'class' => 'fileField', 'type' => 'file')); ?>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
    </tr>
<?php } ?>
<!-- Ends here -->

<tr>
    <td colspan="2" align="left" class="registerheading">YOUR INFORMATION</td>
</tr>
<tr>
    <td height="10" colspan="2"></td>
</tr>
<!--tr>
    <td align="left">
        <input type="checkbox" name="checkbox"
               id="checkbox1">
        <label for="checkbox" class="grey12">Same as customer</label>
    </td>
</tr-->
<tr>
    <td height="10" colspan="2" align="left"></td>
</tr>
<tr>
    <td width="462" align="left" class="grey12">Your Name<span
            class="red">*</span></td>
    <td align="left" class="grey12">Your Email ID<span
            class="red">*</span></td>
</tr>
<tr>
    <td align="left">
        <?php echo $this->Form->input('Customer.yr_name', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
    </td>
    <td align="left"><label for="fileField"></label>
        <?php echo $this->Form->input('Customer.yr_email', array('label' => false, 'div' => false, 'class' => 'forgerttxt', 'type' => 'email')); ?>
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