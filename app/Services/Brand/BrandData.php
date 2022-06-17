<?php

namespace App\Services\Brand;

class BrandData
{
    private $name;
    private $slug;
    private $brandStatus;
    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }
    public function setBrandStatus(BrandStatus $brandStatus): void
    {
        $this->brandStatus = $brandStatus;
    }
    public function getname(){
        return $this->name;
    }
    public function getSlug(){
        return $this->slug;
    }
    public function getBrandStatus(){
        return $this->brandStatus->getStatus();
    }
}
