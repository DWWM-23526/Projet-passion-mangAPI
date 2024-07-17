<?php 
namespace Manga\Controller;

use Common\Core\HTTPRequest;
use Common\core\HTTPResponse;

class MangaController{
    public function index(HTTPRequest $request, HTTPResponse $response) {
        $response->sendJsonResponse(['response' =>'hello from manga', 'status' => 200]);
    }
}