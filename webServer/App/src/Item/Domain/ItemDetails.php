<?php


namespace App\Item\Domain;


class ItemDetails
{
    private string $id;
    private string $image;
    private string $author;
    private float $price;

    public function __construct($id, $image, $author, $price)
    {
        $this->id = $id;
        $this->image = $image;
        $this->author = $author;
        $this->price = $price;
    }
    public function getItemDetailsAsArray(): array
    {
        return get_object_vars($this);
    }
}