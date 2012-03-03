<table cellpadding="0" cellspacing="0">
        <tr>
            <th>Account Number</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Telephone</th>
            <th>Sex</th>


        </tr>
        <?php
        $i = 0;
        foreach ($customers as $customer):
            ?>
            <tr>
                <td><?php echo h($customer['Customer']['account_number']); ?>&nbsp;</td>

                <td><?php echo h($customer['Customer']['firstname']); ?>&nbsp;</td>
                <td><?php echo h($customer['Customer']['lastname']); ?>&nbsp;</td>
                <td><?php echo h($customer['Customer']['address']); ?>&nbsp;</td>
                <td><?php echo h($customer['Customer']['telephone']); ?>&nbsp;</td>
                <td><?php echo h($customer['Customer']['sex']); ?>&nbsp;</td>


            </tr>
<?php endforeach; ?>
    </table>