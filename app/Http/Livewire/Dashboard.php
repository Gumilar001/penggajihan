<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class Dashboard extends Component
{
    public $currency = [
        'from' => null,
        'to' => null
    ];
    public $from, $to;

    public $list_currency = [];

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount()
    {
        // $this->getCurrency();
    }

    public function getCurrency()
    {
        $client = new Client();
        $req_url = "https://openexchangerates.org/api/currencies.json";
        $response = $client->get($req_url);
        if ($response->getStatusCode() == 200) {
            try {
                $this->list_currency = json_decode($response->getBody()->getContents(), true);
            } catch (\Exception $e) {
                // Handle JSON parse error...
            }
        }
    }

    public function convert()
    {
        $client = new Client();
        $amount = $this->currency['from'];
        $from = $this->from;
        $to = $this->to;

        // $response = $client->request('GET', 'https://api.apilayer.com/fixer/convert', [
        //     'query' => [
        //         'to' => $to ?? '',
        //         'from' => $from ?? '',
        //         'amount' => $amount ?? ''
        //     ],
        //     'headers' => [
        //         'Content-Type' => 'text/plain',
        //         'apikey' => 'WQjmnsYxddktliPiGYn43BYZeyAmUSFT'
        //     ]
        // ]);
        // $data = json_decode($response->getBody()->getContents());

        $req_url = "https://api.exchangerate.host/convert?from=$from&to=$to&amount=$amount";
        $response = $client->get($req_url);

        if ($response->getStatusCode() == 200) {
            try {
                $response_data = json_decode($response->getBody()->getContents());

                if ($response_data->success === true) {
                    $this->currency['to'] = number_format($response_data->result, 2);
                    ;
                }
            } catch (\Exception $e) {
                // Handle JSON parse error...
            }
        }
    }
}