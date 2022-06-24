<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

<div class="overflow-x-auto">
    <table class="table w-full table-zebra">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Logged In</th>
            <th class="flex justify-between">
                <?php $auth = Auth()->user(); ?>
                @if($auth->hasRole(["admin", "manager"]))
                    <span class="pt-2">Actions</span>
                    <a href="{{route('users.create')}}"
                       class=" btn btn-sm btn-primary text-gray-50">
                        Add User
                    </a>
                @endif
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="hover">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td> - </td>
                <td>
                    <a href="{{route('users.show' , $user->id)}}"
                       class="btn btn-sm btn-primary text-gray-50">Details</a>
                    </a>
                    <a href="{{route('users.edit', $user->id)}}"
                       class="btn btn-sm btn-secondary text-gray-50">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">
                {{$users->onEachSide(1)->links()}}
            </td>
        </tr>
        </tfoot>
    </table>
</div>
</x-app-layout>
