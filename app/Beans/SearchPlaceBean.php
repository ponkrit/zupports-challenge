<?php


namespace App\Beans;


class SearchPlaceBean
{
    public $business_status = '';
    public $formatted_address = '';
    public $geometry;
    public $icon = '';
    public $icon_background_color = '';
    public $icon_mask_base_uri = '';
    public $name = '';
    public $opening_hours;
    public $photos = [];
    public $place_id = '';
    public $plus_code;
    public $price_level = 0;
    public $rating = 0;
    public $reference = '';
    public $types = [];
    public $user_ratings_total = 0;
}
