<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $_jsonMapper;

    public function __construct(\JsonMapper $jsonMapper)
    {
        $this->_jsonMapper = $jsonMapper;
    }

    protected function jsonResponse($data = [])
    {
        if (is_array($data)) {
            return response()->json($data);
        }

        $data = (get_parent_class($data) == 'App\Http\Responses\BaseResp') ? $data->toArray() : $data = json_decode(json_encode($data), true);

        return response()->json($data);
    }
}
