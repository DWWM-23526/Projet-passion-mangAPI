<?php
namespace Api\EmailConfirm;

use Core\Base\BaseApiEndpoint;

class EmailConfirmEndPoint extends BaseApiEndpoint
{
  protected function getBasePath(): string
  {
    return '/api/emailConfirm';
  }

  protected function getController(): string
  {
    return 'Api\EmailConfirm\Controller\EmailConfirmController';
  }

  protected function registerRoutes()
  {
    parent::registerRoutes();

    
    $this->addPost('/sendEmailConfirm', 'sendEmailToConfirmAccount');
    $this->addGet('/decodeTokenToConfirmAccount/{token}', 'decodeTokenAndCreateAccount');
    $this->addDelete('/{email}', 'deleteEmailConfirm');
  }
}