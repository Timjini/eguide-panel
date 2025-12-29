<?php 

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $channels = '';
        return view('companies.channels.index', ['channels' => $channels]);
    }
}