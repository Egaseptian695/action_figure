<?php
class Controller {
    // Method untuk memanggil file View
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

    // Method untuk memanggil file Model
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}