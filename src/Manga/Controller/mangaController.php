<?php

namespace Manga\Controller;

use Common\Core\HTTPRequest;
use Manga\Service\MangaService;
use Common\core\HTTPResponse;

class MangaController
{

    private MangaService $mangaService;

    public function __construct()
    {
        $this->mangaService = new MangaService();
    }
    public function index(HTTPRequest $request, HTTPResponse $response) 
    { $response->sendJsonResponse(['response' =>'hello from manga', 'status' => 200]);
    }
}
