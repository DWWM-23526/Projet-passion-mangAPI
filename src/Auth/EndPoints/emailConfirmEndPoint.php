<?php
namespace Auth\EndPoints;

use Api\EndPoints\_BaseApiEndpoint;

class EmailConfirmEndPoint extends _BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/emailConfirm';
  }

  protected function getController(): string
  {
    return 'Auth\Controllers\EmailConfirmController';
  }

  protected function registerRoutes()
  {
    parent::registerRoutes();

    
    $this->addPost('/sendEmailConfirm', 'sendEmailToConfirmAccount');
    $this->addGet('/decodeTokenToConfirmAccount/{token}', 'decodeTokenAndCreateAccount');
    $this->addDelete('/{email}', 'deleteEmailConfirm');
  }
}