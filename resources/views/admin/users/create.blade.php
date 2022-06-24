<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-300 border border-red-800 text-black rounded p-2 ">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-control">
                            <label class="label" for="username">
                                <span class="label-text">Username</span>
                            </label>
                            <input type="text"
                                   name="name" id="username"
                                   placeholder="Username" class="input input-bordered"
                                   value="{{old('name')}}">
                        </div>
                        <div class="form-control">
                            <label class="label" for="email">
                                <span class="label-text">Email Address</span>
                            </label>
                            <input type="email"
                                   name="email" id="email"
                                   placeholder="Email Address" class="input input-bordered"
                                   value="{{old('email')}}">
                        </div>
                        <div class="form-control">
                            <label class="label" for="password">
                                <span class="label-text">Password</span>
                            </label>
                            <input type="password"
                                   name="password" id="password"
                                   placeholder="Password" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label" for="password_confirmation">
                                <span class="label-text">Confirm Password</span>
                            </label>
                            <input type="password"
                                   name="password_confirmation" id="password_confirmation"
                                   placeholder="Confirm Password" class="input input-bordered">
                        </div>
                        <div class="form-control">
                        <label class="label" for="role_selector">
                            <span class="label-text">Select Role</span>
                        </label>
                            <select name="role_selector" id="role_selector"
                                    class="select select-bordered w-full max-w-xs">
                                <option value="astronaut">Astronaut</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                        <div class="py-6">
                            <button class="btn btn-sm btn-primary text-gray-50"
                                    type="submit">Save New User
                            </button>
                            <a class="btn btn-sm btn-secondarys text-gray-50"
                               href="{{route('users.index')}}">
                                Back to Users
                            </a>
                            <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
