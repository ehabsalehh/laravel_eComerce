<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class TestController extends Controller
{
    public function calculateTotalPrice(){
        
    }
    // public function sessionOne(){
    //     $data = collect([7,4,5,6,3,8,10]);
    //    $value= $data->map([$this,'addOne'])
    //                 ->map([$this,'square'])
    //                 ->map([$this,'subtractTen'])
    //                 ->filter(fn($number)=>$number<20)
    //                 ->sort()
    //                 ->take(2);
    //     return $value;
    // }
    // public function sessionTwo(){
    //     $eligateOne = fn($number):float=> $this->testOne($number);
    //     $eligateTwo = fn($number):float=> $this->testTwo($number);
    //     $eligatehree = fn($numberone,$numberTwo):float=> $this->testThree($numberone,$numberTwo);
    //     $tuple = [$eligateOne,$eligateTwo];
    //     echo $eligateOne(5).PHP_EOL;
    //     echo $eligateTwo(5).PHP_EOL;
    //     echo $tuple[0](5).PHP_EOL;
    //     echo $tuple[1](5).PHP_EOL;
    //     echo $eligatehree($eligateOne,5).PHP_EOL;

    // }
    
    // session Two
    // public function testOne(float $number) :float
    // {
    //     return $number/2;
    // }
    // public function testTwo(float $number):float 
    // {
    //     return $number/4 + 1;
    // }
    // public function testThree(Closure $fun,float $number):float{
    //     return $fun($number) + $number;
    // }
    // // session one
    // public function addOne(int $number):int{
    //     return $number+1;
    // }
    // public function square(int $number):int
    // {
    //     return $number * $number;
    // }
    // public function subtractTen($number):int
    // {
    //     return $number - 10;
    // }
}
