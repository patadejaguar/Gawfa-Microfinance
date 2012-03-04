<?php
Class ReportsController extends AppController {
    public $uses = false;


	public function index() {

	}
    
    public function test() {
        
        $this->loadModel('Loanaccount');
        
        $data = $this->Loanaccount->find('all');
        
        $this->set('reportData', $data);
        
    }
}
?>
