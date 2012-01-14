<?php
Class UploadComponent extends Component {

    protected $allowedFileTypes = array();
    /**
     * Max File Size In Bytes [2mb].
     * @var int 
     */
    protected $maxFileSize = 16777216; 


    function initialize($controller) {
        
    }
    
    function setAllowedFileTypes($allowedFileTypes) {
        if(is_array($allowedFileTypes)) {
            $this->allowedFileTypes = $allowedFileTypes;
        }
    }
    
    /**
     * Set mas file size in bytes
     * @param type $size 
     */
    function setMaxFileSize($size) {
        $this->maxFileSize = $size;
    }
    

    function uploadFile($fileAttributes) {
 
        
        $filename = $fileAttributes['target_filename'];
        $ext = substr($filename, strpos($filename, '.'), strlen($filename) - 1);
        $base_dir = $fileAttributes['filepath'];
        $tmp_filename = $fileAttributes['tmp_filename'];
        $target_filename = $fileAttributes['target_filename'];
        $final_target_path = $fileAttributes['filepath'] . "/";

        if ($this->allowedFileTypes && !in_array($ext, $allowed_filetypes)) {
            return 'The file you attempted to upload is not allowed.';
        }

        if (filesize($fileAttributes['tmp_filename']) > $max_filesize) {
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
        
        $final_target_path = $final_target_path . $target_filename;

        if (move_uploaded_file($tmp_filename, $final_target_path)) {
            return 'true';
        } else {
            return "There was an error during your file upload";
        }
    }

}

?>