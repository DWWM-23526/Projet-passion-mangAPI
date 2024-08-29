<?php

namespace Auth\Repositories;

use Api\Models\Manga;
use Auth\Models\Users;
use Core\repositories\_BaseApiRepository;



class UsersRepository extends _BaseApiRepository
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

}
