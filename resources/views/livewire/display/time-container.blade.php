<div class="w-full h-full bg-blue-100 py-2 gap-2 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-300">
    @foreach ($timeRegisters as $key => $timeRegister)
        <div
            @class([
                'flex w-[98%] mx-auto mb-2 last:mb-0 h-20 px-3',
                'bg-blue-500 items-center justify-between text-blue-200'
            ])
        >
            <div class="flex flex-col items-start gap-2">
                <label for="timeRegisters.{{ $key }}.description">
                    Description
                </label>
        
                <input
                    id="timeRegisters.{{ $key }}.description"
                    wire:model="timeRegisters.{{ $key }}.description"
                    class="text-black px-2 outline-none focus:ring focus:ring-blue-200"
                    type="text"
                />
            </div>

            <div class="flex gap-3">
                <div class="flex flex-col items-center justify-center">
                    <label for="timeRegisters.{{ $key }}.startTime">
                        Start Time
                    </label>

                    <input
                        id="timeRegisters.{{ $key }}.startTime"
                        class="bg-white outline-none max-w-[5rem] text-center p-1 rounded-sm text-blue-500"
                        wire:model="timeRegisters.{{ $key }}.start_time"
                        readonly
                    />
                </div>

                <div class="flex flex-col items-center justify-center">
                    <label for="timeRegisters.{{ $key }}.endTime">
                        End Time
                    </label>

                    <input
                        id="timeRegisters.{{ $key }}.endTime"
                        class="bg-white outline-none max-w-[5rem] text-center p-1 rounded-sm text-blue-500"
                        wire:model="timeRegisters.{{ $key }}.end_time"
                        readonly
                    />
                </div>

                <div class="flex flex-col items-center justify-center">
                    <label for="timeRegisters.{{ $key }}.duration">
                        Duration
                    </label>

                    <input
                        id="timeRegisters.{{ $key }}.duration"
                        class="bg-white outline-none max-w-[5rem] text-center p-1 rounded-sm text-blue-500"
                        wire:model="timeRegisters.{{ $key }}.duration"
                        readonly
                    />
                </div>
            </div>
        </div>
    @endforeach
</div>
