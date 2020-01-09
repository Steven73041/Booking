<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class AppServiceProvider extends AuthServiceProvider {

    /**
     * The policy mappings for the application
     *
     * @var array
     */
    protected $policies = [
        'App\Reviews' => 'App\Policies\ReviewsPolicy',
        'App\Favorites' => 'App\Policies\FavoritesPolicy',
        'App\Rooms' => 'App\Policies\RoomsPolicy',
        'App\Booking' => 'App\Policies\BookingPolicy'
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
//        Cashier::keepPastDueSubscriptionsActive();
//        Stripe::setApiKey('pk_test_AQkbKrWkhG1aqiV490O9frol00ITYltgQI');
    }

    public function getUserIP() {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        /**
         * pagination for collections
         * @return pagination
         */
        if (!Collection::hasMacro('paginate')) {
            Collection::macro('paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath('');
                });
        }

        /**
         * weather API
         * @return header $weather content
         */
//        $user_ip = $this->getUserIP();
//        $user_ip = '94.71.243.253'; //Athens
        $user_ip = '141.255.49.208'; //Kiato
        $city = $this->ip_info($user_ip, 'city');
        $code = $this->ip_info($user_ip, 'countrycode');
        $headers = [
            "Accept" => "application/json",
            "x-rapidapi-host" => "community-open-weather-map.p.rapidapi.com",
            "x-rapidapi-key" => "494e479bbdmsh4edb7f26e5ba5bep14df48jsna67d1f4a1728"
        ];
        $body = '?q=' . $city . ',' . $code . '&units=metric&lang=en';
        $client = new Client([
            'body' => $body,
            'headers' => $headers,
            'base_uri' => 'https://community-open-weather-map.p.rapidapi.com/weather/',
            'timeout' => 6.0,
        ]);
        $r = $client->request('GET', $body);
        $weather_error = $r->getReasonPhrase();
        if ($weather_error === "OK") {
            $weather = json_decode($r->getBody()->getContents());
            View::share([
                    'weather_error' => $weather_error,
                    'weather' => $weather,
                ]
            );
        }
        /**
         * Register policies
         * @protected $policies[]
         */
        $this->registerPolicies();

        Schema::defaultStringLength(191);
    }
}
