<h2>Manage Customers</h2>
<br/>
<?php echo $this->Session->flash('success'); ?>
<?php echo $this->Session->flash('failure'); ?>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    <tr>
        <th scope="col"
            class="rounded"><?php echo $this->Paginator->sort('Customer.firstname', 'Name', array('style' => 'color:#ffffff;'));?></th>
        <th scope="col"
            class="rounded"><?php echo $this->Paginator->sort('Customer.konda', 'Type', array('style' => 'color:#ffffff;'));?></th>
        <th scope="col"
            class="rounded"><?php echo $this->Paginator->sort('Customer.e_mail', 'Email', array('style' => 'color:#ffffff;'));?></th>
        <th scope="col" class="rounded">Address</th>
        <th scope="col" class="rounded">Licence</th>
        <th scope="col" class="rounded">Status</th>
        <th scope="col" class="rounded">Verify Status</th>
        <th scope="col" class="rounded">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $customer) { ?>
        <tr>
            <td><?php echo ucwords($customer['Customer']['firstname'] . ' ' . $customer['Customer']['lastname']);?></td>
            <td>
                <?php
                $types = array('RL' => 'Retail', 'DR' => 'Dealer', 'OE' => 'OEM', 'GT' => 'Govt. Emp.');
                echo $types[$customer['Customer']['konda']];
                ?>
            </td>
            <td><?php echo $customer['Customer']['e_mail'];?></td>
            <td><?php echo $customer['Customer']['house_no'] . ' ' . $customer['Customer']['street'] . ' ,' . $customer['Customer']['city'] . ' ,' . $customer['Customer']['district'] . ' ,' . $customer['Customer']['State']['bezei'] . ' ,' . $customer['Customer']['Country']['landx'];?></td>
            <td>
                <?php
                if (!empty($customer['Customer']['stceg']))
                    echo $this->Html->link('Licence', '/files/' . $customer['Customer']['stceg']);
                ?>
            </td>
            <td>
                <?php
                $status = array('0' => 'In-active', '1' => 'Active');
                echo $status[$customer['Customer']['status']];
                ?>
            </td>
            <td>
                <?php
                if (in_array($customer['Customer']['konda'], array('OE', 'DR', 'GT'))) {
                    $status = array('0' => 'Pending', '1' => 'In Progress', '2' => 'Verified', '3' => 'Blacklisted');
                    echo $status[$customer['Customer']['verify_status']];
                }
                ?>
            </td>
            <td>
                <?php echo $this->Html->link($this->Html->image('user_edit.png', array('border' => 0)), array('controller' => 'users', 'action' => 'editUser', $customer['User']['id'], 'admin' => true), array('escape' => false))?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

<div class="pagination">
    <?php
    echo $this->Paginator->prev('<< prev', array(), null, array('class' => 'disabled'));
    echo $this->Paginator->numbers(array('separator' => false));
    echo $this->Paginator->next('next >>', array(), null, array('class' => 'disabled'));
    ?>
</div>
<div class="c-both"></div>