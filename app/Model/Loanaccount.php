<?php

App::uses('AppModel', 'Model');

/**
 * Loanaccount Model
 * @todo make this model transactional
 *
 */
class Loanaccount extends AppModel {

    /**
     * Interest types
     * @var array
     * 
     */
    protected $interestTypes = array(
        '15PERCENTFIXED' => '% Fixed',
            // '15PERCENTVARIABLE' => '% Variable'
    );

    /**
     * 
     * Dates interests incur
     * @var array 
     * 
     * @todo change this to an object
     */
    protected $interestDates = array(
        'FIRSTDAYMONTH' => array('label' => 'First Day Of The Month', 'timestring' => 'first day of next month'),
        'FIRSTMONDAYMONTH' => array('label' => 'First Monday Of The Month', 'timestring' => 'first monday of next month'),
        'FIRSTFRIDAYMONTH' => array('label' => 'First Friday Of The Month', 'timestring' => 'first friday of next month'),
        'LASTDAYMONTH' => array('label' => 'Last Day Of The Month', 'timestring' => 'last day of next month'),
        'LASTMONDAYMONTH' => array('label' => 'Last Monday Of The Month', 'timestring' => 'last monday of next month'),
        'LASTFRIDAYMONTH' => array('label' => 'Last Friday Of The Month', 'timestring' => 'last friday of next month'),
    );
    
    protected $loanStatuses = array(
        'PENDINGAPPROVAL' => 'Pending Approval',
        'APPROVED' => 'Approved',
        'CANCELLED' => 'Cancelled'
    );
    public $belongsTo = array(
        'Customer' => array(
            'Classname' => 'Customer',
            'foreignKey' => 'customer_id',
        ),
        'Branch' => array(
            'Classname' => 'Branch',
            'foreignKey' => 'branch_id',
        )
    );
    public $hasMany = array(
        'Loantransaction' => array(
            'className' => 'Loantransaction',
            'foreignKey' => 'loan_id',
        )
    );

    /**
     * Validation rules
     *
     * @var array
     * 
     * 
     */
    public $validate = array(
        'customer_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'amount' => array(
            'notempty' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter loan amount',
                'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'interestdate' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'paymentperiod' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'interest' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'maturitydate' => array(
            'date' => array(
                'rule' => array('date'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'disbursementdate' => array(
            'date' => array(
                'rule' => array('date'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'branch_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'user' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    public function getInterestDates() {
        $return = array();
        if ($this->interestDates) {
            foreach ($this->interestDates AS $key => $value) {
                if (is_array($value) && isset($value['label'])) {
                    $return[$key] = $value['label'];
                } else if (is_string($value)) {
                    $return[$key] = $value;
                } else {
                    $return[$key] = $key;
                }
            }
        }
        return $return;
    }

    public function getInterestTypes() {
        return $this->interestTypes;
    }
    
    public function saveTransactions($data) {
        debug($data);
        $this->Loantransaction->saveAll($data);
    }

    public function calculateLoan($data) {


        $return = array();



        if (isset($data['Loanaccount']) && !empty($data['Loanaccount'])) {

            $interestAmount = ($data['Loanaccount']['amount'] * $data['Loanaccount']['interest']) / 100;

            $monthlyInterest = floor($interestAmount / $data['Loanaccount']['paymentperiod']);
            $monthlyPayment = floor($data['Loanaccount']['amount'] / $data['Loanaccount']['paymentperiod']);

            // If any amount left we add to the final payment
            $remainingInterest = $interestAmount - ($monthlyInterest * $data['Loanaccount']['paymentperiod']);
            $remainingPayment = $data['Loanaccount']['amount'] - ($monthlyPayment * $data['Loanaccount']['paymentperiod']);

            $period = $this->getDates($data['Loanaccount']['disbursementdate'], $data['Loanaccount']['paymentperiod'], $data['Loanaccount']['interestdate']);

            
            foreach ($period AS $key => $date) {
                
                $transactionData = array();
                $transactionData['loan_id'] = $data['Loanaccount']['id'];
                $transactionData['amountdue'] = $monthlyPayment;
                $transactionData['interestdue'] = $monthlyInterest;
                $transactionData['duedate'] = $date;
           
                $return[$key] = $this->calculateTransaction($transactionData);
               
            }
            
       
            $return[$key]['amountdue'] += $remainingPayment;
            $return[$key]['interestdue'] += $remainingInterest;
            
            $return[$key] = $this->calculateTransaction($return[$key]);
        }
        
        return $return;
    }
    
    public function calculateTransaction($transactionData) {
        
        $transactionData['totaldue'] = $transactionData['amountdue'] + $transactionData['interestdue'];
                
        
        return $transactionData;
        
    }

    protected function timeDescription($description) {

        if (isset($this->interestDates[$description]) && is_array($this->interestDates[$description])) {

            $line = $this->interestDates[$description];

            if (isset($line['timestring']) && !empty($line['timestring'])) {
                return strtolower($line['timestring']);
            }
        }

        return null;
    }

    public function getDates($start, $numberOfMonths, $description) {
        $return = array();
        $description = $this->timeDescription($description);

        if ($description) {


            $period = $this->period($start, $numberOfMonths, $description);

            foreach ($period AS $dt) {
                $return[] = $dt->format("Y-m-d");
            }
        }
        return $return;
    }

    /**
     *
     * @param type $startDate 
     * @param type $endDate
     * @param type $day which day of the month
     */
    public function period($start, $numberOfMonths, $description = 'first day of next month') {

        $begin = new DateTime($start);
        $end = new DateTime($start);

        $numberOfMonths += 1;

        $end->add(new DateInterval('P' . $numberOfMonths . 'M'));

        $interval = DateInterval::createFromDateString($description);


        $period = new DatePeriod($begin, $interval, $end, DatePeriod::EXCLUDE_START_DATE);

        return $period;


        foreach ($period as $dt) {
            echo $dt->format("l Y-m-d H:i:s\n") . "<br />";
        }
    }
    
    
    public function approve($id) {
        if($this->Loanaccount->find('count', array('Loanaccount' => 'PENDINGAPPROVAL'))) {
            return false;
        }
        
        $data = $this->Loanaccount->read(null, $id);
        
        if(!$data) {
            return false;
        }
        
        
        
        $return = $this->Loanaccount->calculateLoan($data);

        $this->Loanaccount->Loantransaction->deleteAll(array('Loantransaction.loan_id' => $id));
        $this->Loanaccount->saveTransactions($return);
        return true;
    }

}
