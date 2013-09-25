<table width="925" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><h1 class="heading">Login In To Your Account</h1></td>
                    <td>
                        <div class="breadcrum">
                            <ul>
                                <li><a href="#">Cart</a></li>
                                <li>
                                    <?php echo $this->Html->image('bredcrum_arrow.jpg', array('width' => 15, 'height' => '26'));?>
                                </li>
                                <li><a href="#">Login</a></li>
                                <li>
                                    <?php echo $this->Html->image('bredcrum_arrow.jpg', array('width' => 15, 'height' => '26'));?>
                                </li>
                                <li><a href="#">Address</a></li>
                                <li>
                                    <?php echo $this->Html->image('bredcrum_arrow.jpg', array('width' => 15, 'height' => '26'));?>
                                </li>
                                <li><a href="#">Shipping</a></li>
                                <li>
                                    <?php echo $this->Html->image('bredcrum_arrow.jpg', array('width' => 15, 'height' => '26'));?>
                                </li>
                                <li><a href="#">Payment</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="greyborder">
                <tr>
                    <td align="center" valign="top">
                        <?php
                        echo $this->Form->create('Users');
                        ?>
                        <table width="567" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td align="left" class="black15"><span class="grey15">Unbrako</span>
                                    Log In
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12">Email:</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('User.e_mail',array('label'=>false,'div'=>false ,'class'=>'logintxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td align="left" class="grey12">Password:</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->input('User.password',array('label'=>false,'div'=>false ,'class'=>'logintxt','type'=>'password')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->end('buttons/login.jpg');  ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="330" bgcolor="#fbfbfb">
                        <?php
                        echo $this->Form->create('Users',array('controller'=>'users','action'=>'forgotPassword'));
                        ?>
                        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"
                               class="paddingleft">
                            <tr>
                                <td height="10"></td>
                            </tr>
                            <tr>
                                <td class="black15">Forgot Your Password?</td>
                            </tr>
                            <tr>
                                <td class="grey12">Enter your username to receive your password.
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="grey12">Email:</td>
                            </tr>
                            <tr>
                                <td align="left"><label for="textfield"></label>
                                    <?php echo $this->Form->input('User.e_mail',array('label'=>false,'div'=>false ,'class'=>'forgerttxt')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Form->end('buttons/submit.jpg');  ?>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left"><span class="black15">New to</span> <span
                                        class="grey15">Unbrako?</span></td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <?php echo $this->Html->link($this->Html->image('buttons/createanaccount.jpg'),array('controller'=>'users','action'=>'registerStep1'),array('escape'=>false));?>
                                </td>
                            </tr>
                            <tr>
                                <td height="10"></td>
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
        <td align="left"><h1 class="heading">We Accept</h1></td>
    </tr>
    <tr>
        <td height="10"></td>
    </tr>
    <tr>
        <td>
            <table width="325" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left"><img src="../img/cc/american.jpg" width="51" height="32"
                                          alt=""></td>
                    <td align="center"><img src="../img/cc/discover.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="center"><img src="../img/cc/mastercard.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="center"><img src="../img/cc/paypal.jpg" width="51" height="32"
                                            alt=""></td>
                    <td align="right"><img src="../img/cc/visa.jpg" width="51" height="32" alt="">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>