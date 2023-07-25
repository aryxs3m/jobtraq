<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\JobStack;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        JobLevel::create([
            'name' => 'internship',
            'keywords' => ['internship', 'intern', 'trainee', 'gyakornok', 'diákmunka'],
            'order' => 0,
        ]);
        JobLevel::create([
            'name' => 'junior',
            'keywords' => ['junior'],
            'order' => 1,
        ]);
        JobLevel::create([
            'name' => 'medior',
            'keywords' => ['medior', 'mid'],
            'order' => 2,
        ]);
        JobLevel::create([
            'name' => 'senior',
            'keywords' => ['senior'],
            'order' => 3,
        ]);
        JobLevel::create([
            'name' => 'lead',
            'keywords' => ['lead', 'leader'],
            'order' => 4,
        ]);
        JobLevel::create([
            'name' => 'architect',
            'keywords' => ['architect'],
            'order' => 5,
        ]);
        JobLevel::create([
            'name' => 'manager',
            'keywords' => ['manager'],
            'order' => 6,
        ]);


        JobPosition::create([
            'name' => 'frontend',
            'keywords' => ['frontend', 'front-end']
        ]);
        JobPosition::create([
            'name' => 'backend',
            'keywords' => ['backend', 'back-end', 'api'],
        ]);
        JobPosition::create([
            'name' => 'analyst',
            'keywords' => ['analyst'],
        ]);
        JobPosition::create([
            'name' => 'data',
            'keywords' => ['data'],
        ]);
        JobPosition::create([
            'name' => 'ml',
            'keywords' => ['machine'],
        ]);
        JobPosition::create([
            'name' => 'embedded',
            'keywords' => ['embedded'],
        ]);
        JobPosition::create([
            'name' => 'full-stack',
            'keywords' => ['full-stack', 'fullstack'],
        ]);
        JobPosition::create([
            'name' => 'support',
            'keywords' => ['support', 'l1', 'l2', 'l3'],
        ]);
        JobPosition::create([
            'name' => 'devops',
            'keywords' => ['devops', 'dev-ops'],
        ]);
        JobPosition::create([
            'name' => 'developer',
            'keywords' => ['developer', 'engineer', 'fejlesztő'],
        ]);


        JobStack::create([
            'name' => 'golang',
            'keywords' => ['golang','go'],
        ]);
        JobStack::create([
            'name' => 'php',
            'keywords' => ['php','laravel','symfony','cakephp'],
        ]);
        JobStack::create([
            'name' => 'java',
            'keywords' => ['java','spring'],
        ]);
        JobStack::create([
            'name' => 'angular',
            'keywords' => ['angular',],
        ]);
        JobStack::create([
            'name' => 'react',
            'keywords' => ['react',],
        ]);
        JobStack::create([
            'name' => 'node',
            'keywords' => ['node',],
        ]);
        JobStack::create([
            'name' => '.net',
            'keywords' => ['.net',],
        ]);
        JobStack::create([
            'name' => 'asp',
            'keywords' => ['asp',],
        ]);
        JobStack::create([
            'name' => 'c#',
            'keywords' => ['c#',],
        ]);
        JobStack::create([
            'name' => 'c++',
            'keywords' => ['c++',],
        ]);
        JobStack::create([
            'name' => 'python',
            'keywords' => ['python',],
        ]);
        JobStack::create([
            'name' => 'ruby',
            'keywords' => ['ruby',],
        ]);
        JobStack::create([
            'name' => 'rust',
            'keywords' => ['rust',],
        ]);
        JobStack::create([
            'name' => 'solidity',
            'keywords' => ['solidity',],
        ]);
        JobStack::create([
            'name' => 'mysql',
            'keywords' => ['mysql',],
        ]);
        JobStack::create([
            'name' => 'mssql',
            'keywords' => ['mssql',],
        ]);
        JobStack::create([
            'name' => 'postgresql',
            'keywords' => ['postgresql', 'postgres'],
        ]);
    }
}
