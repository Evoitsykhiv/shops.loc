<?php


namespace controllers;

use core\Controller;

class MainController extends Controller
{

    function indexAction(){
        $this->view->render("Главная страница");
    }
}