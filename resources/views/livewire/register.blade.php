@slot('title')
    Register
@endslot

<div class="bg-blue-500 flex relative w-full justify-center items-center">
    <div class="bg-blue-200 flex flex-col h-fit w-fit rounded-sm p-10 gap-3">
        <div class="flex flex-col">
            <label for="name">Name</label>
            <input
                wire:model="name"
                type="text" 
                id="name"
                placeholder="Place your name"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="name" />
        </div>

        <div class="flex flex-col">
            <label for="username">Username</label>
            <input
                wire:model="username"
                type="text"
                id="username"
                placeholder="Place your username"
                class="py-0.5 px-1 rounded-sm" 
            />

            <x-error name="username" />
        </div>

        <div class="flex flex-col">
            <label for="email">Email</label>
            <input
                wire:model="email"
                type="email"
                id="email"
                placeholder="Place your email"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="email" />
        </div>

        <div class="flex flex-col">
            <label for="password">Password</label>
            <x-input.password name="password" wire:model="password" />

            <x-error name="password" />
        </div>

        <div class="flex flex-col">
            <label for="password-confirmation">Confirm Password</label>
            <x-input.password name="password-confirmation" wire:model="passwordConfirmation" />

            <x-error name="passwordConfirmation" />
        </div>

        <div class="flex justify-center my-2">
            <a href="{{ route('login') }}" class="text-sm text-blue-600">
                Login in your account
            </a>
        </div>

        <button
            wire:click="submit"
            type="submit"
            class="px-2 py-1 bg-blue-50 border border-blue-800 hover:bg-blue-600"
        >
            Submit
        </button>
    </div>
</div>
