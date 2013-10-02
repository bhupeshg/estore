<script type="text/javascript">
    $(document).ready(function () {
        $('#update').click(function () {
            $('#'+$(this).attr('rel')).submit();
        });
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" align="center" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td valign="top">
                                    <table width="99%" border="0" align="right" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0"
                                                       cellpadding="0">
                                                    <tr>
                                                        <td class="black12"><i>You have
                                                                <strong><?php echo count($data);?></strong>
                                                                products in your
                                                                shopping cart</i>
                                                        </td>
                                                        <td align="right"><input name="input3"
                                                                                 type="button"
                                                                                 value="Proceed Checkout"
                                                                                 class="atc_b"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0"
                                                       cellpadding="0" class="altrowstable1"
                                                       id="alternatecolor">
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Description</th>
                                                        <th>Box Qty</th>
                                                        <th>No. of Boxes</th>
                                                        <th>Price per Piece</th>
                                                        <th>Item Total</th>
                                                    </tr>
                                                    <?php
                                                    if (!empty($data)) {
                                                        $total = 0;
                                                        foreach ($data as $val) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $val['Product']['matnr'];?></td>
                                                                <td><?php echo $val['Product']['wgbez60-matkl'] . ', ' . $val['Product']['wgbez60-mvgr4'] . ' ' . $val['Product']['wgbez60-mvgr2'] . ' Threaded';?></td>
                                                                <td><?php echo $val['Product']['umrez'];?></td>
                                                                <td align="center">
                                                                    <?php
                                                                    echo $this->Form->create('Cart', array('controller' => 'carts', 'action' => 'update', 'id' => $val['Cart']['id']));
                                                                    echo $this->Form->hidden('Cart.id', array('value' => $val['Cart']['id']));
                                                                    ?>
                                                                    <div class="ara">
                                                                        <p class="nrm">
                                                                            <?php echo $this->Form->input('Cart.qty', array('label' => false, 'div' => false, 'class' => 'smaltxt', 'type' => 'text', 'value' => $val['Cart']['qty'])); ?>
                                                                        </p>

                                                                        <p class="nrm">
                                                                            <a href="#" class="blue12" id="update"
                                                                               rel="<?php echo $val['Cart']['id']; ?>">Update</a>
                                                                        </p>

                                                                        <p class=" nrm"><a href="#"
                                                                                           class="red12">Delete</a>
                                                                        </p>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php $price = $val['Product']['ProductAvailability']['kbetr'] - ($val['Product']['ProductAvailability']['kbetr'] * ($this->Session->read('discount') + ONLINE_DISCOUNT) / 100);
                                                                    echo '$' . number_format($price, 2);?>
                                                                </td>
                                                                <td><?php echo '$' . $val['Cart']['qty'] * $val['Product']['umrez'] * $price;?></td>
                                                            </tr>
                                                        <?php
                                                            $total = $total + ($val['Cart']['qty'] * $val['Product']['umrez'] * $price);
                                                        }
                                                    } else {
                                                    ?>
                                                    <tr>
                                                        <td align="center" colspan="4">
                                                            Sorry no product available
                                                        </td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0"
                                                       cellpadding="0">
                                                    <tr>
                                                        <td align="right">
                                                            <table width="100%" border="0"
                                                                   cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td height="30" align="right"
                                                                        class="black12"><strong>Subtotal:</strong>
                                                                    </td>
                                                                    <td width="100" align="middle"
                                                                        class="black12">$<?php echo $total;?>
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
                                                        <td>
                                                            <table width="100%" border="0"
                                                                   cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="left"><span
                                                                            class="paddingleft1">
                      <input name="input" type="button" value="Continue Shopping" class="greenb">
                      </span></td>
                                                                    <td align="center"><span
                                                                            class="paddingleft1">
                      <input name="input2" type="button" value="Email Cart" class="submit_b">
                      </span></td>
                                                                    <td align="right"><span
                                                                            class="paddingleft1">
                      <input name="input3" type="button" value="Proceed Checkout" class="atc_b">
                      </span></td>
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