<?php

namespace App\Http\Controllers\fetch;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TeamApiFetchController extends Controller
{

    public function index()
    {
        $response = Http::get('https://azshipping.net/admin/teams/api');

        // Check if the request is successful
        if ($response->failed()) {
            // Handle the failure if necessary
            return view('admin.fetch.team.index', ['error' => 'API request failed']);
        }

        // Check the structure of the response
        $teamsdata = $response['data'];

        // Use dd() to dump the data and ensure it's passed to the view

        return view('admin.fetch.team.index', compact('teamsdata'));
    }

    public function createTeam()
    {
        return view('admin.fetch.team.create');
    }

}
