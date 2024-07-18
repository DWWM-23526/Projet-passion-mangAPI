<?php

namespace Manga\Controller;

use Common\Core\App;
use Common\Core\HTTPRequest;

use Common\core\HTTPResponse;
use Manga\Service\MangaService;

class MangaController
{

    private MangaService $mangaService;

    public function __construct()
    {
        $this->mangaService = App::injectService()->getContainer(MangaService::class);
    }

    public function index(HTTPRequest $request, HTTPResponse $response)
    {
        
        $response->sendJsonResponse(['response' => 'hello from manga', 'status' => 200]);
    }
}
