<?php


namespace App\Item\Domain;


class Item
{
    private string $id;
    private string $link;
    private string $title;

    public function __construct(string $itemId, string $link, string $title)
    {
        $this->id = $itemId;
        $this->link = $link;
        $this->title = $title;
    }

    public function getItemAsArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


}