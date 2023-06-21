<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use Illuminate\Http\Resources\Json\JsonResource;


class TourController extends Controller
{
    public function index(Travel $travel):JsonResource
    {
        $tours = $travel->tours()->orderBy('created_at')->paginate(10);

        return TourResource::collection($tours);
    }
}
