<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Http\Response;
use Phalcon\Http\Response\Cookies;

class LoginController extends Controller
{


   

    public function indexAction()
    {

        if(isset($_COOKIE['email']))
        {
            // echo  $this->session->get('email');
            // echo "cookie is set";
            // // $this->response->redirect('/dashboard');
            // die();
        }
       
    }

    public function authAction()
    {

   
       if($this->request->getPost('remember_me') == 'on') 
       {

        $this->cookies->set('email',  $this->request->getPost("email"), time()+600);
        $this->cookies->set('password',  $this->request->getPost("password"), time()+600);
        $this->cookies->set('remember_me',  $this->request->getPost("remember_me"), time()+600);

        //    $this->cookies->set(
        //        'remember_me',
        //        json_encode(
        //            [
        //         '$password' => $this->request->getPost("password"),
        //         '$email' => $this->request->getPost("email")
        //             ],
        //        time() + 3600
        //        )
        //         );
           echo "clicked";
           $response = new Response();
            $cookies  = new Cookies();

            $response->setCookies($cookies);

        //    echo "<pre>";
        //    print_r($_COOKIE);
        //    echo $this->cookies->get('password');
        //    echo "</pre>";
        //    die();
       }
       else{
           echo "not clicked";
       }

     //   die();
        if ($this->request->isPost()) {
            $password = $this->request->getPost("password");
            $email = $this->request->getPost("email");
        }

        $success = Users::findFirst(array(
            'email = :email: and password = :password:', 'bind' => array(
                'email' => $this->request->getPost("email"),
                'password' => $this->request->getPost("password")
            )
        ));

        if ($success) {
            echo "successful login";
            $this->session->set('email', $email);
            $this->session->set('password', $password);
           $this->response->redirect('/dashboard');
        } else {
            $response = new Response();

            $response->setStatusCode(403, 'Authentication Failed');
            $response->send();
            $messages = $success->getMessages();
            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
    }
}
