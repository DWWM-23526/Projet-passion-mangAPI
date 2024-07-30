<?php

use Core\RequestMethod;

// GET all EmailConfirm
// $app->addRoute(RequestMethod::GET, "/api/emailConfirm", "Api\EmailConfirm\Controller\EmailConfirmController", "getAllEmailConfirms");

// GET emailConfirm by email
$app->addRoute(RequestMethod::GET, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "getEmailByEmail");

// POST add a new emailConfirm into BDD
// $app->addRoute(RequestMethod::POST, "/api/emailConfirm", "Api\EmailConfirm\Controller\EmailConfirmController", "addEmailConfirm");

// POST send email
$app->addRoute(RequestMethod::POST, "/api/emailConfirms", "Api\EmailConfirm\Controller\EmailConfirmController", "sendEmailToConfirmAccount");

//DELETE remove an emailConfirm
$app->addRoute(RequestMethod::DELETE, "/api/emailConfirm/{email}", "Api\EmailConfirm\Controller\EmailConfirmController", "deleteEmailConfirm");
