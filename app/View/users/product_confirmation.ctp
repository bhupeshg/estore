<div class="center" style="margin-left: 10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left"><h1 class="heading">Product Catalogue</h1></td>
            <td align="left">
                <?php
                echo $this->element('cpanel');
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                Please Select how you want to proceed: <br/><br/>
                <?php echo $this->Html->link($this->Html->image('place_order'), array('controller' => 'users', 'action' => 'chooseLocation'), array('escape' => false));?>
                <br/><br/>
                <?php echo $this->Html->link($this->Html->image('view_info'), array('controller' => 'users', 'action' => 'productFamily'), array('escape' => false));?>
                <br/>
                <br/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>