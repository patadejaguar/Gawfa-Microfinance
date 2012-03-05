<?php if(isset($this->params['url']['csv']) && $this->params['url']['csv'] == "true"){
  $csv = new CsvHelper();
  $csv->addRow(array('Customer Name', 'Amount', 'Payment Period', 'Interest', 'Disbursement Date'));
  foreach ($all_loanaccount as $loanaccount){
    $csv->addRow(array(
        $loanaccount['Customer']['firstname'].' '.$loanaccount['Customer']['lastname'],
        $this->Number->currency($loanaccount['Loanaccount']['amount'], Configure::read('currencySymbol')),
        $loanaccount['Loanaccount']['paymentperiod'],
        $loanaccount['Loanaccount']['interest'],
        $this->Time->nice($loanaccount['Loanaccount']['disbursementdate'])
        ));
  }
echo $csv->render('LoanAccountReports.csv'); //TODO: Add date range to file name
exit;
} ?>
<div class="loanaccounts index" style="width:100%">
  <div style="float: right; margin-bottom: 5px;">
    <?php
    echo $this->Form->create('Loanaccount', array('type' => 'get'));
    // Search box
    echo $this->Form->input('date_from', array('label' => 'Serach From', 'class' => 'datepicker')); // Search from date
    echo $this->Form->input('date_to', array('label' => 'Search To', 'class' => 'datepicker')); // Search to date

    echo "<input type='submit' value='Search' />";
    ?>
    <?php echo"</form>" ?>
  </div>

  <table cellpadding="0" cellspacing="0">
    <tr>

      <th>Customer Name</th>
      <th><?php echo $this->Paginator->sort('amount'); ?></th>
      <th><?php echo $this->Paginator->sort('paymentperiod', 'Payment Period'); ?></th>
      <th><?php echo $this->Paginator->sort('interest'); ?></th>

      <th><?php echo $this->Paginator->sort('disbursementdate', 'Disbursement Date'); ?></th>

    </tr>
    <?php
    $i = 0;
    // debug($loanaccounts);
    foreach ($loanaccounts as $loanaccount): ?>
      <tr>

        <td><?php echo h($loanaccount['Customer']['firstname']); ?>&nbsp;<?php echo h($loanaccount['Customer']['lastname']); ?></td>
        <td><?php echo $this->Number->currency($loanaccount['Loanaccount']['amount'], Configure::read('currencySymbol')); ?>&nbsp;</td>
        <td><?php echo h($loanaccount['Loanaccount']['paymentperiod']); ?>&nbsp;Months</td>
        <td><?php echo h($loanaccount['Loanaccount']['interest']); ?>&nbsp;%</td>

        <td><?php echo $this->Time->nice($loanaccount['Loanaccount']['disbursementdate']); ?>&nbsp;</td>



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
    
    <?php echo $this->Html->link('Export to Excel', $this->here.(strpos($this->here,'?')===false?'?':'&')."csv=true", array('class' => 'export-excel')); ?>

</div>

<script>
  $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
</script>