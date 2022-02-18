<?php

namespace App\Model;

class ShowModel {
    private static $shows = [

        [
            'type' => 'Film',
            'title' => 'A Bug\'s Life',
            'release_date' => 1998,
            'duration' => 93,
            'summary' => 'Tilt, fourmi quelque peu tête en l\'air, détruit par inadvertance la récolte de la saison.',
            'synopsis' => 'Tilt, fourmi quelque peu tête en l\'air, détruit par inadvertance la récolte de la saison. La fourmilière est dans tous ses états. En effet cette bévue va rendre fou de rage le Borgne, méchant insecte qui chaque été fait main basse sur une partie de la récolte avec sa bande de sauterelles racketteuses. Tilt décide de quitter l\'île pour recruter des mercenaires capables de chasser le Borgne.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNThmZGY4NzgtMTM4OC00NzNkLWEwNmEtMjdhMGY5YTc1NDE4XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',
            'rating' => 3.8
        ],
        
        [
            'type' => 'Série',
            'title' => 'Game of Thrones',
            'release_date' => 2011,
            'duration' => 52,
            'summary' => 'Neuf familles nobles se battent pour le contrôle des terres de Westeros, tandis qu\'un ancien ennemi revient...',
            'synopsis' => 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de Fer, le symbole du pouvoir absolu.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_SX300.jpg',
            'rating' => 4.7
        ],
        
        [
            'type' => 'Film',
            'title' => 'Aline',
            'release_date' => 2020,
            'duration' => 126,
            'summary' => 'Québec, fin des années 60, Sylvette et Anglomard accueillent leur 14ème enfant : Aline. On lui découvre un don, elle a une voix en or.',
            'synopsis' => 'Québec, fin des années 60, Sylvette et Anglomard accueillent leur 14ème enfant : Aline. Dans la famille Dieu, la musique est reine et quand Aline grandit on lui découvre un don, elle a une voix en or. Lorsqu’il entend cette voix, le producteur de musique Guy-Claude n’a plus qu’une idée en tête… faire d’Aline la plus grande chanteuse au monde. Epaulée par sa famille et guidée par l’expérience puis l’amour naissant de Guy-Claude, ils vont ensemble écrire les pages d’un destin hors du commun.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNjUxYTQ3YzItNjU5Ny00ZGM0LWJkMGUtN2FkMWRiNjFlY2ExXkEyXkFqcGdeQXVyMzcwMzExMA@@._V1_SX300.jpg',
            'rating' => 4.0
        ],
        
        [
            'type' => 'Série',
            'title' => 'Stranger Things',
            'release_date' => 2016,
            'duration' => 50,
            'summary' => '1983, à Hawkins dans l\'Indiana. Après la disparition d\'un garçon de 12 ans dans des circonstances mystérieuses, la petite ville du Midwest est témoin d\'étranges phénomènes.',
            'synopsis' => 'A Hawkins, en 1983 dans l\'Indiana. Lorsque Will Byers disparaît de son domicile, ses amis se lancent dans une recherche semée d’embûches pour le retrouver. Dans leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite. Les garçons se lient d\'amitié avec la demoiselle tatouée du chiffre "11" sur son poignet et au crâne rasé et découvrent petit à petit les détails sur son inquiétante situation. Elle est peut-être la clé de tous les mystères qui se cachent dans cette petite ville en apparence tranquille…',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BN2ZmYjg1YmItNWQ4OC00YWM0LWE0ZDktYThjOTZiZjhhN2Q2XkEyXkFqcGdeQXVyNjgxNTQ3Mjk@._V1_SX300.jpg',
            'rating' => 4.2
        ],
    
    ];


    /**
     * get informations for the given $showId
     *
     * @param integer $showId id of the show
     * @return array|null returns null if the id the not found
     */
    public static function getShow(int $showId)
    {
        // on vérifie si l'identifiant existe dans le tableau
        if ( ! array_key_exists($showId, static::$shows))
        {
            // TODO fix cette erreur 
            // return new \Exception('movie not found');
            return null;
        }

        // ici la clef existe 
        return static::$shows[$showId];
    }

    /**
     * sends all available shows
     *
     * @return array
     */
    public static function getShowList() :array
    {
        return static::$shows;
    }

    public function getLove()
    {
        return '💖';
    }


}
