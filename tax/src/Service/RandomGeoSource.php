<?php

namespace App\Service;

class RandomGeoSource
{
    const DEV_SOURCES = [
        'Russia' => [
            'Moscow' => [
                'Vnukovo' => '12.76',
                'Tula'    => '15.06'
            ],
            'Rostov' => [
                'Shahti' => '23.06'
            ]
        ]
    ];

    const SOURCES = [
        'Russia' => [
            'Moscow'     => [
                'Domodedovo',
                'Vnukovo',
                'Tula',
                'Pulkovo',
                'Odintcovo',
                'Sheremetyevo',
            ],
            'Rostov'     => [
                'Shahti',
                'Novocherkassk',
                'Doneck',
                'Bataysk',
                'Aksay',
                'Azov',
            ],
            'Petersburg' => [
                'Lenino',
                'Filkino',
                'Rumyancevo',
                'Pskovie',
            ],
            'Kazan'      => [
                'Tatar',
                'Kentar',
                'Zelenodolsk',
                'Udino',
            ],
            'Krasnodar'  => [
                'Sochi',
                'Kushevksya',
                'Starominskaya',
                'Kanelovskaya',
                'Anapa',
                'Gelendzhik',
            ]
        ],
        'USA'    => [
            'Alabama'    => [
                'Madison',
                'Decatur',
                'Hoover',
                'Dothan',
                'Gadsden',
                'Mobile',
            ],
            'Kansas'     => [
                'Wichita',
                'Emporia',
                'Abilene',
                'Newton',
                'Olathe',
            ],
            'Missouri'   => [
                'St. Joseph',
                'St. Charles',
                'St. Peters',
                'Columbia',
                'Springfield',
            ],
            'Texas'      => [
                'Dallas',
                'Austin',
                'Fort Worth',
                'Arlington',
                'Plano',
                'Laredo',
            ],
            'Washington' => [
                'Seattle',
                'Tacoma',
                'Bellevue',
                'Everett',
                'Spokane Valley',
            ],
        ]
    ];

    /**
     * @return array
     */
    public function generateRandomData()
    {
        $data = self::SOURCES;

        foreach ($data as $countryName => $states) {
            foreach ($states as $stateName => $counties) {
                $data[$countryName][$stateName]['counties'] = [];
                foreach ($counties as $position => $countyName) {
                    for ($count = 0; $count < rand(100, 100000); $count++) {
                        $data[$countryName][$stateName]['counties'][$countyName]['rates'][] = rand(10000, 1000000000) / 100;
                    }
                    $data[$countryName][$stateName]['counties'][$countyName]['tax_rate'] = rand(500, 4000) / 100;
                    unset($data[$countryName][$stateName][$position]);
                }
            }
        }

        return $data;
    }
}