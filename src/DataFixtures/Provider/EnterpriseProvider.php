<?php 

namespace App\DataFixtures\Provider;

class EnterpriseProvider extends \Faker\Provider\Base {

    /**
     * returns a random tv show title
     *
     * @return string
     */
    public function enterpriseTitle() :string {
        $enterpriseName = [
            'ZENDATA',
            'Stormshield',
            'Nomios',
            'Advens',
            'Sysdream',
            'Akerva',
            'Novatim',
            'NovaSys',
            'Tehtris',
            'Ozon',
        ];

        // renvoie un nom d'entreprise au hasard dans le tableau ci dessus grace à mt_rand()
        return $enterpriseName[mt_rand(0, count($enterpriseName) - 1)];
    }
    
}
