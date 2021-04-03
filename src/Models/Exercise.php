<?php

/*
 * Modules/Exercise.php: handle exercise data requests
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

class Exercise
{
    use \Traits\Attributes;
    use \Traits\AttributeActions;
    use \Traits\Messages;

    public const TABLE_NAME = 'exercises';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function save()
    {
        return true;
    }

    public function validate()
    {
        if (($results = $this->validation($this->config())) !== true)
        {
            $this->messages[] = $results;
            return false;
        }

        return true;
    }

    public function config()
    {
        return [
            'exercises_id' => function ($entry) {
                return is_numeric($entry);
            },
            'workout_id' => function ($entry) {
                return is_numeric($entry);
            },
            'user_id' => function ($entry) {
                return is_numeric($entry);
            },
            'sets' => function ($entry) {
                return is_numeric($entry);
            },
            'feedback' => function ($entry) {
                return true;
            },
        ];
    }

    public function transforms()
    {
        return [
            'exercises_id' => function ($entry) {
                return (int) $entry;
            },
            'workout_id' => function ($entry) {
                return (int) $entry;
            },
            'user_id' => function ($entry) {
                return (int) $entry;
            },
            'sets' => function ($entry) {
                return (int) $entry;
            },
            'feedback' => function ($entry) {
                return trim($entry);
            },
        ];
    }
}
