<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]); // Persist the preference in session
            App::setLocale($locale); // Set the app locale dynamically
        }

        $this->dispatch('language-changed');
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }
}
