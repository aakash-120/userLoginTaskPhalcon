<?php

use Phalcon\Mvc\Model;

class Users extends Model                  //class name is same as db name
{
    public $id;     //columns name of database
    public $email;
    public $password;
}