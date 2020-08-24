<?php

namespace App\Helpers\Components;

class FormMacroProperty
{

    public $isRequired;

    public $textGroup;

    public function __construct(array $property)
    {
        $this->isRequired = $property['is_required'] ?? false;
        $this->textGroup = $property['text_group'] ?? null;
    }

    public function getIsRequired()
    {
        return $this->isRequired;
    }

    public function getTextGroup()
    {
        return $this->textGroup;
    }
}
