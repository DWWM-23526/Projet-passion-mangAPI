<?php
namespace Api\EmailConfirm;

use Core\Base\BaseApiEndpoint;

// // GET emailConfirm by email
// $app->addRoute(RequestMethod::GET, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "getEmailByEmail");

// // POST send email
// $app->addRoute(RequestMethod::POST, "/api/emailConfirm/sendEmailConfirm", "Api\EmailConfirm\Controller\EmailConfirmController", "sendEmailToConfirmAccount");

// // GET token and decode
// $app->addRoute(RequestMethod::GET, "/api/emailConfirm/{token}", "Api\EmailConfirm\Controller\EmailConfirmController", "decodeTokenAndCreateAccount");

// //DELETE remove an emailConfirm
// $app->addRoute(RequestMethod::DELETE, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "deleteEmailConfirm");

class EmailConfirmEndPoint extends BaseApiEndpoint
{
  public function __construct()
  {
    parent::__construct('/api/emailConfirm', 'Api\EmailConfirm\Controller\EmailConfirmController');
  }

  protected function registerRoutes()
  {
    $this->addPost('/sendEmailConfirm', 'sendEmailToConfirmAccount');
    $this->addGet('/{token}', 'decodeTokenAndCreateAccount');
    $this->addDelete('/{email}', 'deleteEmailConfirm');
  }
}