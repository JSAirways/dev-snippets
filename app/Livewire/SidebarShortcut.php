<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarShortcut extends Component
{
    public function render()
    {
        return <<<'HTML'
            <x-filament::button
                tag="a"
                color="primary"
                href="{{ url('/') }}"
                class="w-full mb-2"
                target="_blank"
            >
                View Frontend
            </x-filament::button>
        HTML;
    }
}
