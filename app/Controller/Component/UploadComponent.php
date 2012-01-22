<?php

Class UploadComponent extends Component {

    protected $allowedFileTypes = array();
    protected $path = null;
    protected $filename = null;
    protected $fullFilename = null;

    /**
     * Max File Size In Bytes [2mb].
     * @var int 
     */
    protected $maxFileSize = 16777216;

    function initialize($controller) {
        
    }

    function setAllowedFileTypes($allowedFileTypes) {
        if (is_array($allowedFileTypes)) {
            $this->allowedFileTypes = $allowedFileTypes;
        }
    }

    /**
     * Set mas file size in bytes
     * @param type $size 
     */
    public function setMaxFileSize($size) {
        $this->maxFileSize = $size;
    }

    public function setPath($path) {
        $this->path = $this->directory($path);
    }

    public function getPath() {
        return $this->path;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function getFilename() {
        return $this->filename;
    }
    
    public function setFullFilename($fullFilename) {
        $this->fullFilename = $this->directory($fullFilename);
    }
    
    public function getFullFilename() {
        return $this->fullFilename;
    }

    function uploadFile($fileAttributes) {


        $ext = $fileAttributes['ext'];
        $base_dir = $fileAttributes['filepath'];
        $tmp_filename = $fileAttributes['tmp_filename'];
        $target_filename = $fileAttributes['target_filename'];
        $this->path = $final_target_path = $this->directory($fileAttributes['filepath'] . "/");

        

        if ($this->allowedFileTypes && !in_array($ext, $this->allowedFileTypes)) {
            return 'The file you attempted to upload is not allowed.';
        }

        if (filesize($fileAttributes['tmp_filename']) > $this->maxFileSize) {
            return 'The file you attempted to upload is too large.';
        }

        if (isset($fileAttributes['directory'])) {
            $build_directory = $fileAttributes['directory'];
            $build_directory = $base_dir . $build_directory;
            $final_target_path = $build_directory . "/";
            if (!file_exists($build_directory)) {
                if (!mkdir($build_directory, 0777)) {
                    return 'There was a problem with the upload destination.';
                }
            }
        }

        $this->setFilename($target_filename . $ext);
        $this->fullFilename = $final_target_path = $this->directory($final_target_path . $target_filename . $ext);

        if (move_uploaded_file($tmp_filename, $final_target_path)) {
            return 'true';
        } else {
            return "There was an error during your file upload";
        }
    }

    public function createDirectoryIfDoesNotExist($directory) {
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777)) {
                return false;
            }
        }
        return true;
    }
    
    public function directory($directory) {
  
        $directory = str_replace("///", "/", $directory);
        $directory = str_replace("//", "/", $directory);
      
        return $directory;
    }

}

?>