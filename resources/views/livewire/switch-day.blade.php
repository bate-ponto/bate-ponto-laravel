<div class="flex items-center gap-1">
    <button
        wire:click="previousDate"
        class="text-blue-300"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-7"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"
            />
        </svg>
    </button>

    <span class="bg-blue-200 text-blue-900 rounded-sm px-2 py-1 select-none">
        {{ $date->format('M jS, Y') }}
    </span>

    <button
        wire:click="nextDate"
        class="text-blue-300"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-7"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"
            />
        </svg>
    </button>
</div>
