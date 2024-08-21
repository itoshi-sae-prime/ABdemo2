<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class CrawlerController extends Controller
{
    public function getPrice($value)
    {
        try {
            $client = new Client();
            $httpOptions = [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; gmt)'
                ]
            ];
            $crawler = $client->request('GET', $value, $httpOptions);
            $htmlContent = (string) $crawler->getBody();
            $pattern = "/ecomm_totalvalue: '(\d+)'/";
            preg_match($pattern, $htmlContent, $matches);
            $totalValue = $matches[1] ?? null;
            return $totalValue;
        } catch (Exception $e) {
            return 0;
        }
    }
}
