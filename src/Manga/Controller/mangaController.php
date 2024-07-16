<?php 
namespace Manga\Controller;

use Common\Core\HTTPRequest;

class MangaController{
    public function index(HTTPRequest $request){
        echo var_dump($request->getHeaders());
    }
}