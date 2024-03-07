<?php

namespace App\Repository;

class ChatStorage
{
    public array $chatStorage;

    public function mergeChatStorage(array $postBody)
    {
        $this->chatStorage['contents'][] = $postBody;
    }
}