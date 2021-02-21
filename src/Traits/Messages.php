<?php

/*
 * Traits/Messages.php: add messages
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Traits;

trait Messages
{
    protected $messages = [];

    public function getMessages()
    {
        return empty($this->messages) ? null : $this->messages;
    }
}
