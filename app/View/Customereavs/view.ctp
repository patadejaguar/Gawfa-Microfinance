<div class="customereavs view">
<h2><?php  echo __('Customereav');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($customereav['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $customereav['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($customereav['Customereav']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customereav'), array('action' => 'edit', $customereav['Customereav']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customereav'), array('action' => 'delete', $customereav['Customereav']['id']), null, __('Are you sure you want to delete # %s?', $customereav['Customereav']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customereavs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customereav'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
