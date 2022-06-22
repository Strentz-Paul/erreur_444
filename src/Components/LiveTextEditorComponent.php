<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\Validator\Constraints as Assert;


#[AsLiveComponent('live_text_editor')]
class LiveTextEditorComponent
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public string $name;

    #[LiveProp]
    public string $label;

    #[LiveProp(writable: true)]
    #[Assert\NotBlank]
    public string $value = '';

    /**
     * @param string $name
     * @return void
     */
    public function mount(string $name): void
    {
        $this->name = $name;
        $this->label = ucfirst($name);
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return max(3, floor(strlen($this->value) / 50));
    }
}
