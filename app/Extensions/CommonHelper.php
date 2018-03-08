<?php

if (!function_exists('matchImg')) {
    function matchImg($type) {
        $file_types = [
            'zip'=>array('zip','xz','wim','tpz','tbz','swm','rar','lzma86','lha','gz','bzip2'),
            'word'=>array('doc','docx'),
            'img'=>array('bmp','tif','tiff','cpx','dwg','eps','gif','ico','jiff','jpeg','jpg','pdf','pm5'),
            'txt'=>array('txt'),
            'excel'=>array('xlsm','xltx','xltm','xlsb','xlam','xlsx'),
        ];
        $other_file = 'folder';
        foreach($file_types as $k=>$v)
        {
            if(in_array($type,$v)){
                $other_file = $k;
                break;
            }
        }
        return $other_file;
    }

}

?>