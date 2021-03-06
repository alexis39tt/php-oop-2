<?php

trait Dates{
    public $date_month = date('m');
    public $date_year = date('y');
}

class Product{
    public $product_name;
    public $product_id;
    public $product_price;
    public $product_category;
    public $product_available = true;
    public function setName($product_name){
        $this->product_name = $product_name;
    }
    public function UserDiscount($user_discount){
        if($user_discount > 0)
            $this->product_price = $this->product_price*((100-$user_discount)/100);
    }
}

class SeasonalProduct extends Product{
    use Dates;
    public $available_from = 5;
    public $available_to = 8;
    public function isProductAvailable($date_month){
        if($this->available_from >= $date_month && $this->available_to <= $date_month)
            $this->product_available = true;
        else
            $this->product_available = false;
    }
}
class Toys extends Product{
    public $product_category = 'Toy';
}
class User
{   
    use Dates;
    public $user_discount = 0;
    public $cc_month;
    public $cc_year;
    public function isCCValid($cc_month, $cc_year, $date_month, $date_year)
    {

        if ($cc_year > $date_year)
            return true;
        else if ($cc_year == $date_year)
            if ($cc_month >= $date_month)
                return true;
            else
                return false;
    }
}

class LoggedUser extends User
{
    public $user_discount = 20;
}

?>