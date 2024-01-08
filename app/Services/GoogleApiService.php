<?php


namespace App\Services;


use App\Beans\SearchPlaceBean;
use App\Exceptions\Request\InvalidParameterException;

class GoogleApiService
{
    /**
     * @param String $placeName
     * @return SearchPlaceBean[]
     * @throws InvalidParameterException
     */
    public function searchRestaurantByPlaceName($placeName)
    {
        $objList = [];
        $headers = [
            'Content-type: application/json'
        ];
        $url = sprintf('%s/maps/api/place/textsearch/json?query=%s&type=restaurant&key=%s', config('constants.GOOGLE_API_BASE_URL'), $placeName, config('constants.GOOGLE_API_KEY'));

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);

        $resp = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status !== config('constants.HTTP_STATUS_OK')) {
            throw new InvalidParameterException();
        }

        $response = json_decode($resp);

        if ($response->status === config('constants.GOOGLE_API_STATUS_ZERO_RESULTS')) {
            return $objList;
        }

        if ($response->status !== config('constants.GOOGLE_API_STATUS_OK')) {
            throw new InvalidParameterException();
        }

        foreach ($response->data->results as $result) {
            $objList[] = $this->jsonMapper->map($result, new SearchPlaceBean());
        }

        return $objList;
    }
}
