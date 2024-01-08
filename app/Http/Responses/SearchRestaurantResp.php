<?php


namespace App\Http\Responses;


use App\Beans\SearchPlaceBean;

class SearchRestaurantResp extends BaseResp
{
    public $restaurantList = [];

    public function __construct($resultList)
    {
        $this->__init($resultList);
    }

    /**
     * @param SearchPlaceBean[] $resultList
     */
    private function __init($resultList)
    {
        foreach ($resultList as $result) {
            $data = [
                'id' => $result->place_id,
                'name' => $result->name,
                'status' => $result->business_status,
                'rating' => $result->rating,
                'totalRatings' => $result->user_ratings_total
            ];
            $this->restaurantList[] = $data;
        }
    }
}
