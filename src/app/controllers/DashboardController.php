<?php

use Phalcon\Mvc\Controller;


class DashboardController extends Controller
{
    public function indexAction()
    {

        $this->view->time = $this->time;



        // echo "inside dashboard controller action index";
        // echo "<pre>ravinder cookie";
        // print_r($_COOKIE);
        // echo $this->cookies->get('email');
        // echo "</pre>";
        // die();
      
    }

    public function logoutAction()
    {
        // echo  $this->session->get('email');
        // echo "<br>";
        // echo  $this->session->get('password');

        

        $this->session->remove('email');
        unset($this->session->email);
        $this->session->remove('password');
        unset($this->session->password);
        $this->response->redirect('/login');
    }
}
