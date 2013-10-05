<script type="text/javascript">
    $(document).ready(function () {
        $('.paynow').click(function () {
            $('#orderReview').submit();
        });
    })
    function ShowHide(id, origin, destination) {
        if (id == 1) {
            var weight = $('#weight').val();
            $.ajax({
                type: "GET",
                url: "/estore/carts/calculateShipping/" + origin + "/" + destination + "/" + weight,
                success: function (result) {
                    var result = JSON.parse(result);
                    if (result.status) {
                        $('#shipping_charge').html('$' + result.shipping_charge);
                        $('#grand_total').html('$' + result.grand_total);
                        $('#is_ship').val(1);
                        $('#article1').show();
                        $('#article2').hide();
                    } else {
                        alert(result.msg);
                    }
                }
            })
        } else {
            $('#is_ship').val(0);
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
            $weight = 0;
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
                    <td>
                        <?php
                        echo '$' . number_format($val['Cart']['qty'] * $val['Product']['umrez'] * $price, 2);
                        if ($val['Product']['gewei'] == 'KG') {
                            $unit_weight = $val['Product']['ntgew'] * 100;
                        } else {
                            $unit_weight = $val['Product']['ntgew'];
                        }
                        $weight = $weight + $val['Cart']['qty'] * $val['Product']['umrez'] * $unit_weight;
                        ?>
                    </td>
                </tr>
                <?php
                $total = $total + ($val['Cart']['qty'] * $val['Product']['umrez'] * $price);
            }
            $weight = $weight * 0.00220462;
            ?>
            <input type="hidden" id="weight" value="<?php echo $weight; ?>">
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
                            <td width="214" rowspan="4" align="right" class="black12">&nbsp;</td>
                            <td width="86" height="30" align="right" class="black12"><strong>Subtotal:</strong></td>
                            <td width="100" align="center" class="black12">$<?php echo number_format($total, 2);?></td>
                        </tr>
                        <?php
                        if ($this->Session->read('apply_tax')) {
                            if ($tax > 0) {
                                $tax = $total * $tax / 100;
                                ?>
                                <tr>
                                    <td height="30" align="right" class="black12"><strong>Sale Tax:</strong></td>
                                    <td align="center" class="black12">$<?php echo number_format($tax, 2);?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            $tax = 0;
                        }
                        ?>
                        <?php
                        $discount = 0;
                        if ($this->Session->read('konda') == 'RL') {
                        ?>
                        <tr>
                            <td height="30" align="right" class="black12"><strong>Discount:</strong></td>
                            <td align="center" class="black12">
                                <?php
                                $discount = $this->requestAction('/carts/calculateDiscount/' . ($total + $tax) . '/' . $cart[0]['Cart']['ship_location']);
                                $discount = $total * $discount / 100;
                                echo '$' . number_format($discount, 2);
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td height="30" align="right" class="black12"><strong>Total:</strong></td>
                            <td align="center" class="black12">
                                <?php
                                echo '$' . number_format($total + $tax - $discount, 2);
                                $_SESSION['tax'] = $tax;
                                $_SESSION['total'] = $total;
                                $_SESSION['subtotal'] = $total + $tax - $discount;
                                $_SESSION['grand_total'] = $_SESSION['subtotal'];
                                $_SESSION['trade_discount'] = $discount;
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
<?php
echo $this->Form->create('Cart', array('controller' => 'carts', 'action' => 'orderReview', 'id' => 'orderReview'));
?>
<tr>
    <td>
        <div id="article1" style="display: none;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" align="right">
                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="214" rowspan="3" align="right" valign="top" class="black12">(Delivers in 5-7
                                    busness days)
                                </td>
                                <td width="86" height="30" align="right" class="black12"><strong>Shipping
                                        Charges:</strong></td>
                                <td width="100" align="center" class="black12">
                                    <span id="shipping_charge"></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" align="right" class="black12"><strong>Grand Total:</strong></td>
                                <td align="center" class="black12">
                                    <span id="grand_total"></span>
                                    <input type="hidden" id="is_ship" name="is_ship" value="0">
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
                                <td align="right">
                                    <a href="#" class="paynow">PROCEED TO PAYMENT</a>
                                </td>
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