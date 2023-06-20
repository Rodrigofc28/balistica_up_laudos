<?php

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaMunicaoSeeder extends Seeder
{

    public function run()
    {/*
        $marcas_municoes = ['CBC', 'Aguila', 'S&B', 'SP',
            'Federal', 'Winchester', 'PMC', 'FMFLB',
            'MRP', 'W-W', 'Lapua', 'R-P', 'AP', 'WIN', 'BLAZER', 'V'];

        foreach ($marcas_municoes as $marca) {
            Marca::create([
                'nome' => $marca,
                'categoria' => 'munições',
            ]);
        }*/
       
        DB::table('marcas')->insert([
            'nome' => 'CBC',
            'categoria' => 'muniçoes',
            'pais_origem' => 'Brasil',
            'fabricacao'=> 'Brasileira'
        ]);
        DB::table('marcas')->insert([
            'nome' => 'Aguila',
            'categoria' => 'muniçoes',
            'pais_origem' => 'México',
            'fabricacao'=> 'mexicana'
        ]);
        DB::table('marcas')->insert([
            'nome' => 'Winchester',
            'categoria' => 'muniçoes',
            'pais_origem' => 'EUA',
            'fabricacao'=> 'estadunidense'
        ]);
        DB::table('marcas')->insert([
            'nome' => 'Federal',
            'categoria' => 'muniçoes',
            'pais_origem' => 'EUA',
            'fabricacao'=> 'estadunidense'
        ]);
       
    }
}
