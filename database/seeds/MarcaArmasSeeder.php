<?php

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaArmasSeeder extends Seeder
{

    public function run()
    {/*
        $marcas_armas = ['Não Aparente', 'CBC', 'Taurus',
            'Rossi', 'Smith and Wesson', 'INA', 'Beretta',
            'Castelo', 'Glock', 'Boito', 'B.H.',
            ' Winchester', 'BRNO', 'Doberman', 'Tanfoglio', 'Bersa'];

        foreach ($marcas_armas as $marca) {
            Marca::create([
                'nome' => $marca,
                'categoria' => 'armas',
            ]);
        }*/
    
    DB::table('marcas')->insert([
        'nome' => 'Rossi',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'CBC',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Glock',
        'categoria' => 'Armas',
        'pais_origem' => 'Áustria',
        'fabricacao'=> 'austriaca'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Taurus',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Winchester',
        'categoria' => 'Armas',
        'pais_origem' => 'EUA',
        'fabricacao'=> 'estadunidense'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Bersa',
        'categoria' => 'Armas',
        'pais_origem' => 'Argentina',
        'fabricacao'=> 'argentina'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Beretta',
        'categoria' => 'Armas',
        'pais_origem' => 'Itália',
        'fabricacao'=> 'italiana'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Castelo',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'Brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Boito',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'Brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'INA',
        'categoria' => 'Armas',
        'pais_origem' => 'Brasil',
        'fabricacao'=> 'Brasileira'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Tanfoglio',
        'categoria' => 'Armas',
        'pais_origem' => 'Itália',
        'fabricacao'=> 'italiana'
    ]);
    DB::table('marcas')->insert([
        'nome' => 'Smith and Wesson',
        'categoria' => 'Armas',
        'pais_origem' => 'EUA',
        'fabricacao'=> 'estadunidense'
    ]);
        }
}

