<?php

use Core\RequestMethod;

// GET all EmailConfirm
$app->addRoute(RequestMethod::GET, "/api/emailConfirm", "EmailConfirm\Controller\EmailConfirmController", "getAllEmailConfirms");

// GET emailConfirm by email
$app->addRoute(RequestMethod::GET, "/api/emailConfirm/{email}", "EmailConfirm\Controller\EmailConfirmController", "getEmailByEmail");

// POST add a new emailConfirm
$app->addRoute(RequestMethod::POST, "/api/emailConfirm", "EmailConfirm\Controller\EmailConfirmController", "addEmailConfirm");

//DELETE remove an emailConfirm
$app->addRoute(RequestMethod::DELETE, "/api/emailConfirm/{email}", "EmailConfirm\Controller\EmailConfirmController", "deleteEmailConfirm");
