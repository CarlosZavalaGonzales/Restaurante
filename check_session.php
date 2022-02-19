<?php
session_cache_limiter('nocache,private');
session_name('covigym');
session_start();
if(isset($_SESSION['codUsu']))
{
    echo 'authentified';
}


