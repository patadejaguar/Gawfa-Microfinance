<?php

/*
 * File: SimpleImage.php
 * Author: Simon Jarvis
 * Copyright: 2006 Simon Jarvis
 * Date: 08/11/06
 * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 *
 */

class SimpleImage {

    var $image;
    var $image_type;

    function load($filename) {

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image, $filename);
        }
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
    }

 

    function getWidth() {

        return imagesx($this->image);
    }

    function getHeight() {

        return imagesy($this->image);
    }

    function resizeToHeight($height) {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

}

Class ImageUploadComponent extends Component {

    public $components = array('Upload');
    protected $filename = null;
    protected $setPath = null;

    public function initialize($controller) {
        parent::initialize($controller);
    }
    
    public function setPath($path) {
        $this->path = $path;
    }

    function uploadImage($params) {
        $params['tmp_filename'] = $params['file']['tmp_name'];
        $params['ext'] = $this->extension($params['file']);
        $this->filename = $this->Upload->uploadFile($params);

        return $this;
    }

    public function extension($params) {
        $sourceFile = $params['tmp_name'];

        list($width, $height, $type, $attr) = getimagesize($sourceFile);

        $filetype = image_type_to_extension($type, true);
        // $filetype includes the dot.
        if ('.jpeg' == $filetype) {
            $filetype = '.jpg';  // use jpg, not the 'jpeg' the function would return
            return $filetype;
        }
    }

    function resize($width, $height) {
        
        $resizeDirectory = $this->Upload->getPath() . $width . '_' . $height . '/';
        
        $this->Upload->createDirectoryIfDoesNotExist($resizeDirectory);
        
        
        $image = new SimpleImage();
        
        $image->load($this->Upload->getFullFilename());
        $image->resize($width, $height);
        $image->save($resizeDirectory . $this->Upload->getFilename());
    }

}

?>