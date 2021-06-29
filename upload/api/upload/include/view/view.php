<?php

class View {

    function __construct() {

    }

    function responseJSON($status, $head){
        $response = array(
            'status' => $status,
            'head' => $head
        );

        echo(json_encode($response));
    }

}