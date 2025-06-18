<?php
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
new class extends Component
{
    #[Validate('required|string|max:255')]
    public string $message = '';
    
    public function store(): void
    {
        $validated = $this->validate();
        auth()->user()->chirps()->create($validated);
        session()->flash('success', '¡Chirp agregado correctamente!');
        $this->message = '';
        $this->dispatch('chirp-created');
    } 
}; ?>

<div>
    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="mb-4 text-green-600 bg-green-100 border border-green-300 rounded p-3"
    >
        {{ session('success') }}
    </div>
@endif
    
    <form wire:submit="store">
        <textarea
            wire:model="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>