@slot('title')
    login
@endslot

<div class="bg-blue-500 flex relative w-full justify-center items-center">
    <div class="h-28 hidden md:block text-blue-200 absolute top-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <form
        wire:submit.prevent="submit"
        class="bg-blue-200 flex flex-col h-fit w-fit rounded-sm p-10 gap-3"
    >
        <div class="flex flex-col">
            <label for="username">Email Or Username</label>
            <input
                wire:model="username"
                id="username"
                type="text"
                placeholder="Place your email or username"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="username" />
            <x-error name="invalidCredentials" />
        </div>

        <div class="flex flex-col">
            <label for="password">Password</label>
            <x-input.password wire:model="password" name="password" />

            <x-error name="password" />
        </div>

        <div class="flex gap-2 items-center">
            
            <input
                wire:model="rememberMe"
                type="checkbox"
                id="rememberMe"
                class=""
            />

            <label for="rememberMe" class="text-sm">Remember Me</label>

            <x-error name="rememberMe" />
        </div>

        <div class="flex justify-center my-2">
            <a href="{{ route('register') }}" class="text-sm text-blue-600">
                Don't have an account?
            </a>
        </div>

        <button
            wire:click="submit"
            type="submit"
            class="px-2 py-1 bg-blue-50 border border-blue-800 hover:bg-blue-600"
        >
            Submit
        </button>
    </form>
</div>
