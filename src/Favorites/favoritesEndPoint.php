<?php

//  GET all favorites

use Common\Core\RequestMethod;

$app->addRoute(RequestMethod::GET, '/api/favorites', 'Favorites\Controller\FavoritesController', 'getAllFavorites');

// GET favorites by user ID
$app->addRoute(RequestMethod::GET, '/api/favorites/{userId}', 'Favorites\Controller\FavoritesController', 'getUserFavorites');

// POST add a new favorite
$app->addRoute(RequestMethod::POST, '/api/favorites', 'Favorites\Controller\FavoritesController', 'addFavorite');

// PUT update a favorite
$app->addRoute(RequestMethod::PUT, '/api/favorites/{UserId}/{mangaId}', 'Favorites\Controller\FavoritesController', 'updateFavorite');

// DELETE remove a favorite
$app->addRoute(RequestMethod::DELETE, '/api/favorites/{UserId}/{mangaId}', 'Favorites\Controller\FavoritesController', 'removeFavorite');
