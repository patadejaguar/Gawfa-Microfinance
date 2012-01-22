<?php

App::uses('AppController', 'Controller');

/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

    public $components = array('ImageUpload');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        // debug($this->request->data['Customer']);
        if (isset($this->request->data['Customer'])) {
            if (isset($this->request->data['Customer']['search'])) {
                $this->paginate = array(
                    'conditions' => array(
                        'OR' => array(
                            'firstname LIKE' => '%' . $this->request->data['Customer']['search'] . '%',
                            'lastname LIKE' => '%' . $this->request->data['Customer']['search'] . '%',
                        )
                    )
                );
            }
        }
        $this->Customer->recursive = 0;
        $this->set('customers', $this->paginate());
        $this->request->data['Customer']['search'] = '';
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $this->set('customer', $this->Customer->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Customer->create();
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        }

        $this->set('sexes', $this->Customer->sex);
    }

    /**
     * add_photo method
     *
     * @return void
     */
    public function add_photo() {
        
        $sub = 'upload/img/';
        $path = WWW_ROOT . $sub;
        
        $customer_id = $this->request->params['named']['customer_id'];

        if ($this->request->is('post')) {
            $this->Customer->create();

            $files = array();


            if (isset($this->request->data['Customer'])) {
                foreach ($this->request->data['Customer'] AS $tKey => $tValue) {
                    if (is_array($tValue) && isset($tValue['error']) && $tValue['error'] == 0) {
                        $files[$tKey] = $tValue;
                    }
                }
            }
            


            if ($files) {
                foreach ($files AS $name => $value) {
                    


                    $params = array();
                    $params['filepath'] = $path;
                    $params['file'] = $value;
                    $params['target_filename'] = $name . '_' . $customer_id;
                    // debug($params);
                    $this->ImageUpload->uploadImage($params)->resize(200, 250);
                }
            }
        }
        
        $photo = $path.'200_250/photo_'.$customer_id.'.jpg';
        $signature = $path.'200_250/signature_'.$customer_id.'.jpg';
        
        $images = array();
        
        if(file_exists($photo)) {
            $images['photo'] = str_replace(WWW_ROOT, '/', $photo);
        }
        
        if(file_exists($signature)) {
            $images['signature'] = str_replace(WWW_ROOT, '/', $signature);;
        }
        
        
        $this->set('images', $images);



    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Customer->read(null, $id);
        }
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
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        if ($this->Customer->delete()) {
            $this->Session->setFlash(__('Customer deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Customer was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
