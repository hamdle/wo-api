<?php
namespace Database\Query;

use Database\MySQL\Query;

class Exercises extends Query
{
    protected const EXERCISE_TABLE = 'exercises';

    public function all()
    {
        return parent::filter_by([], self::EXERCISE_TABLE);
    }

    public function add($args, $table = self::EXERCISE_TABLE)
    {
        parent::add($args, $table);
    }
}
