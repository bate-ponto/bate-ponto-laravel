<div class="flex gap-5 items-center text-xs">
    <div class="flex flex-col w-full gap-1 items-center">
        <span class="text-sm whitespace-nowrap">Selected Time</span>

        <div class="flex w-full items-center gap-2 justify-between">
            <div class="flex flex-col items-center justify-center gap-1">
                <span>Month</span>
                <span>{{ convertNumberIntoTimeFormat($selectedMonthTimeMade) }}</span>
            </div>
            
            <div class="flex flex-col items-center justify-center gap-1">
                <span>Week</span>
                <span>{{ convertNumberIntoTimeFormat($selectedWeekTimeMade) }}</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col w-full gap-1 items-center">
        <span class="text-sm whitespace-nowrap">Current Time</span>

        <div class="flex w-full items-center gap-2 justify-between">
            <div class="flex flex-col items-center justify-center gap-1">
                <span>Month</span>
                <span>{{ convertNumberIntoTimeFormat($currentMonthTimeMade) }}</span>
            </div>

            <div class="flex flex-col items-center justify-center gap-1">
                <span>Week</span>
                <span>{{ convertNumberIntoTimeFormat($currentWeekTimeMade) }}</span>
            </div>
        </div>
    </div>
</div>
