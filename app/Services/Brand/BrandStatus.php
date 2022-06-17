<?php

namespace App\Services\Brand;

class BrandStatus
{
    
    private $status;
    public function __construct( string $status = 'inactive')
    {
       
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }

}
