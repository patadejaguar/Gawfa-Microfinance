<?php

Class AppController Extends Controller {

    public $uses = array('User', 'Group', 'Acl');
    public $components = array(
        'Acl',
        'Session',
        'RequestHandler',
        'Acl',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authError' => 'You are not authorized to view that page',
        )
    );

    public function beforeFilter() {
        
        /**
        $this->Auth->allow('add');

        $this->Auth->authorize = array(
            AuthComponent::ALL => array('actionPath' => 'controllers'),
            'Actions'
        );

        **/
        parent::beforeFilter();

        Configure::write('currency', 'Dalasis');
        Configure::write('currencySymbol', 'D');
    }

    public function beforeRender() {
        $this->set("userlogin", $this->Auth->user());
    }

}

?>
