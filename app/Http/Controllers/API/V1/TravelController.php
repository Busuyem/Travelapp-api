<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelController extends Controller
{
    public function index():JsonResource
    {
        return TravelResource::collection(Travel::where('is_public', true)->paginate(10));
    }
}
