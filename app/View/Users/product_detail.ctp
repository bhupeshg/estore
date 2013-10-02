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
                                                <input type="text" name="textfield" id="textfield"></td>
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
                                            <td><strong>Socket head cap screws
                                                </strong></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="altrowstable" id="alternatecolor">
                                                    <tr>
                                                        <th>Family</th>
                                                        <th>Product Discription</th>
                                                        <th>Grade/Quality</th>
                                                        <th>Surface Finish/Coating</th>
                                                        <th>Thread</th>
                                                        <th>Standard</th>
                                                    </tr>
                                                    <?php
                                                    if (!empty($products)) {
                                                        foreach ($products as $product) {
                                                            ?>
                                                            <tr>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['ProductType']['parentgroupid'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php
                                                                    echo $this->Html->link($product['ProductType']['wgbez60-matkl'], array('controller' => 'users', 'action' => 'products', $product['Product']['id']));
                                                                    ?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr3'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr4'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr2'];?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php echo
                                                                    $product['Product']['wgbez60-mvgr5'];?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                    ?>
                                                    <tr>
                                                        <td align="center" colspan="6">
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