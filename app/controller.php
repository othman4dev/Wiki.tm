<?php 

    namespace app;

    class Controller {
            public function view($view, $data = []) {
                require_once '../view/' . $view . '.php';
            }
    }