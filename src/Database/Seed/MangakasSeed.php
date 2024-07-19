<?php

namespace Database\Seed;

use Core\App;
use Core\Database;

class MangakasSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        try {
            $db->query("INSERT INTO `mangakas` (`Id_mangaka`, `img_mangaka`, `first_name`, `last_name`, `birthdate`, `texte`) VALUES
            (1, 'img_mangaka1.jpg', 'Eiichiro', 'Oda', '1975-01-01', 'Auteur de One Piece.'),
            (2, 'img_mangaka2.jpg', 'Masashi', 'Kishimoto', '1974-11-08', 'Auteur de Naruto.'),
            (3, 'img_mangaka3.jpg', 'Akira', 'Toriyama', '1955-04-05', 'Auteur de Dragon Ball.'),
            (4, 'img_mangaka4.jpg', 'Tite', 'Kubo', '1977-06-26', 'Auteur de Bleach.'),
            (5, 'img_mangaka5.jpg', 'Hajime', 'Isayama', '1986-08-29', 'Auteur de L\'Attaque des Titans.'),
            (6, 'img_mangaka6.jpg', 'Yoshihiro', 'Togashi', '1966-04-27', 'Auteur de Hunter x Hunter.'),
            (7, 'img_mangaka7.jpg', 'Kentaro', 'Miura', '1966-07-11', 'Auteur de Berserk.'),
            (8, 'img_mangaka8.jpg', 'Tsugumi', 'Ohba', '1962-08-17', 'Auteur de Death Note.'),
            (9, 'img_mangaka9.jpg', 'Takehiko', 'Inoue', '1967-01-12', 'Auteur de Slam Dunk.'),
            (10, 'img_mangaka10.jpg', 'Naoki', 'Urasawa', '1960-01-02', 'Auteur de Monster.'),
            (11, 'img_mangaka11.jpg', 'Rumiko', 'Takahashi', '1957-10-10', 'Auteur de InuYasha.'),
            (12, 'img_mangaka12.jpg', 'Go', 'Nagai', '1945-09-06', 'Auteur de Devilman.'),
            (13, 'img_mangaka13.jpg', 'Kazuo', 'Umezu', '1936-09-03', 'Auteur de The Drifting Classroom.'),
            (14, 'img_mangaka14.jpg', 'Osamu', 'Tezuka', '1928-11-03', 'Auteur de Astro Boy.'),
            (15, 'img_mangaka15.jpg', 'Shotaro', 'Ishinomori', '1938-01-25', 'Auteur de Cyborg 009.'),
            (16, 'img_mangaka16.jpg', 'Katsuhiro', 'Otomo', '1954-04-14', 'Auteur de Akira.'),
            (17, 'img_mangaka17.jpg', 'Yukito', 'Kishiro', '1967-03-20', 'Auteur de Gunnm.'),
            (18, 'img_mangaka18.jpg', 'Nobuhiro', 'Watsuki', '1970-05-26', 'Auteur de Rurouni Kenshin.'),
            (19, 'img_mangaka19.jpg', 'Masamune', 'Shirow', '1961-11-23', 'Auteur de Ghost in the Shell.'),
            (20, 'img_mangaka20.jpg', 'Akira', 'Amano', '1973-06-22', 'Auteur de Reborn!.'),
            (21, 'img_mangaka21.jpg', 'Kohei', 'Horikoshi', '1986-11-20', 'Auteur de My Hero Academia.'),
            (22, 'img_mangaka22.jpg', 'Nakaba', 'Suzuki', '1977-02-08', 'Auteur de The Seven Deadly Sins.'),
            (23, 'img_mangaka23.jpg', 'Hiro', 'Mashima', '1977-05-03', 'Auteur de Fairy Tail.'),
            (24, 'img_mangaka24.jpg', 'Yoshitoki', 'Oima', '1989-03-15', 'Auteur de A Silent Voice.'),
            (25, 'img_mangaka25.jpg', 'Kaiu', 'Shirai', '1986-10-05', 'Auteur de The Promised Neverland.')");
        } catch (\Throwable $e) {
            throw new \Exception("Error Processing Request :" . $e->getMessage());
        }
        
    }
}