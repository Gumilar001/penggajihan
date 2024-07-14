<?php
use GuzzleHttp\Client;

if (!function_exists('currency_IDR')) {
  function currency_IDR($value)
  {
    try {
      // return number_format($value, 0, ',', '.');
      $value = str_replace(',', '', $value);
      $decimal = 0;
      if (strpos($value, '.') !== false) {
        $decimal = 2;
      }
      return number_format($value, $decimal, '.', ',');
    } catch (\Throwable $th) {
      return $value;
    }
  }
}

function humanFileSize($size, $unit = "")
{
  if ((!$unit && $size >= 1 << 30) || $unit == "GB")
    return number_format($size / (1 << 30), 2) . " GB";
  if ((!$unit && $size >= 1 << 20) || $unit == "MB")
    return number_format($size / (1 << 20), 2) . " MB";
  if ((!$unit && $size >= 1 << 10) || $unit == "KB")
    return number_format($size / (1 << 10), 2) . " KB";
  return number_format($size) . " bytes";
}

function transText($text)
{
  if (str_contains(strtolower($text), 'add')) {
    return str_replace('add', 'tambah', $text);
  } else if (str_contains(strtolower($text), 'delete')) {
    return str_replace('delete', 'hapus', $text);
  } else if (str_contains(strtolower($text), 'create')) {
    return str_replace('create', 'buat', $text);
  } else {
    return $text;
  }
}

function numberToRomawi($number)
{
  $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
  $bln = $array_bln[date($number)];
  return $bln;
}

