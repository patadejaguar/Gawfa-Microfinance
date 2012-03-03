<div class="loanaccounts index">
	<h2><?php echo __('Loan Accounts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
	
			<th><?php echo $this->Paginator->sort('customer_id');?></th>

			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('paymentperiod', 'Payment Period');?></th>
			<th><?php echo $this->Paginator->sort('interest');?></th>
	
			<th><?php echo $this->Paginator->sort('disbursementdate', 'Disbursement Date');?></th>


			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($loanaccounts as $loanaccount): ?>
	<tr>

		<td><?php echo h($loanaccount['Customer']['firstname']); ?>&nbsp;<?php echo h($loanaccount['Customer']['lastname']); ?></td>
		<td><?php echo $this->Number->currency($loanaccount['Loanaccount']['amount'], Configure::read('currencySymbol')); ?>&nbsp;</td>
		<td><?php echo h($loanaccount['Loanaccount']['paymentperiod']); ?>&nbsp;Months</td>
		<td><?php echo h($loanaccount['Loanaccount']['interest']); ?>&nbsp;%</td>

		<td><?php echo $this->Time->nice($loanaccount['Loanaccount']['disbursementdate']); ?>&nbsp;</td>
	

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $loanaccount['Loanaccount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $loanaccount['Loanaccount']['id'])); ?>
			<?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $loanaccount['Loanaccount']['id']), null, __('Are you sure you want to delete # %s?', $loanaccount['Loanaccount']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Loanaccount'), array('action' => 'add/'.$loanaccount['Customer']['id'])); ?></li>
	</ul>
</div>
