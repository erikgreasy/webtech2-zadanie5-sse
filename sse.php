<?php

date_default_timezone_set("America/New_York");
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");

$lastId = $_SERVER["HTTP_LAST_EVENT_ID"];

if( isset($lastId) && !empty($lastId) ) {
    $lastId++;
} else {
    $lastId = 0;
}

// if( file_exists( 'options.json' ) ) {
//     extract( json_decode( file_get_contents( 'options.json' ), true ) );
//     $sin = filter_var( $sin, FILTER_VALIDATE_BOOLEAN );
//     $cos = filter_var( $cos, FILTER_VALIDATE_BOOLEAN );
//     $cossin = filter_var( $cossin, FILTER_VALIDATE_BOOLEAN );

//     $a = intVal($a);
// } else {
//     die();
// }

// var_dump( $cos );

// die();



$result = [];


while (true) {

    if( file_exists( 'options.json' ) ) {
        extract( json_decode( file_get_contents( 'options.json' ), true ) );
        $a = intVal($a);
        $sin = filter_var( $sin, FILTER_VALIDATE_BOOLEAN );
        $cos = filter_var( $cos, FILTER_VALIDATE_BOOLEAN );
        $cossin = filter_var( $cossin, FILTER_VALIDATE_BOOLEAN );
    } else {
        die();
    }

    $result['x'] = $lastId;
    $result['a'] = $a;


    if( isset($sin) && $sin === true ) {
        $result['sin'] = getSin( $lastId, $a );
    } else {
        unset( $result['sin'] );
    }

    if( isset($cos) && $cos === true ) {
        $result['cos'] = getCos( $lastId, $a );
    } else {
        unset( $result['cos'] );
    }

    if( isset($cossin) && $cossin === true ) {
        $result['cossin'] = getCosSin( $lastId, $a );
    } else {
        unset( $result['cossin'] );
    }

    echo 'data: ' . json_encode( $result ) . PHP_EOL . PHP_EOL;

    $lastId++;
    ob_flush();
    flush();

    
    // Break the loop if the client aborted the connection (closed the page)
    if ( connection_aborted() ) break;

    sleep(2);
}


function getSin($x, $a = 1) {
    return sin( $a * $x ) * sin( $a * $x );
}

function getCos( $x, $a = 1 ) {
    return cos( $a * $x ) * cos( $a * $x );
}

function getCosSin( $x, $a = 1 ) {
    return sin( $a * $x ) * cos( $a * $x );
}