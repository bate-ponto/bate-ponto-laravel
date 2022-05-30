<div class="flex w-[98%] mx-auto mb-2 last:mb-0 h-20 px-3 bg-blue-500 items-center justify-between text-blue-200">
    <div class="flex flex-col items-start gap-2">
        <span>Description</span>
        <input wire:model="timeRegister.description" class="text-black px-2 outline-none focus:ring focus:ring-blue-200" type="text" />
    </div>
    <div class="flex gap-3">
        <div class="flex flex-col items-center justify-center">
            <span>Start Time</span>
            <span class="bg-white p-1 rounded-sm text-blue-500">
                {{ $timeRegister?->start_time?->format('H:i:s') ?? '00:00:00' }}
            </span>
        </div>
        <div class="flex flex-col items-center justify-center">
            <span>End Time</span>
            <span
                class="bg-white p-1 rounded-sm text-blue-500">
                {{ $timeRegister?->end_time?->format('H:i:s') ?? '00:00:00' }}
            </span>
        </div>
        <div class="flex flex-col items-center justify-center">
            <span>Duration</span>
            <span
                class="bg-white p-1 rounded-sm text-blue-500">
                {{ $timeRegister?->duration?->format('H:i:s') ?? '00:00:00' }}
            </span>
        </div>
    </div>
</div>
