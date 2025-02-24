<?php
$databases = [
    'default' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'pcmsdb',
        'password' => 'p981c!m90s^d43b',
        'database' => 'pcmsdb',
    ],
    'BGFSMS2' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'bgfsms2',
        'password' => 'b91g@f97s26ms2',
        'database' => 'BGFSMS2',
    ],
    'pcms' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'terp',
        'password' => 't90@e71r@p43',
        'database' => 'terp_placem',
    ],
    'cms' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'bcmsdb',
        'password' => 'b83c^3m@s84d9b',
        'database' => 'CMSDB',
    ],
    'sparo2' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'spadb',
        'password' => 's91p18a^75d@2b',
        'database' => 'spadb',
    ],
    'bar' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'spadb',
        'password' => 's91p18a^75d@2b',
        'database' => 'spadb',
    ],
    'chapi' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'cmsdb',
        'password' => 'c92m8@s^d82b',
        'database' => 'cmsdb',
    ],
    'cms2' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'apidb',
        'password' => 'a912p@i^d83b',
        'database' => 'apidb',
    ],
    'BGFSMS3' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'bgfsms3',
        'password' => 'b*6g4f31s0m4s',
        'database' => 'BGFSMS3',
    ],
    'rds' => [
        'hostname' => 'ticketmanager.cbwsoa0mqp56.ap-northeast-2.rds.amazonaws.com',
        'username' => 'cmsdb',
        'password' => 'c92m8@s^d82b',
        'database' => 'cmsdb',
    ],
];

foreach ($databases as $name => $config) {
    $connection = @mysqli_connect(
        $config['hostname'],
        $config['username'],
        $config['password'],
        $config['database']
    );

    if ($connection) {
        echo "Database '$name': OK\n";
        mysqli_close($connection);
    } else {
        echo "Database '$name': FAIL (" . mysqli_connect_error() . ")\n";
    }
}
?>

