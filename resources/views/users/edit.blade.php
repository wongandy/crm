<x-app-layout>
    <x-slot name="header">
        {{ __('Edit user') }}
    </x-slot>

    <!-- @if ($message = Session::get('success'))
        <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif -->

    <div class="p-4 bg-white rounded-lg shadow-md">

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input type="text"
                         id="name"
                         name="name"
                         class="block w-full"
                         value="{{ old('name', $user->name) }}"
                         />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input name="email"
                         type="email"
                         class="block w-full"
                         value="{{ old('email', $user->email) }}"
                         />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')"/>
                <x-text-input name="address"
                         type="text"
                         class="block w-full"
                         value="{{ old('address', $user->address) }}"
                         />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Phone number')"/>
                <x-text-input name="phone_number"
                         type="number"
                         class="block w-full"
                         value="{{ old('phone_number', $user->phone_number) }}"
                         />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="roles" :value="__('Roles')"/>
                @foreach ($roles as $id => $role)
                    <div class="mt-1 inline-flex space-x-1">
                        <input type="radio" name="role" id="role-{{ $id }}" value="{{ $id }}" @checked(old('role') ? old('role') == $id : $user->roles->pluck('id')->first() == $id)>
                        <x-input-label for="role-{{ $id }}">{{ $role }}</x-input-label>
                    </div>
                @endforeach
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
