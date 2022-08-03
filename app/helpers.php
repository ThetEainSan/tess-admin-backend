<?php

    // delete image
    function DeleteImage($folder_path,$file_name)
    {
        if(file_exists(public_path().'/'.$folder_path.'/'.$file_name))
        {
            unlink(public_path().'/'.$folder_path.'/'.$file_name);
        }
    }

?>
