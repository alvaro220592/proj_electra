<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => 'VALERIO DE AGUIAR',
            'lastname' => 'ZORZATO',
            'cpf' => '96050176876',
            'service' => 'Prestação de serviços',
            'due_day' => 10,
            'amount' => 200,
        
        
            /* 'name' => 'JOAO DA COSTA',
            'lastname' => 'ANTUNES',
            'cpf' => '88398158808',
            'service' => 'Prestação de serviços',
            'due_day' => 10,
            'amount' => 200, */
        
    
            /* 'name' => 'VALERIO ALVES',
            'lastname' => 'BARROS',
            'cpf' => '71943984190',
            'service' => 'Prestação de serviços',
            'due_day' => 10,
            'amount' => 200, */
            
        ];
    }
}
