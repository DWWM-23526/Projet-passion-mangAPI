<?php

namespace Api\Users\Repository;

use Api\Manga\Model\Manga;
use Api\Users\Model\Users;
use Core\ORM\BaseRepository;


class UsersRepository extends BaseRepository
{
    protected $table = 'users';
    protected $modelClass = Users::class;
    protected $primaryKey = 'Id_user';

    public function getAllUsers()
    {
        return $this->getAll($this->table);
    }

    public function getUserById(int $userId)
    {
        return $this->getBy($userId, 'Id_user');
    }

    public function getAllUserRelatedManga(int $userId)
    {
        return $this->belongToMany(Manga::class, 'mangas', 'favoris', 'Id_manga', $userId);
    }

    public function addMangaToUser(int $userId, int $mangaId)
    {
        return $this->attach('favoris', $this->primaryKey, 'Id_manga', $userId, $mangaId);
    }

    public function removeMangaFromUser(int $userId, int $mangaId)
    {
        return $this->detach('favoris', $this->primaryKey, 'Id_manga', $userId, $mangaId);
    }

    public function createUser($data)
    {
        return $this->create($data);
    }

    public function updateUser($data, $id)
    {
        return $this->update($data, $id);
    }

    public function deleteUser($id)
    {
        return $this->delete($id, 'Id_user');
    }
}
