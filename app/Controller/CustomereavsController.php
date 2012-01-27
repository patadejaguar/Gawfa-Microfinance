<?php
App::uses('AppController', 'Controller');
/**
 * Customereavs Controller
 *
 * @property Customereav $Customereav
 */
class CustomereavsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Customereav->recursive = 0;
		$this->set('customereavs', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Customereav->id = $id;
		if (!$this->Customereav->exists()) {
			throw new NotFoundException(__('Invalid customereav'));
		}
		$this->set('customereav', $this->Customereav->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Customereav->create();
			if ($this->Customereav->save($this->request->data)) {
				$this->Session->setFlash(__('The customereav has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customereav could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Customereav->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Customereav->id = $id;
		if (!$this->Customereav->exists()) {
			throw new NotFoundException(__('Invalid customereav'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Customereav->save($this->request->data)) {
				$this->Session->setFlash(__('The customereav has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customereav could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Customereav->read(null, $id);
		}
		$customers = $this->Customereav->Customer->find('list');
		$this->set(compact('customers'));
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
		$this->Customereav->id = $id;
		if (!$this->Customereav->exists()) {
			throw new NotFoundException(__('Invalid customereav'));
		}
		if ($this->Customereav->delete()) {
			$this->Session->setFlash(__('Customereav deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Customereav was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
