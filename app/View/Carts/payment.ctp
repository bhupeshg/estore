<script type="text/javascript">
    $(document).ready(function () {
        $('#paynow').click(function () {
            $('#processPayment').submit();
        });
    })
    function ShowHide(id) {
        if (id == 1) {
            $('#CartIsCredit').val(1);
            $('#article2').hide();
            $('#processPayment').submit();
            /*$.ajax({
                type: "GET",
                url: "/estore/carts/checkCredit",
                success: function (result) {
                    var result = JSON.parse(result);
                    alert(result.msg);
                    $('#processPayment').submit();
                }
            })*/
        } else {
            $('#CartIsCredit').val(0);
            $('#article2').show();
        }
    }
</script>
<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Process Payment</h1></td>
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
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="100%" valign="top">
            <a class="pickup cursor" onClick="javascript: ShowHide(1);">Use Credit</a>
            or
            <a class="dlivery cursor" onClick="javascript: ShowHide(2);">Pay Now</a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">
            <div id='article2' style="display: none;">
                <table width="98%" border="0" cellspacing="0" cellpadding="0" class="greyborder">
                    <tr>
                        <td align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="10" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" class="registerheading">CREDIT CARD INFORMATION</td>
                                </tr>
                                <tr>
                                    <td height="10" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <?php
                                        echo $this->Form->create('Cart', array('controller' => 'carts', 'action' => 'processPayment','id'=>'processPayment'));
                                        echo $this->Form->hidden('Cart.is_ship', array('value' => $is_ship));
                                        echo $this->Form->hidden('Cart.is_credit', array('value' => 0));
                                        ?>
                                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="2">Complete the form below and then click the &quot;Pay Now
                                                    &quot; button to pay for your order using our secure server.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10" colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td width="183" align="left" class="grey12">Card Holder Name:<span
                                                        class="red">*</span>
                                                </td>
                                                <td width="702" align="left">
                                                    <?php echo $this->Form->input('Cart.name', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="183" align="left" class="grey12">Card Number:<span
                                                        class="red">*</span>
                                                </td>
                                                <td width="702" align="left">
                                                    <?php echo $this->Form->input('Cart.cc_number', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="183" align="left" class="grey12">Expiry Date:<span
                                                        class="red">*</span>
                                                </td>
                                                <td width="702" align="left">
                                                    <?php
                                                    $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
                                                    $year = range(date('Y'), date('Y') + 10, 1);
                                                    ?>
                                                    <?php echo $this->Form->input('Cart.exp_mon', array('options' => $months, 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                                    <?php echo $this->Form->input('Cart.exp_yr', array('options' => $year, 'label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="183" align="left" class="grey12">Security Code:<span
                                                        class="red">*</span>
                                                </td>
                                                <td width="702" align="left">
                                                    <?php echo $this->Form->input('Cart.cvv', array('label' => false, 'div' => false, 'class' => 'forgerttxt')); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    &nbsp;
                                                </td>
                                                <td align="left">
                                                    <input name="input3" type="button"
                                                           value="Pay Now" class="atc_b" id='paynow'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>