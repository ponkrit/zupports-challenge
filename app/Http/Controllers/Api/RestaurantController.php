<?php

namespace App\Http\Controllers\Api;

use App\Beans\SearchPlaceBean;
use App\Http\Requests\Restaurant\SearchReq;
use App\Http\Responses\SearchRestaurantResp;
use App\Services\GoogleApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function searchByPlaceName(Request $request, GoogleApiService $googleApiService)
    {
        /**
         * @var SearchReq $searchReq
         * @var SearchPlaceBean[] $result
         */
        $searchReq = $this->_jsonMapper->map($request->json(), new SearchReq());
        $result = $googleApiService->searchRestaurantByPlaceName($searchReq->searchName);

        $shortageUrlListResponse = new SearchRestaurantResp($result);

        return $this->jsonResponse($shortageUrlListResponse);
    }
}
