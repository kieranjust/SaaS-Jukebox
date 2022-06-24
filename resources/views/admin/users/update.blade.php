<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Edit User')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('users.update', ['user'=>$user])}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-control">
                        <label class="label" for="username">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text"
                               name="name" id="username"
                               placeholder="Username" class="input input-bordered"
                               value="{{old('name') ?? $user->name }}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text">Email Address</span>
                        </label>
                        <input type="email"
                               name="email" id="email"
                               placeholder="Email Address" class="input input-bordered"
                               value="{{old('email') ?? $user->email}}">
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
                    @if(!$admin && ($auth->hasRole(["admin"]) || $auth->hasRole(["manager"])))
                        <label class="label" for="password_confirmation">
                            <span class="label-text">User Role</span>
                        </label>
                        <select name="role_selector" id="role_selector"
                                class="select select-bordered w-full max-w-xs">
                            <option value="astronaut"
                                @if($user->hasRole('astronaut')) selected @endif>Astronaut</option>
                            <option value="manager"
                                    @if($user->hasRole('manager')) selected @endif>Manager</option>
                        </select>
                    @endif
                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Update User
                        </button>
                        <a class="btn btn-sm btn-secondary text-gray-50"
                           href="{{route('users.index')}}">
                            Back to Users
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
