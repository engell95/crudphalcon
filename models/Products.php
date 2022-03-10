<?php

use Phalcon\Mvc\Model;

class Products extends Model
{

    public $Cod_Products;
    public $Description;
    public $Price;
    public $Type;
    public $Active;

    public function getSource()
    {
        return "Products";
    }
}

