<?php

namespace Tags\Repository;

use Common\Core\App;
use Common\Core\Database;
use Tags\Model\Tags;

class TagsRepository
{
    private $db;

    public function __construct()
    {
        $this->db = App::inject()->getContainer(Database::class);
    }

    public function getAllTags()
    {
        $results = $this->db->query("SELECT * FROM tags")->fetchAllOrFail();
        return array_map(fn ($data) => new Tags($data), $results);
    }

    public function getTagById(int $id)
    {
        $result = $this->db->query("SELECT * FROM tags WHERE Id_tag = :id", ['id' => $id])->fetchOrFail();
        return $result ? new Tags($result) : null;
    }

    public function createTag(Tags $tag)
    {
        $sql = "INSERT INTO tags (
        Id_tag, tag_name, is_deleted
        ) VALUES (
        :Id_tag, :tag_name, :is_deleted
        )";

        $values = $tag->toArray();

        try {
            return $this->db->query($sql, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error on Tag creation" . $e->getMessage());
        }
    }

    public function updateTag(Tags $tag)
    {
        $sql = "UPDATE tags
                SET tag_name = :tag_name,
                    is_deleted = :is_deleted
                WHERE Id_tag = :Id_tag";
        $values = $tag->toArray();

        try {
            return $this->db->query($sql, $values);
        } catch (\PDOException $e) {
            throw new \Exception("Error on Tag update" . $e->getMessage());
        }
    }

    public function deleteTag(int $id)
    {
        $sql = "DELETE FROM tags WHERE Id_tag = :id";
        try {
            $this->db->query($sql, ['id' => $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Error on Tag delete" . $e->getMessage());
        }
    }
}
