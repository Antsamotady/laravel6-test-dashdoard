<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function getUsers() {

        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/users');
        $users = json_decode($response->getBody(), true);

        return view('index', compact('users'));
    }
}
