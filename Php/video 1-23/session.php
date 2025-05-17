<nav>

<ul>
    <li><a href="?menu=isi">isi</li>
    <li><a href="?menu=hapus">hapus</li>
    <li><a href="?menu=destroy">destroy</li>
</ul>




</nav>

<?php

session_start();

if ($_GET['menu']) {
    $menu=$_GET['menu'];

    echo $menu;

    switch ($menu) {
        case 'isi':
            isisession();
            break;

        case 'hapus':
             unset($_SESSION['user']);
             break;

             case 'destroy':
                session_destroy();
                break;
        
        default:
            # code...
            break;
    }
}

echo '<br>';

var_dump($_SESSION);

function isisession(){
    $_SESSION['user']= 'joni';

    $_SESSION['nama']= 'Joni rambo';
    
    $_SESSION['alamat']= 'Sidoarjo';
    

}

?> 