function spell($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = spell($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = spell($nilai / 10) . " puluh" . spell($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . spell($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = spell($nilai / 100) . " ratus" . spell($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . spell($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = spell($nilai / 1000) . " ribu" . spell($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = spell($nilai / 1000000) . " juta" . spell($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = spell($nilai / 1000000000) . " milyar" . spell(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = spell($nilai / 1000000000000) . " trilyun" . spell(fmod($nilai, 1000000000000));
  }
  return $temp;
}

function sayTotal($nilai, $code = "IDR")
{
  $code = getCurrencyText($code);
  if ($nilai < 0) {
    $hasil = "minus " . trim(spell($nilai)) . " " . $code;
  } else {
    $hasil = trim(spell($nilai)) . " " . $code;
  }
  return $hasil;
}
function terbilang_desimal($angka, $code = "IDR")
{
  $code = getCurrencyText($code);
  if (strtoupper($code) != "RUPIAH") {
    $angka = str_replace(".", ",", $angka);
  }

  $bilangan = explode(',', $angka);
  $terbilang = terbilang($bilangan[0]);
  if (isset($bilangan[1])) {
    $terbilang .= ' koma ';
    $panjang_desimal = strlen($bilangan[1]);
    for ($i = 0; $i < $panjang_desimal; $i++) {
      $digit = $bilangan[1][$i];
      $terbilang .= terbilang($digit) . ' ';
    }

    return $terbilang . " " . $code;
  } else {
    $say = sayTotal(str_replace(".", "", $angka), $code);
    return $say . " " . $code;
  }
}

function terbilang($angka)
{
  $bilangan = array(
    '',
    'satu',
    'dua',
    'tiga',
    'empat',
    'lima',
    'enam',
    'tujuh',
    'delapan',
    'sembilan',
    'sepuluh',
    'sebelas'
  );
  $angka = trim($angka);
  if ($angka < 12) {
    return $bilangan[$angka];
  } elseif ($angka < 20) {
    return $bilangan[$angka - 10] . ' belas';
  } elseif ($angka < 100) {
    $hasil = trim(terbilang($angka % 10));
    return terbilang(floor($angka / 10)) . ' puluh ' . $hasil;
  } elseif ($angka < 200) {
    $hasil = trim(terbilang($angka % 100));
    return 'seratus ' . $hasil;
  } elseif ($angka < 1000) {
    $hasil = trim(terbilang($angka % 100));
    return terbilang(floor($angka / 100)) . ' ratus ' . $hasil;
  } elseif ($angka < 2000) {
    $hasil = trim(terbilang($angka % 1000));
    return 'seribu ' . $hasil;
  } elseif ($angka < 1000000) {
    $hasil = trim(terbilang($angka % 1000));
    return terbilang(floor($angka / 1000)) . ' ribu ' . $hasil;
  } elseif ($angka < 1000000000) {
    $hasil = trim(terbilang($angka % 1000000));
    return terbilang(floor($angka / 1000000)) . ' juta ' . $hasil;
  } elseif ($angka < 1000000000000) {
    $hasil = trim(terbilang($angka % 1000000000));
    return terbilang(floor($angka / 1000000000)) . ' milyar ' . $hasil;
  } elseif ($angka < 1000000000000000) {
    $hasil = trim(terbilang($angka % 1000000000000));
    return terbilang(floor($angka / 1000000000000)) . ' trilyun ' . $hasil;
  } else {
    return 'undefined';
  }
}
// function sendWhatsapp($no_whatsapp, $message)
// {
//   $api_key = env('API_KEY_WATSAP'); // API KEY Anda
//   $id_device = env('DEVICE_ID_WATSAP'); // ID DEVICE yang di SCAN (Sebagai pengirim)
//   $url = 'https://api.watsap.id/send-message'; // URL API
//   $no_hp = $no_whatsapp; // No.HP yang dikirim (No.HP Penerima)
//   $pesan = $message; // Pesan yang dikirim

//   $curl = curl_init();
//   curl_setopt($curl, CURLOPT_URL, $url);
//   curl_setopt($curl, CURLOPT_HEADER, 0);
//   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//   curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
//   curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
//   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
//   curl_setopt($curl, CURLOPT_POST, 1);

//   $data_post = [
//     'id_device' => $id_device,
//     'api-key' => $api_key,
//     'no_hp' => $no_hp,
//     'pesan' => $pesan
//   ];
//   curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
//   curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//   $response = curl_exec($curl);
//   curl_close($curl);

// }
function sendMediaWhatsapp($sender, $receiver, $message, $url)
{
  $data = [
    'api_key' => 'RhX9vUkBfasAhqhBVBu8EdeXI4jZQz',
    'sender' => $sender,
    //nomor pengrim
    'number' => $receiver,
    //nomor penerima
    'message' => $message,
    //isi pesan
    'url' => $url,
    //file yang di download
    'type' => 'pdf',
    //Choose One
  ];
  $curl = curl_init();

  curl_setopt_array(
    $curl,
    array(
      CURLOPT_URL => 'https://server.wa-bisnis.com/send-media',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    )
  );

  $response = curl_exec($curl);

  curl_close($curl);
  // echo $response;
}

function sendWablas($noWhatsapp, $header, $link, $content)
{
  $curl = curl_init();
  $token = "ccBQWmdKMVGjjZNzo2GFjIaQncjGu3r4L4Hk9tvfUzDm4QnkvGPGREW30oeMoIdy";
  $payload = [
    "data" => [
      [
        'phone' => $noWhatsapp,
        'message' => [
          'title' => [
            'type' => 'text',
            'content' => $header,
          ],
          'buttons' => [
            'url' => [
              'display' => 'Link Persetujuan',
              'link' => $link,
            ],
            'quickReply' => ["Download File"],
          ],
          'content' => $content,
        ],
      ]
    ]
  ];
  curl_setopt(
    $curl,
    CURLOPT_HTTPHEADER,
    array(
      "Authorization: $token",
      "Content-Type: application/json"
    )
  );
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com/api/v2/send-template");
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

  $result = curl_exec($curl);
  curl_close($curl);

}
function sendWhatsapp($no_hp, $message)
{
  $data = [
    'api_key' => 'AUUTDvW70mYnPl7F4R46QwvItattxO',
    'sender' => '6285321433777',
    'number' => $no_hp,
    'message' => $message
  ];
  $response = Http::post("https://wa.srv14.wapanels.com/send-message" , $data);
  return $response;
}




function getCurrencySymbol($code)
{
  $jsonString = file_get_contents(public_path('data/currency.json'));
  $data = json_decode($jsonString, true);

  foreach ($data as $item) {
    if ($item['Code'] == $code) {
      return $item['Symbol'];
    }
  }

  return null;
}
function getCurrencyText($code)
{
  $jsonString = file_get_contents(public_path('data/currency.json'));
  $data = json_decode($jsonString, true);

  foreach ($data as $item) {
    if ($item['Code'] == $code) {
      return $item['Currency'];
    }
  }

  return null;
}
function convertCurrency($from, $to, $amount, $withSymbol = true)
{
  $client = new Client();

  $req_url = "https://api.exchangerate.host/convert?from=$from&to=$to&amount=$amount&places=2";
  $response = $client->get($req_url);

  if ($response->getStatusCode() == 200) {
    try {
      $response_data = json_decode($response->getBody()->getContents());

      if ($response_data->success === true) {
        $symbol = "";
        if ($withSymbol) {
          $symbol = getCurrencySymbol($to);
        }
        if ($to == "IDR") {
          return $symbol . " " . currency_IDR($response_data->result);
        } else {
          $result = $symbol . " " . $response_data->result;
          return $result;
        }
      }
    } catch (\Exception $e) {
      // Handle JSON parse error...
    }
  }
}

function formatNumber($value)
{
  $value = str_replace(',', '', $value);
  $decimal = 0;
  if (strpos($value, '.') !== false) {
    $decimal = 2;
  }
  return number_format($value, $decimal, '.', ',');
}