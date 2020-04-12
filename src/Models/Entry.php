<?php
namespace Models;

class Entry
{
    use \Utils\Attributes;
    /**
     * The Entry attributes defined by the database are:
     *
     * id
     * user_id
     * key
     * value
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}