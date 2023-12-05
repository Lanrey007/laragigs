<?php

namespace App\Models;

class Listing {
    public static function all() {
        return [
            [
                'id' => 1,
                'title' => 'Listingone',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tristique enim nec quam pellentesque convallis. Proin pellentesque iaculis arcu vitae consequat'
            ],
            [
                'id' => 2,
                'title' => 'Listingtwo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tristique enim nec quam pellentesque convallis. Proin pellentesque iaculis arcu vitae consequat'
            ]
            ];
    }

    public static function find($id){
        $listings = self::all();
        foreach($listings as $listing){
        if($listing['id'] == $id ){
            return $listing;
        }
    }
    }
}