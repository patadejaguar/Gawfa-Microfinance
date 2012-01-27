<div id="dashboad" class="index">
    <ul class="dashboard_menu">
        <li class="customers"><?php echo $this->Html->link('Customers', array('controller' => 'customers', 'action' => 'index'), array('class' => 'button')); ?></li>
        <li class="finance"><?php echo $this->Html->link('Finance', array('controller' => 'customers', 'action' => 'index'), array('class' => 'button')); ?></li>
        <li class="branches"><?php echo $this->Html->link('Branches', array('controller' => 'branches', 'action' => 'index'), array('class' => 'button')); ?></li>
        
        <li class="reports"><?php echo $this->Html->link('Reports', array('controller' => 'users', 'action' => 'index'), array('class' => 'button')); ?></li>
        
        <li class="settings"><?php echo $this->Html->link('Settings', array('controller' => 'groups', 'action' => 'index'), array('class' => 'button')); ?></li>

    </ul>
</div>