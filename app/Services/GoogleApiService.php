<?php


namespace App\Services;


use App\Beans\SearchPlaceBean;
use App\Exceptions\Request\InvalidParameterException;
use Illuminate\Support\Facades\Cache;

class GoogleApiService
{
    protected $jsonMapper;

    public function __construct(\JsonMapper $jsonMapper)
    {
        $this->jsonMapper = $jsonMapper;
    }

    /**
     * @param String $placeName
     * @return SearchPlaceBean[]
     * @throws InvalidParameterException
     */
    public function searchRestaurantByPlaceName($placeName)
    {
        $cacheSearchKey = urlencode(strtolower($placeName));
        $cacheKey = sprintf('search-%s', $cacheSearchKey);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $objList = [];
        $headers = [
            'Content-type: application/json'
        ];
        $url = sprintf('%s/maps/api/place/textsearch/json?query=%s&type=restaurant&key=%s', config('constants.GOOGLE_API_BASE_URL'), urlencode($placeName), config('constants.GOOGLE_API_KEY'));

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
            $this->_saveCache($cacheKey, $objList);

            return $objList;
        }

        if ($response->status !== config('constants.GOOGLE_API_STATUS_OK')) {
            throw new InvalidParameterException();
        }

        foreach ($response->results as $result) {
            $objList[] = $this->jsonMapper->map($result, new SearchPlaceBean());
        }

        $this->_saveCache($cacheKey, $objList);

        return $objList;
    }

    private function _saveCache($cacheKey, $result)
    {
        Cache::put($cacheKey, $result);
    }
}
