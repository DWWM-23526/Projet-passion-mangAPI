<?php

namespace Tags\Repository;

use Common\Core\App;
use Common\Core\Database;
use Tags\Model\Tags;

class TagsRepository
{
    private $db;

    public function __construct(){
        $this->db = App::inject()->getContainer(Database::class);
    }

    public function getAll(){
        $results = $this->db->query("SELECT * FROM tags")->fetchAll();
        return array_map(fn ($data) => new Tags($data),$results);
    }

    public function getTagById(int $id){
        $result = $this->db->query("SELECT * FROM tags WHERE Id_tag = :id",['id'=>$id]);
        return $result ? new Tags($result) : null;
    }

    public function createTag(Tags $tag){
        
    }
}