<?php

if(!empty($_GET['fichier']))
{
    
    $chemin = 'http://legiafrica.dev'.$_GET['fichier'];
    if(file_exists($chemin))
    {
        
        
    }
    //header('Location: http://legiafrica.dev' . $chemin);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($chemin));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($chemin));
    readfile($chemin);
    exit;
    
    //readfile($chemin);
 
}


?>