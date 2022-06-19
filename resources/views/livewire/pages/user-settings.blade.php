@slot('title')
    User Settings
@endslot

<div class="bg-blue-500 flex flex-col relative w-full justify-center items-start p-10 sm:p-20">
    <a
        class="flex text-left pl-2 pb-2 text-blue-200 underline hover:text-blue-300 duration-150"
        href="{{ route('index') }}"
    >
        Back
    </a>

    <form
        wire:submit.prevent="submit"
        class="bg-blue-200 flex flex-col h-full w-full rounded-sm p-10 gap-3"
    >    
        <div class="flex flex-col">
            <label for="name">Name</label>
            <input
                wire:model="user.name"
                type="text" 
                id="name"
                placeholder="Place your name"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="user.name" />
        </div>

        <div class="flex flex-col">
            <label for="username">Username</label>
            <input
                wire:model="user.username"
                type="text" 
                id="username"
                placeholder="Place your name"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="user.username" />
        </div>

        <div class="flex flex-col">
            <label for="email">Email</label>
            <input
                wire:model="user.email"
                type="text" 
                id="email"
                placeholder="Place your name"
                class="py-0.5 px-1 rounded-sm"
            />

            <x-error name="user.email" />
        </div>

        <div class="flex flex-col">
            <label for="password">Password</label>

            <x-input.password wire:model="password" name="password" />

            <x-error name="password" />
        </div>

        <div class="flex flex-col">
            <label for="passwordConfirmation">Password Confirmation</label>

            <x-input.password wire:model="passwordConfirmation" name="passwordConfirmation" />

            <x-error name="passwordConfirmation" />
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
