<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div class="center" style="margin-left: 10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left"><h1 class="heading">Product Family</h1></td>
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
        <td>
            <?php
            $i = 0;
            foreach ($product_groups as $group) {

                ?>
                <div class="productmain">
                    <div class="pro-img">
                        <?php echo $this->Html->image('product_group/' . $group['ProductGroup']['image'], array('width' => 175, 'height' => 135));?>
                    </div>
                    <div class="pro-desc"><?php echo $group['ProductGroup']['parentgroupid'];?></div>
                    <div
                        class="pro-link"><?php echo $this->Html->link('View Product Categories', array('controller'=>'users','action'=> 'productCategory', $group['ProductGroup']['parentgroupid']))?>
                    </div>
                </div>
                <?php
                $i++;
                if ($i % 4 == 0) {
                    echo "</td></tr><tr><td>&nbsp;</td></tr><tr><td>";
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="left"><h1 class="heading">We Accept</h1></td>
    </tr>
    <tr>
        <td height="10"></td>
    </tr>
    <tr>
        <td>
            <table width="325" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><img src="/unbrako/img/cc/american.jpg" width="51" height="32"
                                          alt=""></td>
                    <td align="center"><img src="/unbrako/img/cc/discover.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="center"><img src="/unbrako/img/cc/mastercard.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="center"><img src="/unbrako/img/cc/paypal.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="right"><img src="/unbrako/img/cc/visa.jpg" width="51" height="32" alt="">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>