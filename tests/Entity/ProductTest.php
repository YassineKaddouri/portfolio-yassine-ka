<?php
namespace App\Tests\Entity;
use App\Entity\Product;
class ProductTest extends \PHPUnit\Framework\TestCase
{
//    public function testDefault()
//    {
//        {
//            $product = new Product('Un produit', Product::FOOD_PRODUCT, -20);
//            $this->expectException('Exception');
//            $product->computeTVA();
//        }
//    }

   public function testDouble(){
       $product = new Product();

      // $product->double(2);
       $this->assertEquals(6,$product->double(2));
   }
}
