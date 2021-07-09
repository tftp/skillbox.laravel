<?php

namespace App\Http\Controllers;

use App\Services\InformationCollector;

class ServicesProcessingController extends Controller
{
    private $informationCollector;

    public function __construct(InformationCollector $informationCollector)
    {
        $this->informationCollector = $informationCollector;
        $this->middleware('adminPrivileges');
    }

    public function informationCollectorServices()
    {
        $title = 'Информация';
        $collection = $this->informationCollector->collect();
        return view('information', compact('title', 'collection'));
    }
}
