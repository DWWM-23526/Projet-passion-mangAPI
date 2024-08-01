<?php

use Core\RequestMethod;

// GET emailConfirm by email
$app->addRoute(RequestMethod::GET, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "getEmailByEmail");

// POST send email
$app->addRoute(RequestMethod::POST, "/api/sendEmailConfirm", "Api\EmailConfirm\Controller\EmailConfirmController", "sendEmailToConfirmAccount");

// GET token and decode
$app->addRoute(RequestMethod::GET, "/api/decodeTokenToConfirmAccount/{token}", "Api\EmailConfirm\Controller\EmailConfirmController", "decodeTokenAndCreateAccount");

//DELETE remove an emailConfirm
$app->addRoute(RequestMethod::DELETE, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "deleteEmailConfirm");
