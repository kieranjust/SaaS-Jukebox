<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Genres')}}
        </h2>
    </x-slot>

    <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
            <?php $user = Auth()->user(); ?>
            <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Picture</th>
                <th>Parent Genre ID</th>
                <th></th>
                <th class="flex justify-between">
                    @if($user->hasRole(['admin', 'manager']))
                        <span class="pt-2">Actions</span>
                        <a href="{{route('genres.create')}}"
                           class="btn btn-sm btn-primary text-gray-50">
                            Add Genre
                        </a>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($genres as $key=>$genre)
                <tr class="hover">
                    <td class="small">{{ $key + 1 }}</td>
                    <td>{{$genre->id }}</td>
                    <td>{{$genre->name}}</td>
                    <td>{{$genre->picture}}</td>
                    <td>{{$genre->parent_id}}</td>
                    <td>-</td>
                    <td>
                        <a href="{{ url('admin/genres/' . $genre->id) }}"
                           class="btn btn-sm btn-primary text-gray-50">Details</a>

                        @if($user->hasRole(["admin", "manager"]))
                            <a href="{{ route('genres.edit', $genre->id) }}"
                               class="btn btn-sm btn-secondary text-gray-50">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">
                    {{$genres->onEachSide(1)->links()}}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-app-layout>
