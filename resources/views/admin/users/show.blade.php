<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('User Details')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <dl class="grid grid-cols-6 gap-2">
                        <dt class="col-span-1">ID</dt>
                        <dd class="col-span-5">{{$user->id}}</dd>
                        <dt class="col-span-1">Name</dt>
                        <dd class="col-span-5">{{$user->name}}</dd>
                        <dt class="col-span-1">Email Address</dt>
                        <dd class="col-span-5">{{$user->email}}</dd>
                        <dt class="col-span-1">Added</dt>
                        <dd class="col-span-5">{{$user->created_at}}</dd>
                        <dt class="col-span-1">Last Logged In</dt>
                        <dd class="col-span-5">{{'-'}}</dd>
                        <dt class="col-span-1">Actions</dt>
                        <dd class="col-span-5">
                            <form
                                action="{{route('users.destroy', ['user'=>$user])}}"
                                method="post")>
                                @csrf
                                @method('delete')
                                <a href="{{route('users.edit', ['user'=>$user->id])}}"
                                   class="btn btn-sm btn-primary text-gray-50">Update</a>
                                <button onclick="return confirm('Are you sure you want to delete this user?')"
                                        class="btn btn-sm btn-secondary text-gray-50">Delete</button>
                                </a>
                            </form>
                        </dd>
                    </dl>
                </div>
                <p class="pt-6">
                    <a href="{{url('admin/users')}}"
                       class="btn btn-sm btn-accent">Back to Users</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
