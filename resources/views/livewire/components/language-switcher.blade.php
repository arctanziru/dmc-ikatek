<x-bladewind::dropmenu>
    <x-slot:trigger>
        <div class="flex gap-2 items-center">
            <x-bladewind::icon name="language" class="h-[16px]" />
            <p>
                {{ strtoupper(app()->getLocale()) }}
            </p>
        </div>
    </x-slot:trigger>
    <x-bladewind::dropmenu-item wire:click="changeLanguage('en')">
        English
    </x-bladewind::dropmenu-item>
    <x-bladewind::dropmenu-item wire:click="changeLanguage('id')">
        Bahasa Indonesia
    </x-bladewind::dropmenu-item>
</x-bladewind::dropmenu>

@script
<script>
    $wire.on('language-changed', () => {
        window.location.reload();
    });
</script>
@endscript
