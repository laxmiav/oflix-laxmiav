<?php 

namespace App\Service;
// générateur aléatoire de texte selon la chanson favorite de la promo

class Coconutipsum {

    private $lyrics = "The coconut nut is a giant nut
    If you eat too much, you'll get very fat
    Now, the coconut nut is a big, big nut
    But this delicious nut is not a nut
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    There are so many uses of the coconut tree
    You can build a big house for the family
    All you need is to find a coconut man
    If he cuts the tree, he gets the fruit free
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    The coconut bark for the kitchen floor
    If you save some of it, you can build a door
    Now, the coconut trunk, do not throw this junk
    If you save some of it, you'll have the second floor
    The coconut wood is very good
    It can stand 20 years if you pray it would
    Now, the coconut root, to tell you the truth
    You can throw it or use it as firewood
    The coconut leaves, good shade it gives
    For the roof, for the walls up against the eaves
    Now, the coconut fruit, say my relatives
    Make good cannonballs up against the eaves
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    The coconut nut is a giant nut
    If you eat too much, you'll get very fat
    Now, the coconut nut is a big, big nut
    But this delicious nut is not a nut
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    It's the coco fruit (it's the coco fruit)
    Of the coco tree (of the coco tree)
    From the coco palm family
    Ole!";

    private $mainSubject;

    public function __construct($mainSubject)
    {
        $this->mainSubject = $mainSubject;
    }

    /**
     * retrieves $count sentences and return them as array
     *
     * @param integer $count
     * @return string[]
     */
    public function getSentences($count = 3): array
    {
        $songAsArray = explode(PHP_EOL, $this->lyrics);

        $result = [];
        for ($i =  0; $i < $count; $i++) 
        {
            $randomIndex = array_rand($songAsArray);
            $result[] = str_replace('coco', $this->mainSubject, $songAsArray[$randomIndex]);
        }
        
        return $result;
    }

}
