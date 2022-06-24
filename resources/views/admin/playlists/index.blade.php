<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Playlists')}}
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        @if(is_null($playlists))
            <h3>Error: You do not have permission to view Playlists</h3>
        @else
            <table class="table w-full table-zebra">
                <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Type</th>
                    <th></th>
                    <th class="flex justify-between">
                        <span class="pt-2">Actions</span>
                        <a href="{{route('playlists.create')}}"
                           class="btn btn-sm btn-primary text-gray-50">
                            Add Playlist
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($playlists as $key=>$playlist)
                    <tr class="hover">
                        <td class="small">{{ $key + 1 }}</td>
                        <td>{{$playlist->id }}</td>
                        <td>{{$playlist->name}}</td>
                        <td>{{$playlist->user->name}}</td>
                        <td>{{$playlist->type}}</td>
                        <td></td>
                        <td>
                            <a href="{{ url('admin/playlists/' . $playlist->id) }}"
                               class="btn btn-sm btn-primary text-gray-50">Details</a>
                            @if(  $user->hasRole(["admin"]) ||
                                    $user->id == $playlist->user->id ||
                                    $user->hasRole(["manager"]) && $playlist->type == 'Public')
                                <a href="{{ route('playlists.edit', $playlist->id) }}"
                                   class="btn btn-sm btn-secondary text-gray-50">Edit</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        {{$playlists->onEachSide(1)->links()}}
                    </td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</x-app-layout>
