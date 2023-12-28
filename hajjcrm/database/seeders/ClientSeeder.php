<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::updateOrCreate([
            'groupName'=>'rais&Co',
            'groupNo'=>'rais/sample/01',
            'givenName'=>'rais',
            'surName'=>'Mallik',
            'passportNo'=>'668525122544',
            'passportType'=>'International',
            'issuingCountry'=>'Bangladesh',
            'ppIssueDate'=>'11/01/2022',
            'ppExpiryDate'=>'11/01/2022',
            'dateofBirth'=>'11/01/2022',
            'Mobile'=>'+88015555888',
            'emergencyMobile'=>'+88052200012',
            'email'=>'dummy@dummy.com',
            'nosofPerson'=>'3',
            'tourMonth'=>'March',
            'status'=>'New',
            'queryDetails'=>'Query Detail Sample',
            'note'=>'Sample Note',
            'source_id'=>1,
            'crm_id'=>1,
            'user_id'=>1,
        ]);
        Client::updateOrCreate([
            'groupName'=>'Rasel&Co',
            'groupNo'=>'rasel/sample/01',
            'givenName'=>'Rasel',
            'surName'=>'Mallik',
            'passportNo'=>'668525122544',
            'passportType'=>'International',
            'issuingCountry'=>'Bangladesh',
            'ppIssueDate'=>'11/01/2022',
            'ppExpiryDate'=>'11/01/2022',
            'dateofBirth'=>'11/01/2022',
            'Mobile'=>'+88015555888',
            'emergencyMobile'=>'+88052200012',
            'email'=>'dummy@dummy.com',
            'nosofPerson'=>'3',
            'tourMonth'=>'March',
            'status'=>'New',
            'queryDetails'=>'Query Detail Sample',
            'note'=>'Sample Note',
            'source_id'=>1,
            'crm_id'=>1,
            'user_id'=>1,
        ]);
        Client::updateOrCreate([
            'groupName'=>'joy&Co',
            'groupNo'=>'joy/sample/01',
            'givenName'=>'joy',
            'surName'=>'Mallik',
            'passportNo'=>'668525122544',
            'passportType'=>'International',
            'issuingCountry'=>'Bangladesh',
            'ppIssueDate'=>'11/01/2022',
            'ppExpiryDate'=>'11/01/2022',
            'dateofBirth'=>'11/01/2022',
            'Mobile'=>'+88015555888',
            'emergencyMobile'=>'+88052200012',
            'email'=>'dummy@dummy.com',
            'nosofPerson'=>'3',
            'tourMonth'=>'March',
            'status'=>'New',
            'queryDetails'=>'Query Detail Sample',
            'note'=>'Sample Note',
            'source_id'=>1,
            'crm_id'=>1,
            'user_id'=>1,
        ]);
    }
}
