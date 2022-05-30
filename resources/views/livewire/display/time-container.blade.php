<div class="w-full h-full bg-blue-100 py-2 gap-2 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-300">
    @foreach ($timeRegisters as $timeRegister)
        <livewire:display.time-register-card :timeRegister="$timeRegister" />
    @endforeach
</div>
