<?php return array (
  'api' => 
  array (
    'standardsTree' => 'vnd',
    'subtype' => 'terc',
    'version' => 'v1',
    'prefix' => 'api',
    'domain' => NULL,
    'name' => 'Pendo Mpesa API',
    'conditionalRequest' => false,
    'strict' => false,
    'debug' => false,
    'errorFormat' => 
    array (
      'message' => ':message',
      'errors' => ':errors',
      'code' => ':code',
      'status_code' => ':status_code',
      'debug' => ':debug',
    ),
    'middleware' => 
    array (
    ),
    'auth' => 
    array (
    ),
    'throttling' => 
    array (
    ),
    'transformer' => 'Dingo\\Api\\Transformer\\Adapter\\Fractal',
    'defaultFormat' => 'json',
    'formats' => 
    array (
      'json' => 'Dingo\\Api\\Http\\Response\\Format\\Json',
    ),
  ),
  'app' => 
  array (
    'name' => 'Pendo MPESA',
    'env' => 'production',
    'debug' => true,
    'pagination_limit' => '10',
    'pendoapi_client_id' => '2',
    'pendoapi_client_secret' => '06Xd9HYyfu95IkHQt7Lykkt50wr3lSiPoGFF4WRP',
    'password_client_id' => '2',
    'password_client_secret' => 'ERTmtFHzruGnn7DXF47rCsBmSGadgHV4wby97xBi',
    'cache_minutes' => '5',
    'cache_minutes_low' => '60',
    'application_status' => 'sandbox',
    'mpesa_consumer_key' => 'd6m0rcZSyomd9Xq12rfRyl2Yav3VDdG7',
    'mpesa_consumer_secret' => 'QJAAHgWTFR3gZktE',
    'local_timezone' => 'Africa/Nairobi',
    'url' => 'http://localhost/pendompesa/',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:Esjh8de0/yFLp9NXiduf5bpUeoYn+RVBvq1GmLcamzM=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Laravel\\Tinker\\TinkerServiceProvider',
      23 => 'Laravel\\Passport\\PassportServiceProvider',
      24 => 'Laratrust\\LaratrustServiceProvider',
      25 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      26 => 'DaveJamesMiller\\Breadcrumbs\\ServiceProvider',
      27 => 'Intervention\\Image\\ImageServiceProvider',
      28 => 'App\\Providers\\DingoServiceProvider',
      29 => 'Barryvdh\\Cors\\ServiceProvider',
      30 => 'Torann\\GeoIP\\GeoIPServiceProvider',
      31 => 'Jenssegers\\Agent\\AgentServiceProvider',
      32 => 'Propaganistas\\LaravelPhone\\PhoneServiceProvider',
      33 => 'Optimus\\ApiConsumer\\Provider\\LaravelServiceProvider',
      34 => 'App\\Providers\\ValidationServiceProvider',
      35 => 'App\\Providers\\AppServiceProvider',
      36 => 'App\\Providers\\AuthServiceProvider',
      37 => 'App\\Providers\\BroadcastServiceProvider',
      38 => 'App\\Providers\\EventServiceProvider',
      39 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'LRedis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Laratrust' => 'Laratrust\\LaratrustFacade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Uuid' => 'Webpatser\\Uuid\\Uuid',
      'Breadcrumbs' => 'DaveJamesMiller\\Breadcrumbs\\Facade',
      'Carbon' => 'Carbon\\Carbon',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'GeoIP' => 'Torann\\GeoIP\\Facades\\GeoIP',
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
        'table' => 'users',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '3b731e398e444a456164',
        'secret' => '9104ae3afca47f0e6da6',
        'app_id' => '330982',
        'options' => 
        array (
          'cluster' => 'ap2',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\AppServ\\www\\pendompesa\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'constants' => 
  array (
    'account_settings' => 
    array (
      'default_group_cd' => NULL,
      'default_account_type_cd' => NULL,
      'savings_account_product_id' => NULL,
      'loan_repayment_account_product_id' => NULL,
    ),
    'routes' => 
    array (
      'get_users_url' => '/api/users/index',
      'create_user_url' => '/api/users/create',
      'create_message_url' => '/api/smsoutbox/create',
      'fetch_savings_deposit_accounts_url' => '/api/savings-deposit-accounts',
    ),
    'passport' => 
    array (
      'token_url' => 'http://41.215.126.10/public/api/login',
      'user_url' => '/api/user',
      'username' => 'superadministrator@pendo.co.ke',
      'password' => '123',
    ),
    'bulk_sms' => 
    array (
      'send_sms_url' => 'http://41.215.126.10/public/api/sms/sendSms',
      'company_id' => NULL,
      'usr' => NULL,
    ),
    'mpesa' => 
    array (
      'getpayments_url' => 'http://41.215.126.10/api2/api/api/mpesa/getpayments',
    ),
    'images' => 
    array (
      'no_image_full' => 'images/no_image.jpg',
      'no_image_thumb' => 'images/no_image.jpg',
      'no_image_thumb_400' => 'images/no_image.jpg',
    ),
    'settings' => 
    array (
      'app_mode' => 'test',
      'app_short_name' => 'terc',
      'pendoadmin_app_name' => NULL,
    ),
    'pendoadmin_passport' => 
    array (
      'username' => NULL,
      'password' => NULL,
      'token_url' => 'http://41.215.126.10/public/api/login',
    ),
    'sms_types' => 
    array (
      'registration_sms' => '1',
      'recommendation_sms' => '2',
      'resent_registration_sms' => '3',
      'forgot_password_sms' => '4',
      'confirm_number_sms' => '5',
      'company_sms' => '6',
    ),
    'status' => 
    array (
      'active' => '1',
      'disabled' => '2',
      'suspended' => '3',
      'expired' => '4',
      'pending' => '5',
      'confirmed' => '6',
      'cancelled' => '7',
      'sent' => '8',
      'inactive' => '99',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'pendompesa',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'pendompesa',
        'username' => 'showbiz_user1',
        'password' => '123xyz456',
        'unix_socket' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
      ),
      'mysql_yehuapi' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'pendompesa',
        'username' => 'showbiz_user1',
        'password' => '123xyz456',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'pendompesa',
        'username' => 'showbiz_user1',
        'password' => '123xyz456',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'excel' => 
  array (
    'cache' => 
    array (
      'enable' => true,
      'driver' => 'memory',
      'settings' => 
      array (
        'memoryCacheSize' => '32MB',
        'cacheTime' => 600,
      ),
      'memcache' => 
      array (
        'host' => 'localhost',
        'port' => 11211,
      ),
      'dir' => 'C:\\AppServ\\www\\pendompesa\\storage\\cache',
    ),
    'properties' => 
    array (
      'creator' => 'PendoAdmin',
      'lastModifiedBy' => 'PendoAdmin',
      'title' => 'Spreadsheet',
      'description' => 'Default spreadsheet export',
      'subject' => 'Spreadsheet export',
      'keywords' => 'PendoAdmin, maatwebsite, excel, export',
      'category' => 'Excel',
      'manager' => 'PendoAdmin',
      'company' => 'PendoAdmin',
    ),
    'sheets' => 
    array (
      'pageSetup' => 
      array (
        'orientation' => 'portrait',
        'paperSize' => '9',
        'scale' => '100',
        'fitToPage' => false,
        'fitToHeight' => true,
        'fitToWidth' => true,
        'columnsToRepeatAtLeft' => 
        array (
          0 => '',
          1 => '',
        ),
        'rowsToRepeatAtTop' => 
        array (
          0 => 0,
          1 => 0,
        ),
        'horizontalCentered' => false,
        'verticalCentered' => false,
        'printArea' => NULL,
        'firstPageNumber' => NULL,
      ),
    ),
    'creator' => 'Maatwebsite',
    'csv' => 
    array (
      'delimiter' => ',',
      'enclosure' => '"',
      'line_ending' => '
',
      'use_bom' => false,
    ),
    'export' => 
    array (
      'autosize' => true,
      'autosize-method' => 'approx',
      'generate_heading_by_indices' => true,
      'merged_cell_alignment' => 'left',
      'calculate' => false,
      'includeCharts' => false,
      'sheets' => 
      array (
        'page_margin' => false,
        'nullValue' => NULL,
        'startCell' => 'A1',
        'strictNullComparison' => false,
      ),
      'store' => 
      array (
        'path' => 'C:\\AppServ\\www\\pendompesa\\storage\\exports',
        'returnInfo' => false,
      ),
      'pdf' => 
      array (
        'driver' => 'DomPDF',
        'drivers' => 
        array (
          'DomPDF' => 
          array (
            'path' => 'C:\\AppServ\\www\\pendompesa\\vendor/dompdf/dompdf/',
          ),
          'tcPDF' => 
          array (
            'path' => 'C:\\AppServ\\www\\pendompesa\\vendor/tecnick.com/tcpdf/',
          ),
          'mPDF' => 
          array (
            'path' => 'C:\\AppServ\\www\\pendompesa\\vendor/mpdf/mpdf/',
          ),
        ),
      ),
    ),
    'filters' => 
    array (
      'registered' => 
      array (
        'chunk' => 'Maatwebsite\\Excel\\Filters\\ChunkReadFilter',
      ),
      'enabled' => 
      array (
      ),
    ),
    'import' => 
    array (
      'heading' => 'slugged',
      'startRow' => 1,
      'separator' => '_',
      'slug_whitelist' => '._',
      'includeCharts' => false,
      'to_ascii' => true,
      'encoding' => 
      array (
        'input' => 'UTF-8',
        'output' => 'UTF-8',
      ),
      'calculate' => true,
      'ignoreEmpty' => false,
      'force_sheets_collection' => false,
      'dates' => 
      array (
        'enabled' => true,
        'format' => false,
        'columns' => 
        array (
        ),
      ),
      'sheets' => 
      array (
        'test' => 
        array (
          'firstname' => 'A2',
        ),
      ),
    ),
    'views' => 
    array (
      'styles' => 
      array (
        'th' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'strong' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'b' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'i' => 
        array (
          'font' => 
          array (
            'italic' => true,
            'size' => 12,
          ),
        ),
        'h1' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 24,
          ),
        ),
        'h2' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 18,
          ),
        ),
        'h3' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 13.5,
          ),
        ),
        'h4' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'h5' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 10,
          ),
        ),
        'h6' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 7.5,
          ),
        ),
        'a' => 
        array (
          'font' => 
          array (
            'underline' => true,
            'color' => 
            array (
              'argb' => 'FF0000FF',
            ),
          ),
        ),
        'hr' => 
        array (
          'borders' => 
          array (
            'bottom' => 
            array (
              'style' => 'thin',
              'color' => 
              array (
                0 => 'FF000000',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\AppServ\\www\\pendompesa\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\AppServ\\www\\pendompesa\\storage\\app/public',
        'url' => 'http://localhost/pendompesa//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
    ),
  ),
  'geoip' => 
  array (
    'log_failures' => true,
    'include_currency' => true,
    'service' => 'ipapi',
    'services' => 
    array (
      'maxmind_database' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindDatabase',
        'database_path' => 'C:\\AppServ\\www\\pendompesa\\storage\\app/geoip.mmdb',
        'update_url' => 'https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'maxmind_api' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindWebService',
        'user_id' => NULL,
        'license_key' => NULL,
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'ipapi' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPApi',
        'secure' => true,
        'key' => NULL,
        'continent_path' => 'C:\\AppServ\\www\\pendompesa\\storage\\app/continents.json',
      ),
    ),
    'cache' => 'all',
    'cache_tags' => 
    array (
      0 => 'torann-geoip-location',
    ),
    'cache_expires' => 30,
    'default_location' => 
    array (
      'ip' => '127.0.0.0',
      'iso_code' => 'US',
      'country' => 'United States',
      'city' => 'New Haven',
      'state' => 'CT',
      'state_name' => 'Connecticut',
      'postal_code' => '06510',
      'lat' => 41.310000000000002,
      'lon' => -72.920000000000002,
      'timezone' => 'America/New_York',
      'continent' => 'NA',
      'default' => true,
      'currency' => 'USD',
    ),
  ),
  'image' => 
  array (
    'driver' => 'imagick',
  ),
  'laratrust' => 
  array (
    'use_morph_map' => false,
    'use_teams' => false,
    'user_models' => 
    array (
      'users' => 'App\\User',
    ),
    'models' => 
    array (
      'role' => 'App\\Role',
      'permission' => 'App\\Permission',
      'team' => 'App\\Team',
    ),
    'tables' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'teams' => 'teams',
      'role_user' => 'role_user',
      'permission_user' => 'permission_user',
      'permission_role' => 'permission_role',
    ),
    'foreign_keys' => 
    array (
      'user' => 'user_id',
      'role' => 'role_id',
      'permission' => 'permission_id',
      'team' => 'team_id',
    ),
    'middleware' => 
    array (
      'handling' => 'abort',
      'params' => '403',
    ),
    'magic_can_method_case' => 'kebab_case',
  ),
  'laratrust_seeder' => 
  array (
    'role_structure' => 
    array (
      'superadministrator' => 
      array (
        'user' => 'c,r,u,d',
        'acl' => 'c,r,u,d',
        'profile' => 'r,u',
        'sms' => 'c,r,u,d',
        'scheduled-sms' => 'c,r,u,d',
        'group' => 'c,r,u,d',
        'prayer-request' => 'c,r,u,d',
        'paybill' => 'c,r,u,d',
        'loan' => 'c,r,u,d',
        'account' => 'c,r,u,d',
        'deposit_account' => 'c,r,u,d',
        'loan_account' => 'c,r,u,d',
        'loan_repayment' => 'c,r,u,d',
        'loan_application' => 'c,r,u,d',
      ),
      'administrator' => 
      array (
      ),
      'companyadministrator' => 
      array (
      ),
      'companymanager' => 
      array (
      ),
    ),
    'permission_structure' => 
    array (
    ),
    'permissions_map' => 
    array (
      'c' => 'create',
      'r' => 'read',
      'u' => 'update',
      'd' => 'delete',
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'no-reply@tercgpn.com',
      'name' => 'Pendompesa',
    ),
    'encryption' => 'tls',
    'username' => 'tercgpn@gmail.com',
    'password' => '123456terc',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\AppServ\\www\\pendompesa\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\AppServ\\www\\pendompesa\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\AppServ\\www\\pendompesa\\resources\\views',
    ),
    'compiled' => 'C:\\AppServ\\www\\pendompesa\\storage\\framework\\views',
  ),
  'cors' => 
  array (
    'supportsCredentials' => false,
    'allowedOrigins' => 
    array (
      0 => '*',
    ),
    'allowedHeaders' => 
    array (
      0 => '*',
    ),
    'allowedMethods' => 
    array (
      0 => '*',
    ),
    'exposedHeaders' => 
    array (
    ),
    'maxAge' => 0,
  ),
  'breadcrumbs' => 
  array (
    'view' => 'breadcrumbs::bootstrap3',
  ),
  'tinker' => 
  array (
    'dont_alias' => 
    array (
    ),
  ),
);
