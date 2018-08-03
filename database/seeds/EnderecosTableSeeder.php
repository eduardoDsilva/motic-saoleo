<?php

use Illuminate\Database\Seeder;

class EnderecosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('enderecos')->delete();
        
        \DB::table('enderecos')->insert(array (
            0 => 
            array (
                'id' => 5,
                'rua' => 'Avenida das Américas',
                'numero' => '837',
                'complemento' => NULL,
                'bairro' => 'Cohab Duque',
                'cep' => '93037460',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 36,
                'created_at' => '2018-07-31 15:30:28',
                'updated_at' => '2018-07-31 15:30:28',
            ),
            1 => 
            array (
                'id' => 6,
                'rua' => 'Aristides Barônio',
                'numero' => '131',
                'complemento' => NULL,
                'bairro' => 'Campina/Vila Antônio Leite',
                'cep' => '93130440',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 37,
                'created_at' => '2018-07-31 15:36:30',
                'updated_at' => '2018-07-31 15:36:30',
            ),
            2 => 
            array (
                'id' => 7,
                'rua' => 'Rua: Firmino José Tomazzi',
                'numero' => '210',
                'complemento' => NULL,
                'bairro' => 'Vicentina',
                'cep' => '93025234',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 38,
                'created_at' => '2018-07-31 15:42:59',
                'updated_at' => '2018-07-31 15:42:59',
            ),
            3 => 
            array (
                'id' => 8,
                'rua' => 'Rua: Leopoldo Wasun',
                'numero' => '730',
                'complemento' => NULL,
                'bairro' => 'Santos Dumont/Vila Brás',
                'cep' => '93115380',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 39,
                'created_at' => '2018-07-31 15:48:10',
                'updated_at' => '2018-07-31 15:48:10',
            ),
            4 => 
            array (
                'id' => 9,
                'rua' => 'Rua: Erni Steigleder',
                'numero' => '100',
                'complemento' => NULL,
                'bairro' => 'Santos Dumont',
                'cep' => '93000000',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 40,
                'created_at' => '2018-07-31 15:53:03',
                'updated_at' => '2018-07-31 15:53:03',
            ),
            5 => 
            array (
                'id' => 10,
                'rua' => 'Rua: Presidente Lucena',
                'numero' => '2772',
                'complemento' => NULL,
                'bairro' => 'Scharlau/Parque Itapema',
                'cep' => '93130440',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 41,
                'created_at' => '2018-07-31 15:57:41',
                'updated_at' => '2018-07-31 15:57:41',
            ),
            6 => 
            array (
                'id' => 11,
                'rua' => 'Antônio José Pereira Filho',
                'numero' => '132',
                'complemento' => NULL,
                'bairro' => 'Parque Itapema',
                'cep' => '93125400',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 42,
                'created_at' => '2018-08-01 09:35:13',
                'updated_at' => '2018-08-01 09:35:13',
            ),
            7 => 
            array (
                'id' => 12,
                'rua' => 'Edmundo Felix Nunes',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Campina',
                'cep' => '93130480',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 43,
                'created_at' => '2018-08-01 09:49:41',
                'updated_at' => '2018-08-01 09:49:41',
            ),
            8 => 
            array (
                'id' => 13,
                'rua' => 'Rua Jacarandá',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Arroio da Manteiga',
                'cep' => '93140300',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 44,
                'created_at' => '2018-08-01 10:00:35',
                'updated_at' => '2018-08-01 10:00:35',
            ),
            9 => 
            array (
                'id' => 14,
                'rua' => 'Camboja',
                'numero' => '15',
                'complemento' => NULL,
                'bairro' => 'Feitoria Cohab',
                'cep' => '93056150',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 45,
                'created_at' => '2018-08-01 10:12:41',
                'updated_at' => '2018-08-01 10:12:41',
            ),
            10 => 
            array (
                'id' => 15,
                'rua' => 'Soldado Henrique Lopes',
                'numero' => '196',
                'complemento' => NULL,
                'bairro' => 'Vicentina',
                'cep' => '93025200',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 46,
                'created_at' => '2018-08-01 10:20:31',
                'updated_at' => '2018-08-01 10:20:31',
            ),
            11 => 
            array (
                'id' => 16,
                'rua' => 'Estrada da Pedreira',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Morro de Paula',
                'cep' => '93032530',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 47,
                'created_at' => '2018-08-01 10:37:24',
                'updated_at' => '2018-08-01 10:37:24',
            ),
            12 => 
            array (
                'id' => 17,
                'rua' => 'Avenida Dom João Becker',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Centro',
                'cep' => '93010010',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 48,
                'created_at' => '2018-08-01 10:43:13',
                'updated_at' => '2018-08-01 10:43:13',
            ),
            13 => 
            array (
                'id' => 18,
                'rua' => 'Avenida Cel Atalíbio Taurino de Rezende',
                'numero' => '1127',
                'complemento' => NULL,
                'bairro' => 'Rio dos Sinos',
                'cep' => '93110360',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 49,
                'created_at' => '2018-08-01 10:48:34',
                'updated_at' => '2018-08-01 10:48:34',
            ),
            14 => 
            array (
                'id' => 19,
                'rua' => 'Leopoldo Vieira',
                'numero' => '195',
                'complemento' => NULL,
                'bairro' => 'São Miguel',
                'cep' => '93025540',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 50,
                'created_at' => '2018-08-01 11:06:35',
                'updated_at' => '2018-08-01 11:06:35',
            ),
            15 => 
            array (
                'id' => 20,
                'rua' => 'Pastor Augusto Heine',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Feitoria',
                'cep' => '93052270',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 51,
                'created_at' => '2018-08-01 11:11:27',
                'updated_at' => '2018-08-01 11:11:27',
            ),
            16 => 
            array (
                'id' => 21,
                'rua' => 'Maçonaria',
                'numero' => '511',
                'complemento' => NULL,
                'bairro' => 'Bom Fim',
                'cep' => '93115090',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 52,
                'created_at' => '2018-08-01 11:16:11',
                'updated_at' => '2018-08-01 11:16:11',
            ),
            17 => 
            array (
                'id' => 22,
                'rua' => 'Montevidéu',
                'numero' => '57',
                'complemento' => NULL,
                'bairro' => 'Vila Tereza',
                'cep' => '93037010',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 53,
                'created_at' => '2018-08-01 11:20:47',
                'updated_at' => '2018-08-01 11:20:47',
            ),
            18 => 
            array (
                'id' => 23,
                'rua' => 'Jacarandá',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Arroio da Manteiga',
                'cep' => '93135000',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 54,
                'created_at' => '2018-08-01 11:27:39',
                'updated_at' => '2018-08-01 11:27:39',
            ),
            19 => 
            array (
                'id' => 24,
                'rua' => 'Afrânio Peixoto',
                'numero' => '100',
                'complemento' => NULL,
                'bairro' => 'São João Batista',
                'cep' => '93052120',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 55,
                'created_at' => '2018-08-01 11:36:07',
                'updated_at' => '2018-08-01 11:36:07',
            ),
            20 => 
            array (
                'id' => 25,
                'rua' => 'Avenida São Borja',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Fazenda São Borja',
                'cep' => '93032000',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 56,
                'created_at' => '2018-08-01 11:40:57',
                'updated_at' => '2018-08-01 11:40:57',
            ),
            21 => 
            array (
                'id' => 26,
                'rua' => 'João Alberto',
                'numero' => '135',
                'complemento' => NULL,
                'bairro' => 'Vicentina',
                'cep' => '93025490',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 57,
                'created_at' => '2018-08-01 11:45:13',
                'updated_at' => '2018-08-01 11:45:13',
            ),
            22 => 
            array (
                'id' => 27,
                'rua' => 'Bom Jesus',
                'numero' => '60',
                'complemento' => NULL,
                'bairro' => 'Santo André',
                'cep' => '93044040',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 58,
                'created_at' => '2018-08-01 11:48:41',
                'updated_at' => '2018-08-01 11:48:41',
            ),
            23 => 
            array (
                'id' => 28,
                'rua' => 'Avenida João Correa',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Fião',
                'cep' => '93020690',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 59,
                'created_at' => '2018-08-01 11:52:34',
                'updated_at' => '2018-08-01 11:52:34',
            ),
            24 => 
            array (
                'id' => 30,
                'rua' => 'Waldomiro Vieira',
                'numero' => '50',
                'complemento' => NULL,
                'bairro' => 'Pinheiro',
                'cep' => '93042080',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 61,
                'created_at' => '2018-08-03 08:50:47',
                'updated_at' => '2018-08-03 08:50:47',
            ),
            25 => 
            array (
                'id' => 31,
                'rua' => 'Leopoldo Kamal',
                'numero' => '33',
                'complemento' => NULL,
                'bairro' => 'Vila Santo Augusto',
                'cep' => '93140060',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 62,
                'created_at' => '2018-08-03 08:55:44',
                'updated_at' => '2018-08-03 08:55:44',
            ),
            26 => 
            array (
                'id' => 32,
                'rua' => 'Antônio Becker',
                'numero' => '181',
                'complemento' => NULL,
                'bairro' => 'Jardim América',
                'cep' => '93032530',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 63,
                'created_at' => '2018-08-03 09:01:44',
                'updated_at' => '2018-08-03 09:01:44',
            ),
            27 => 
            array (
                'id' => 33,
                'rua' => 'Manoel Moura',
                'numero' => '1501',
                'complemento' => NULL,
                'bairro' => 'Vila Born',
                'cep' => '93048190',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 64,
                'created_at' => '2018-08-03 09:06:34',
                'updated_at' => '2018-08-03 09:06:34',
            ),
            28 => 
            array (
                'id' => 34,
                'rua' => 'Frei Agostinho da Piedade',
                'numero' => '55',
                'complemento' => NULL,
                'bairro' => 'Feitoria',
                'cep' => '93054040',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 65,
                'created_at' => '2018-08-03 09:12:51',
                'updated_at' => '2018-08-03 09:12:51',
            ),
            29 => 
            array (
                'id' => 35,
                'rua' => 'Veranópolis',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Parque Mauá',
                'cep' => '93135580',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 66,
                'created_at' => '2018-08-03 09:18:29',
                'updated_at' => '2018-08-03 09:18:29',
            ),
            30 => 
            array (
                'id' => 36,
                'rua' => 'Castro Alves',
                'numero' => '175',
                'complemento' => NULL,
                'bairro' => 'Jardim América',
                'cep' => '93032130',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 67,
                'created_at' => '2018-08-03 09:25:30',
                'updated_at' => '2018-08-03 09:25:30',
            ),
            31 => 
            array (
                'id' => 37,
                'rua' => 'Rua Um',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Loteamento Padre Orestes Santos Dumont',
                'cep' => '93115380',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 68,
                'created_at' => '2018-08-03 09:37:42',
                'updated_at' => '2018-08-03 09:37:42',
            ),
            32 => 
            array (
                'id' => 38,
                'rua' => 'Avenida Alta Tensão',
                'numero' => '195',
                'complemento' => NULL,
                'bairro' => 'Campestre',
                'cep' => '93042280',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 69,
                'created_at' => '2018-08-03 10:28:13',
                'updated_at' => '2018-08-03 10:28:13',
            ),
            33 => 
            array (
                'id' => 39,
                'rua' => 'Rua Um',
                'numero' => '0',
                'complemento' => NULL,
                'bairro' => 'Vila Brás',
                'cep' => '93115380',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 70,
                'created_at' => '2018-08-03 10:33:22',
                'updated_at' => '2018-08-03 10:33:22',
            ),
            34 => 
            array (
                'id' => 40,
                'rua' => 'Rio Parnaíba',
                'numero' => '50',
                'complemento' => NULL,
                'bairro' => 'Jardim Luciana',
                'cep' => '93145130',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 71,
                'created_at' => '2018-08-03 10:37:33',
                'updated_at' => '2018-08-03 10:37:33',
            ),
            35 => 
            array (
                'id' => 41,
                'rua' => 'Avenida Integração',
                'numero' => '955',
                'complemento' => NULL,
                'bairro' => 'Feitoria',
                'cep' => '93052270',
                'cidade' => 'São Leopoldo',
                'estado' => 'Rio Grande do Sul',
                'pais' => 'Brasil',
                'user_id' => 72,
                'created_at' => '2018-08-03 10:58:37',
                'updated_at' => '2018-08-03 10:58:37',
            ),
        ));
        
        
    }
}