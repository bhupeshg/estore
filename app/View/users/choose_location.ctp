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
        <tr>
            <td align="left">
                Please Select below the nearest location to proceed with the shopping cart process: <br/><br/>
                <?php
                echo $this->Form->create('User');
                ?>
                <table width="100%" border="0">
                    <tr>
                        <td>
                            <label>Location:</label>
                        </td>
                        <td>
                            <?php
                            echo $this->Form->input('location', array('options' => $plants, 'div'=>false,'label'=>false, 'class' => 'forgerttxt','empty'=>'--Select Location--','required'=>'required'));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <?php echo $this->Form->end('buttons/submit.jpg');  ?>
                        </td>
                    </tr>
                </table>
                <br/>
                <br/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>