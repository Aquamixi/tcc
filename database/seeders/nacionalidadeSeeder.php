<?php

namespace Database\Seeders;

use App\Models\nacionalidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class nacionalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nacionalidades = 
        [
            "Antiguana",
            "Argentina",
            "Bahamense",
            "Barbadiana", 
            "barbadense",
            "Belizenha",
            "Boliviana",
            "Brasileira",
            "Chilena",
            "Colombiana",
            "Costarriquenha",
            "Cubana",
            "Dominicana",
            "Equatoriana",
            "Salvadorenha",
            "Granadina",
            "Guatemalteca",
            "Guianês",
            "Guianense",
            "Haitiana",
            "Hondurenha",
            "Jamaicana",
            "Mexicana",
            "Nicaraguense",
            "Panamenha",
            "Paraguaia",
            "Peruana",
            "Portorriquenha",
            "Dominicana",
            "Cristovense",
            "Vicentina",
            "Surinamês",
            "Trindadense",
            "Uruguaia",
            "Venezuelana",
            "Alemã",
            "Austríaca",
            "Belga",
            "Croata",
            "Dinamarquêsa",
            "Eslovaca",
            "Eslovena",
            "Espanhola",
            "Francêsa",
            "Grega",
            "Húngara",
            "Irlandêsa",
            "Italiana",
            "Norueguesa",
            "Holandêsa",
            "Polonêsa",
            "Portuguêsa",
            "Britânica",
            "Inglêsa",
            "Galêsa",
            "Escocêsa",
            "Romena",
            "Russa",
            "Sérvia",
            "Sueca",
            "Suíça",
            "Turca",
            "Ucraniana",
            "Americana",
            "Canadense",
            "Angolana",
            "Moçambicana",
            "Africana",
            "Zimbabuense",
            "Argélia",
            "Comorense",
            "Egípcia",
            "Líbiana",
            "Marroquina",
            "Ganésa",
            "Queniana",
            "Ruandêsa",
            "Ugandana",
            "Bechuana",
            "Marfinense",
            "Camaronense",
            "Nigeriana",
            "Somali",
            "Australiana",
            "Neozelandêsa",
            "Afegã",
            "Saudita",
            "Armena",
            "Bangladesh",
            "Chinêsa",
            "Coreana",
            "Indiana",
            "Indonésia",
            "Iraquiana",
            "Iraniana",
            "Israelita",
            "Japonêsa",
            "Malaio",
            "Nepalêsa",
            "Omanense",
            "Paquistanêsa",
            "Palestina",
            "Qatarense",
            "Síria",
            "Cingalêsa",
            "Tailandêsa",
            "Timorense",
            "Árabe",
            "Vietnamita",
            "Iemenita",
        ];

        foreach($nacionalidades as $nacionalidade){
            nacionalidade::create([
                'nacionalidade' => $nacionalidade
            ]);
        }
    }
}
