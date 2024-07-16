<?php

namespace Common\Database\Seed;

use Common\Core\App;
use Common\Core\Database;

class MangasSeed
{
    public function up()
    {
        $db = App::inject()->getContainer(Database::class);
        if ($db === null) {
            throw new \Exception('Database connection could not be established.');
        }

        $db->getConnection();
        try {
            $db->query("INSERT INTO `mangas` (`Id_manga`, `img_manga`, `manga_name`, `edition`, `total_tome_number`, `year_release`, `tome_number`, `texte`, `Id_mangaka`) VALUES
            (1, 'img_manga1.jpg', 'One Piece', 'Shueisha', 100, '1997-07-22', 100, 'Un manga sur les pirates à la recherche du One Piece.', 1),
            (2, 'img_manga2.jpg', 'Naruto', 'Shueisha', 72, '1999-09-21', 72, 'L\'histoire d\'un ninja qui rêve de devenir Hokage.', 2),
            (3, 'img_manga3.jpg', 'Dragon Ball', 'Shueisha', 42, '1984-12-03', 42, 'Les aventures de Son Goku à la recherche des boules de cristal.', 3),
            (4, 'img_manga4.jpg', 'Bleach', 'Shueisha', 74, '2001-08-07', 74, 'L\'histoire d\'un jeune garçon qui devient un shinigami.', 4),
            (5, 'img_manga5.jpg', 'L\'Attaque des Titans', 'Kodansha', 34, '2009-09-09', 34, 'L\'histoire de l\'humanité luttant contre des titans mangeurs d\'hommes.', 5),
            (6, 'img_manga6.jpg', 'Hunter x Hunter', 'Shueisha', 36, '1998-03-03', 36, 'Un jeune garçon à la recherche de son père et des aventures extraordinaires.', 6),
            (7, 'img_manga7.jpg', 'Berserk', 'Hakusensha', 40, '1989-08-25', 40, 'Les aventures sombres de Guts, un mercenaire solitaire.', 7),
            (8, 'img_manga8.jpg', 'Death Note', 'Shueisha', 12, '2003-12-01', 12, 'Un lycéen découvre un carnet aux pouvoirs mortels.', 8),
            (9, 'img_manga9.jpg', 'Slam Dunk', 'Shueisha', 31, '1990-10-01', 31, 'L\'histoire d\'un lycéen et de son équipe de basket.', 9),
            (10, 'img_manga10.jpg', 'Monster', 'Shogakukan', 18, '1994-12-05', 18, 'Un médecin traqué par un ancien patient devenu un tueur en série.', 10),
            (11, 'img_manga11.jpg', 'InuYasha', 'Shogakukan', 56, '1996-11-13', 56, 'Les aventures d\'une fille et d\'un demi-démon dans le Japon féodal.', 11),
            (12, 'img_manga12.jpg', 'Devilman', 'Kodansha', 5, '1972-06-11', 5, 'Un garçon fusionne avec un démon pour sauver l\'humanité.', 12),
            (13, 'img_manga13.jpg', 'The Drifting Classroom', 'Shogakukan', 11, '1972-06-05', 11, 'Une école transportée dans un monde post-apocalyptique.', 13),
            (14, 'img_manga14.jpg', 'Astro Boy', 'Kodansha', 23, '1952-04-03', 23, 'Les aventures d\'un robot enfant dans un futur lointain.', 14),
            (15, 'img_manga15.jpg', 'Cyborg 009', 'Shogakukan', 36, '1964-07-19', 36, 'Neuf personnes transformées en cyborgs luttent pour leur liberté.', 15),
            (16, 'img_manga16.jpg', 'Akira', 'Kodansha', 6, '1982-12-06', 6, 'Une histoire post-apocalyptique dans un Tokyo futuriste.', 16),
            (17, 'img_manga17.jpg', 'Gunnm', 'Shueisha', 9, '1990-11-12', 9, 'Une cyborg amnésique cherche des réponses sur son passé.', 17),
            (18, 'img_manga18.jpg', 'Rurouni Kenshin', 'Shueisha', 28, '1994-04-18', 28, 'Un ancien assassin cherche la rédemption dans le Japon de l\'ère Meiji.', 18),
            (19, 'img_manga19.jpg', 'Ghost in the Shell', 'Kodansha', 3, '1989-07-11', 3, 'Une histoire de cyberpolice dans un monde futuriste.', 19),
            (20, 'img_manga20.jpg', 'Reborn!', 'Shueisha', 42, '2004-05-31', 42, 'Un lycéen ordinaire devient un chef de la mafia.', 20),
            (21, 'img_manga21.jpg', 'My Hero Academia', 'Shueisha', 32, '2014-07-07', 32, 'Un garçon sans pouvoirs dans un monde de super-héros.', 21),
            (22, 'img_manga22.jpg', 'The Seven Deadly Sins', 'Kodansha', 41, '2012-10-10', 41, 'Les aventures d\'un groupe de chevaliers dans un monde fantastique.', 22),
            (23, 'img_manga23.jpg', 'Fairy Tail', 'Kodansha', 63, '2006-08-02', 63, 'Les aventures d\'une guilde de mages.', 23),
            (24, 'img_manga24.jpg', 'A Silent Voice', 'Kodansha', 7, '2013-08-07', 7, 'L\'histoire d\'un garçon cherchant à se racheter après avoir harcelé une camarade sourde.', 24),
            (25, 'img_manga25.jpg', 'The Promised Neverland', 'Shueisha', 20, '2016-08-01', 20, 'Des enfants découvrent la sombre vérité de leur orphelinat.', 25)");
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
    }
}