<script type="text/javascript">
    function ShowHide(id, origin, destination) {
        if (id == 1) {
            $.ajax({
                type: "GET",
                url: "/estore/users/calculateShipping/" + origin + "/" + destination,
                success: function (result) {
                    var result = JSON.parse(result);
                    if (result.status) {
                        $('#shipinng_charges').val(result.msg);
                        $('#article1').show();
                        $('#article2').hide();
                    } else {
                        alert(result.msg);
                    }
                }
            })
        } else {
            $('#article2').show();
            $('#article1').hide();
        }
    }
</script>
<table width="925" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left"><h1 class="heading">Order Review Screen</h1></td>
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
<table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
<tr>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="black15 bdrbtm"><strong>Shipping Details</strong></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td valign="top">&nbsp;</td>
</tr>
<tr>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50%" align="left">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" class="flbtm">
                        <tr>
                            <td height="30" colspan="2" align="center" bgcolor="#4c8ffc" class="wite15">
                                <strong>Billing Address</strong></td>
                        </tr>
                        <tr>
                            <td width="105" height="30" align="center" class="black12"><strong> Email
                                    Address:</strong></td>
                            <td width="175" align="left" class="black12"><?php echo $billing['User']['e_mail'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong> Name:</strong>
                            </td>
                            <td align="left"
                                class="black12"><?php echo ucfirst($billing['Customer']['firstname']) . ' ' . ucfirst($billing['Customer']['lastname']);?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong> Phone Number:</strong>
                            </td>
                            <td align="left" class="black12"><?php echo $billing['Customer']['mob_number'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong>Address:</strong>
                            </td>
                            <td align="left" class="black12">
                                &nbsp;<?php echo $billing['Customer']['house_no'] . ' ' . $billing['Customer']['building'] . ' ' . $billing['Customer']['floor'] . ' ' . $billing['Customer']['street'] . ', ' . $billing['Customer']['city'] . ', ' . $billing['Customer']['district'] . ', ' . $billing['Customer']['State']['bezei'] . ', ' . $billing['Customer']['Country']['landx'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong>
                                    Postcode:</strong></td>
                            <td align="left" class="black12"><?php echo $billing['Customer']['postl_cod1'];?></td>
                        </tr>
                    </table>
                </td>
                <td align="right">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" class="flbtm">
                        <tr>
                            <td height="30" colspan="2" align="center" bgcolor="#4c8ffc" class="wite15">
                                <strong>Shipping Address</strong></td>
                        </tr>
                        <tr>
                            <td width="105" height="30" align="center" class="black12"><strong> Email
                                    Address:</strong></td>
                            <td width="175" align="left"
                                class="black12"><?php echo $shipping['Address']['e_mail'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong> Name:</strong>
                            </td>
                            <td align="left"
                                class="black12"><?php echo ucfirst($shipping['Address']['firstname']) . ' ' . ucfirst($shipping['Address']['lastname']);?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong> Phone Number:</strong>
                            </td>
                            <td align="left" class="black12"><?php echo $shipping['Address']['mob_number'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong>Address:</strong>
                            </td>
                            <td align="left" class="black12">
                                &nbsp;<?php echo $shipping['Address']['house_no'] . ' ' . $shipping['Address']['building'] . ' ' . $shipping['Address']['floor'] . ' ' . $shipping['Address']['street'] . ', ' . $shipping['Address']['city'] . ', ' . $shipping['Address']['district'] . ', ' . $shipping['State']['bezei'] . ', ' . $shipping['Country']['landx'];?></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" class="black12"><strong>
                                    Postcode:</strong></td>
                            <td align="left" class="black12"><?php echo $shipping['Address']['postl_cod1'];?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left">&nbsp;</td>
                <td align="right">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td colspan="2" class="black15 bdrbtm"><strong>Order Summary</strong></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="altrowstable1" id="alternatecolor">
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Box Qty</th>
                <th>No. of Boxes</th>
                <th>Price per Piece</th>
                <th>Item Total</th>
            </tr>
            <?php
            $total = 0;
            foreach ($cart as $val) {
                ?>
                <tr>
                    <td><?php echo $val['Product']['matnr'];?></td>
                    <td><?php echo $val['Product']['wgbez60-matkl'] . ', ' . $val['Product']['wgbez60-mvgr4'] . ' ' . $val['Product']['wgbez60-mvgr2'] . ' Threaded';?></td>
                    <td><?php echo $val['Product']['umrez'];?></td>
                    <td><?php echo $val['Cart']['qty'];?></td>
                    <td>
                        <?php $price = $val['Product']['ProductAvailability']['kbetr'] - ($val['Product']['ProductAvailability']['kbetr'] * ($this->Session->read('discount') + ONLINE_DISCOUNT) / 100);
                        echo '$' . number_format($price, 2);?>
                    </td>
                    <td><?php echo '$' . number_format($val['Cart']['qty'] * $val['Product']['umrez'] * $price, 2
                        );?></td>
                </tr>
                <?php
                $total = $total + ($val['Cart']['qty'] * $val['Product']['umrez'] * $price);
            }
            ?>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" align="right">
                    <table width="400" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="214" rowspan="3" align="right" class="black12">&nbsp;</td>
                            <td width="86" height="30" align="right" class="black12"><strong>Subtotal:</strong></td>
                            <td width="100" align="center" class="black12">$<?php echo number_format($total, 2);?></td>
                        </tr>
                        <?php
                        if ($tax > 0) {
                            $tax = $total * $tax / 100;
                            ?>
                            <tr>
                                <td height="30" align="right" class="black12"><strong>Sale Tax:</strong></td>
                                <td align="center" class="black12">$<?php echo number_format($tax, 2);?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td height="30" align="right" class="black12"><strong>Total:</strong></td>
                            <td align="center" class="black12">
                                $
                                <?php
                                echo number_format($total + $tax, 2);
                                $_SESSION['tax'] = $tax;
                                $_SESSION['total'] = $total;
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="2" class="black15 bdrbtm"><strong>Choose Shipping</strong></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>
    <td width="100%" valign="top">
        <a class="pickup cursor" onClick="javascript: ShowHide(2,0,0);">Pickup</a>
        or
        <a class="dlivery cursor" onClick="javascript: ShowHide(1,<?php echo $origin; ?>,<?php echo $destination; ?>);">Delivery</a>
    </td>
</tr>

<tr>
    <td>
        <div id="article1" style="display: none;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" align="right">
                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="214" rowspan="3" align="right" class="black12">&nbsp;</td>
                                <td width="86" height="30" align="right" class="black12"><strong>Shipping:</strong></td>
                                <td width="100" align="center" class="black12">
                                    <span id="shipping_charge"></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" align="right" class="black12"><strong>Grand Total:</strong></td>
                                <td align="center" class="black12">
                                    <span id="grand_total"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td width="100%" align="right">
                        <table width="300" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="right"><a href="#" class="paynow">PROCEED TO PAYMENT</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </td>
</tr>
<tr>
    <td width="100%" align="right">
        <div id="article2" style="display: none;">
            <table width="300" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right"><a href="#" class="paynow">PROCEED TO PAYMENT</a></td>
                </tr>
            </table>
        </div>
    </td>
</tr>

<tr>
    <td colspan="2">&nbsp;</td>
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