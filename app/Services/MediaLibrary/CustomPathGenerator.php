<?php

namespace App\Services\MediaLibrary;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Employee\Product\Product;
use App\Models\Employee\Product\Category;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomPathGenerator implements BasePathGenerator
{
    public function getPath(Media $media): string{
        $array =[
            Admin::class => 'Admins',
            Employee::class => 'Employees',
            Product::class => 'Products',
            Category::class=>"Categories"
        ];
        return data_get($array,$media->model_type).'/';

    }

    public function getPathForConversions(Media $media): string{
        $array =[
            Admin::class => 'Admins',
            Employee::class => 'Employees',
            Product::class => 'Products',
            Category::class=>"Categories"
        ];
        return data_get($array,$media->model_type).'/conversions/';

    }
    public function getPathForResponsiveImages(Media $media): string{
        $array =[
            Admin::class => 'Admins',
            Employee::class => 'Employees',
            Product::class => 'Products',
            Category::class=>"Categories"
        ];
        return data_get($array,$media->model_type). '/responsive-images/';
    }

}
