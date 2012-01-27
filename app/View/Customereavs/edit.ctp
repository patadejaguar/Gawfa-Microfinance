<div class="customereavs form">
<?php echo $this->Form->create('Customereav');?>
	<fieldset>
		<legend><?php echo __('Edit Customereav'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('type');
		echo $this->Form->input('key');
		echo $this->Form->input('value');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id');
		echo $this->Form->input('user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Customereav.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Customereav.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Customereavs'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
