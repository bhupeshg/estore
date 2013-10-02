<script type="text/javascript">
    $(document).ready(function () {
        $('#addToCart').click(function () {
            var matnr = $(this).attr('rel');
            var qty = $('#' + matnr + '_qty').val();
            qty = $.trim(qty);
            if (!qty.length) {
                alert('Please enter the numeric value for quantity');
            } else {
                if (Math.floor(qty) == qty) {
                    $.ajax({
                        type: "GET",
                        url: "/estore/carts/addToCart/" + matnr + "/" + qty,
                        success: function (result) {
                            var result=JSON.parse(result);
                            alert(result.msg);
                        }
                    })
                } else {
                    alert('Please enter the numeric value for quantity');
                }
            }
        });
    });
</script>

<table width="925" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <div class="center" style="margin-left: 10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Product Catalogue</h1></td>
                    <td align="left">
                        <?php echo $this->element('cpanel');?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="200" valign="top" style="border-right:1px solid #ccc; padding-right:5px;">
                                <table width="200" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="leftnavheading"><strong>You Searced for</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul class="searcherfor">
                                                <li><a href="#">asd</a></li>
                                                <li><a href="#">asd</a></li>
                                                <li><a href="#">asd</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td class="leftnavheading"><strong>Search</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="textfield" id="textfield">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="5"></td>
                                    </tr>
                                    <tr>
                                        <td class="paddingleft1"><input name="" type="button" value="Submit"
                                                                        class="submit_b"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="leftnavheading"><strong>Refine your search by:</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td><select data-placeholder="Choose a Country..." class="chosen-select"
                                                    multiple style="width:200px;" tabindex="4">
                                                <option value=""></option>
                                                <option value="United States">United States</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td><select data-placeholder="Choose a Country..." class="chosen-select"
                                                    multiple style="width:200px;" tabindex="4">
                                                <option value=""></option>
                                                <option value="United States">United States</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td height="5"></td>
                                    </tr>
                                    <tr>
                                        <td><input name="" type="button" value="Submit" class="submit_b"></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <div class="prodtb">
                                                <img src="../img/product_detail/pro.jpg" width="174" height="108"
                                                     alt="">

                                                <p>BN 272 - DIN 912 - ISO 4762<br>Hex socket head cap screws
                                                    <br>fully threaded</p>

                                                <p><strong>Material</strong>: Steel</p>

                                                <p><strong>Surface</strong>: black</p>

                                                <p><strong>Quality</strong>: 8.8</p>


                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                   class="altrowstable" id="alternatecolor">
                                                <tr>
                                                    <th>Material Id</th>
                                                    <th>Product Discription</th>
                                                    <th>Dia</th>
                                                    <th>Length</th>
                                                    <th>Box Qty</th>
                                                    <th>Price per Piece</th>
                                                    <th>No of Box Require</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                                <?php
                                                if (!empty($products)) {
                                                    foreach ($products as $product) {
                                                        ?>
                                                        <tr>
                                                            <td align="center">
                                                                <?php echo
                                                                $product['Product']['matnr'];?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                echo $product['ProductType']['parentgroupid'] . ', ' . $product['ProductType']['wgbez60-matkl'];
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo
                                                                $product['Product']['bezei'];?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo
                                                                $product['Product']['groes'];?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo
                                                                $product['Product']['umrez'];?>
                                                            </td>
                                                            <td align="center">
                                                                <?php
                                                                $price = $product['ProductAvailability']['kbetr'] - ($product['ProductAvailability']['kbetr'] * ($this->Session->read('discount') + ONLINE_DISCOUNT) / 100);
                                                                echo '<del>$' . $product['ProductAvailability']['kbetr'] . '</del> <b> Your Price</b> $' . number_format($price, 2);
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <input type="text"
                                                                       name="<?php echo $product['Product']['matnr'] . '_qty'; ?>"
                                                                       id="<?php echo $product['Product']['matnr'] . '_qty'; ?>"
                                                                       class="smaltxt">
                                                            </td>
                                                            <td align="center">
                                                                <div>
                                                                    <p class="btnsd">
                                                                        <input name="" type="button" id="addToCart"
                                                                               value="Add to Basket" class="atc_b"
                                                                               rel="<?php echo $product['Product']['matnr']; ?>">
                                                                    </p>

                                                                    <p class="btnsd">
                                                                        <input name="" type="button"
                                                                               value="Specification" class="speci">
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                ?>
                                                <tr>
                                                    <td align="center" colspan="8">
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

</div>

</td>
<td width="21" valign="top" background="/unbrako/img/rightbar.jpg"></td>
</tr>
</table>