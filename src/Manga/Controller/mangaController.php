<?php

namespace Manga\Controller;

use Common\Core\HTTPRequest;
use Manga\Service\MangaService;

class MangaController
{

    private HTTPRequest $request;
    private MangaService $mangaService;

    public function __construct()
    {
        $this->request = new HTTPRequest();
        $this->mangaService = new MangaService();
    }
    public function index(HTTPRequest $request)
    {
    }
}
