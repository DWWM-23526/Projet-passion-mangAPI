<?php

namespace Api\Users\Repository;

use Api\Manga\Model\Manga;
use Api\Users\Model\Role;
use Api\Users\Model\Users;
use Core\Base\BaseApiRepository;

class UsersRepository extends BaseApiRepository
{
    protected $table = 'users';
    protected $modelClass = Users::class;
    protected $primaryKey = 'Id_user';

    
    public function getUserByEmail(string $email)
    {
        return $this->getBy($email, 'email');
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

    public function getAllUserRelatedRole(int $userId)
    {
        return $this->hasMany(Role::class, 'role', 'id_role', $userId);
    }
}
