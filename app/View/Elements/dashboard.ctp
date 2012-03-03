<div id="dashboad" class="index">
    <ul class="dashboard_menu">
        <li class="customers"><?php echo $this->Html->link('Customers', array('controller' => 'customers', 'action' => 'index'), array('class' => 'button')); ?></li>
        <li class="finance"><?php echo $this->Html->link('Finance', array('controller' => 'customers', 'action' => 'index'), array('class' => 'button')); ?></li>
        <li class="branches"><?php echo $this->Html->link('Branches', array('controller' => 'branches', 'action' => 'index'), array('class' => 'button')); ?></li>
        
        <li class="reports"><a href="pages/reports">Reports</a></li>
        
        <li class="settings"><a href="pages/settings">Settings</a></li>

    </ul>
</div>