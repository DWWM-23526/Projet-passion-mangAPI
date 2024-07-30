<?php

use Core\RequestMethod;


// GET emailConfirm by email
$app->addRoute(RequestMethod::GET, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "getEmailByEmail");

// POST send email
$app->addRoute(RequestMethod::POST, "/api/emailConfirm", "Api\EmailConfirm\Controller\EmailConfirmController", "sendEmailToConfirmAccount");

//DELETE remove an emailConfirm
$app->addRoute(RequestMethod::DELETE, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "deleteEmailConfirm");
