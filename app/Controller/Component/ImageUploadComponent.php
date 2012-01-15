<?php
Class ImageUploadComponent extends Component {
    public $components = array('Upload');
    
    public function initialize($controller) {
        parent::initialize($controller);
    }
    
    function uploadImage($params) {
        return $this->Upload->uploadFile($params);
    }
    
    function resize() {
        
    }
    
}
?>