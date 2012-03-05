<?php

App::uses('AppController', 'Controller');

/**
 * Loanaccounts Controller
 *
 * @property Loanaccount $Loanaccount
 */
class LoanaccountsController extends AppController {

    public $helpers = array('Time', 'Number');

    /**
     * 
     * The loan account report 
     * 
     */
    public function report() {
        $this->helpers[] = 'Csv';

        $conditions = array();
        if(!isset($this->request->data)) {
            $this->request->data = array();
        }
        
        
        
        // If search criteria submitted, set condition
        if($this->request->data) {
            if($this->request->data['Loanaccount']['date_from']) {
                $conditions['disbursementdate >'] = $this->request->data['Loanaccount']['date_from'];
            }
            if($this->request->data['Loanaccount']['date_to']) {
                $conditions['disbursementdate <'] = $this->request->data['Loanaccount']['date_to'];
            }
            
            
        }
        
        $this->paginate = array(
            'conditions' => $conditions
        );
        
        $loanaccounts = $this->paginate();

        $this->set('loanaccounts', $loanaccounts);
        $this->set('all_loanaccount', $this->Loanaccount->find('all', array('conditions' => $conditions)));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($id = null) {
        $this->Loanaccount->recursive = 0;
        if ($id) {

            $this->paginate = array(
                'conditions' => array(
                    'Loanaccount.customer_id' => $id
                )
            );
        }
        $this->set('id', $id);
        $this->set('loanaccounts', $this->paginate());
    }

    public function test() {

        /**
          foreach ($this->Loanaccount->getInterestDates() AS $key => $value) {
          debug($value);
          $period = $this->Loanaccount->getDates('01-03-2012', 4, $key);
          debug($period);
          }* */
        $id = 2;
        $data = $this->Loanaccount->read(null, $id);

        $return = $this->Loanaccount->calculateLoan($data);

        $this->Loanaccount->Loantransaction->deleteAll(array('Loantransaction.loan_id' => $id));
        $this->Loanaccount->saveTransactions($return);



        // debug($return);
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Loanaccount->id = $id;
        if (!$this->Loanaccount->exists()) {
            throw new NotFoundException(__('Invalid loanaccount'));
        }
        $this->set('loanaccount', $this->Loanaccount->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_loan_account($id) {
        $this->request->data['Loanaccount']['type'] = 'ADDLOANACCOUNT';

        $this->add($id);
    }

    public function add($id) {

        $this->request->data['Loanaccount']['type'] = 'ADDLOANACCOUNT';
        $this->request->data['Loanaccount']['status'] = 'PENDINGAPPROVAL';

        $this->loadModel('Customer'); //if it's not already loaded
        $this->Customer->recursive = -1;
        $customerData = $this->Customer->read(null, $id);

        $this->request->data['Loanaccount']['customer_id'] = $customerData['Customer']['id'];

        if ($this->request->is('post')) {
            $this->Loanaccount->create();
            if ($this->Loanaccount->save($this->request->data)) {
                $this->Session->setFlash(__('The loan account has been saved'));
                $this->redirect(array('controller' => 'customers', 'action' => 'view/' . $this->request->data['Loanaccount']['customer_id'] . '/'));
                // $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The loan account could not be saved. Please, try again.'));
            }

            $this->request->data['Loanaccounts']['customer_id'] = $id;

            //$customers = $this->customer->find('list'); //or whatever conditions you want
        }


        $this->loadModel('LoanType');
        $this->request->data['Loanaccount']['customer_id'] = $id;

        $this->set('types', $this->LoanType->find('list'));
        $this->set('interestdates', $this->Loanaccount->getInterestDates());
        $this->set('customer', $customerData);
    }

    public function approve($id) {
        if ($this->Loanaccount->approve($id)) {
            $this->Session->setFlash(__('The loan has been approved'));
            $this->redirect(array('controller' => 'loanaccounts', 'action' => 'view/' . $id . '/'));
        } else {
            $this->Session->setFlash(__('The loan has not been approved'));
            $this->redirect(array('controller' => 'loanaccounts', 'action' => 'view/' . $id . '/'));
        }
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->request->data['Loanaccount']['type'] = 'ADDLOANACCOUNT';

        $this->loadModel('Customer'); //if it's not already loaded
        $this->Customer->recursive = -1;
        $customerData = $this->Customer->read(null, $id);

        $this->request->data['Loanaccount']['customer_id'] = $customerData['Customer']['id'];
        $this->Loanaccount->id = $id;
        if (!$this->Loanaccount->exists()) {
            throw new NotFoundException(__('Invalid loanaccount'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Loanaccount->save($this->request->data)) {
                $this->Session->setFlash(__('The loan account has been saved'));
                // $this->redirect(array('action' => 'index'));
                $this->redirect(array('controller' => 'customers', 'action' => 'view/' . $this->request->data['Loanaccount']['customer_id'] . '/'));
            } else {
                $this->Session->setFlash(__('The loana ccount could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Loanaccount->read(null, $id);
        }


        $this->loadModel('LoanType');
        $this->request->data['Loanaccount']['customer_id'] = $id;

        $this->set('types', $this->LoanType->find('list'));
        $this->set('interestdates', $this->Loanaccount->getInterestDates());
        $this->set('customer', $customerData);
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Loanaccount->id = $id;
        if (!$this->Loanaccount->exists()) {
            throw new NotFoundException(__('Invalid loanaccount'));
        }
        if ($this->Loanaccount->delete()) {
            $this->Session->setFlash(__('Loanaccount deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Loanaccount was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
