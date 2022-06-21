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
            "Antiguano",
            "Argentino",
            "Bahamense",
            "Barbadiano", 
            "barbadense",
            "Belizenho",
            "Boliviano",
            "Brasileiro",
            "Chileno",
            "Colombiano",
            "Costarriquenho",
            "Cubano",
            "Dominicano",
            "Equatoriano",
            "Salvadorenho",
            "Granadino",
            "Guatemalteco",
            "Guianês",
            "Guianense",
            "Haitiano",
            "Hondurenho",
            "Jamaicano",
            "Mexicano",
            "Nicaraguense",
            "Panamenho",
            "Paraguaio",
            "Peruano",
            "Portorriquenho",
            "Dominicana",
            "Cristovense",
            "Vicentino",
            "Surinamês",
            "Trindadense",
            "Uruguaio",
            "Venezuelano",
            "Alemão",
            "Austríaco",
            "Belga",
            "Croata",
            "Dinamarquês",
            "Eslovaco",
            "Esloveno",
            "Espanhol",
            "Francês",
            "Grego",
            "Húngaro",
            "Irlandês",
            "Italiano",
            "Noruego",
            "Holandês",
            "Polonês",
            "Português",
            "Britânico",
            "Inglês",
            "Galês",
            "Escocês",
            "Romeno",
            "Russo",
            "Sérvio",
            "Sueco",
            "Suíço",
            "Turco",
            "Ucraniano",
            "Americano",
            "Canadense",
            "Angolano",
            "Moçambicano",
            "Africano",
            "Zimbabuense",
            "Argélia",
            "Comorense",
            "Egípcio",
            "Líbio",
            "Marroquino",
            "Ganés",
            "Queniano",
            "Ruandês",
            "Ugandense",
            "Bechuano",
            "Marfinense",
            "Camaronense",
            "Nigeriano",
            "Somali",
            "Australiano",
            "Neozelandês",
            "Afegão",
            "Saudita",
            "Armeno",
            "Bangladesh",
            "Chinês",
            "Coreano",
            "Indiano",
            "Indonésio",
            "Iraquiano",
            "Iraniano",
            "Israelita",
            "Japonês",
            "Malaio",
            "Nepalês",
            "Omanense",
            "Paquistanês",
            "Palestino",
            "Qatarense",
            "Sírio",
            "Cingalês",
            "Tailandês",
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
