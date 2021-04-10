<?php


print_r($_POST);



file_put_contents( 'options.json', json_encode( $_POST ) );

die();