<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Tracks')}}
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Length</th>
                <?php $user = auth()->user(); ?>
                @if($user->hasRole(['admin', 'manager']))
                    <th class="flex justify-between">
                        <span class="pt-2">Actions</span>
                        <a href="{{route('tracks.create')}}"
                           class="btn btn-sm btn-primary text-gray-50">
                            Add Track
                        </a>
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($tracks as $key=>$track)
                <tr class="hover">
                    <td class="small">{{ $key + 1 }}</td>
                    <td>{{$track->id }}</td>
                    <td>{{$track->name}}</td>
                    <td>{{$track->artist}}</td>
                    <td>{{$track->album}}</td>
                    <td>{{$track->genre}}</td>
                    <td>{{$track->length}}</td>
                    <td>
                        <a href="{{ url('admin/tracks/' . $track->id) }}"
                           class="btn btn-sm btn-primary text-gray-50">Details</a>
                        @if($user->hasRole(['admin', 'manager']))
                            <a href="{{ route('tracks.edit', $track->id) }}"
                               class="btn btn-sm btn-secondary text-gray-50">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">
                    {{$tracks->onEachSide(1)->links()}}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-app-layout>
