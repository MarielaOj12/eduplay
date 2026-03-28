<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenidoSeeder extends Seeder
{
    public function run(): void
    {
        $contenidos = [
            [
                'titulo' => 'Introducción a la Literacidad Digital',
                'descripcion' => 'Conceptos esenciales sobre el uso de computadoras, sistemas operativos y gestión básica de archivos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Navegación Segura en Internet',
                'descripcion' => 'Aprende a identificar peligros en la web, proteger datos personales y usar motores de búsqueda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Lógica de Programación Básica',
                'descripcion' => 'Descubre qué es un algoritmo, diagramas de flujo y cómo darle instrucciones a una computadora.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Estructuras de Control y Variables',
                'descripcion' => 'Aplicación de condicionales (if/else) y bucles para resolver problemas computacionales iniciales.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('contenidos')->insert($contenidos);
    }
}
