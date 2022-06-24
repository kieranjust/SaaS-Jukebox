<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Edit Playlist')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('playlists.update', ['playlist'=>$playlist])}}" method="post">
                    @csrf
                    @method('patch')
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
                        <label class="label" for="name">
                            <span class="label-text">Playlist Name</span>
                        </label>
                        <input type="text"
                               name="name" id="name"
                               placeholder="Playlist Name" class="input input-bordered"
                               value="{{old('name') ?? $playlist->name}}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="owner">
                            <span class="label-text">Playlist Owner</span>
                        </label>
                        <select name="owner" id="owner"
                                class="select select-bordered w-full max-w-xs">
                            <option value="0">No Owner</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                    @if($user->id == $playlist->user_id) selected @endif
                                >{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label" for="type">
                            <span class="label-text">Type</span>
                        </label>
                        <select name="type" id="type"
                                class="select select-bordered w-full max-w-xs">
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Track Name</th>
                                <th>Track Artist</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tracks as $key=>$track)

                                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                    <td>
                                        <div class="ml-5">
                                            <div class="bg-gray-200 rounded-sm w-5 h-5 flex flex-shrink-0 justify-center items-center relative">

                                                <input type="checkbox" name="tracks[]" value="{{$track->id}}" placeholder="checkbox"
                                                       @if($playlist->tracks->contains('id', $track->id)) checked="checked" @endif
                                                       class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                <div class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                    <svg class="icon icon-tabler icon-tabler-check" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                                        <path d="M5 12l5 5l10 -10"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                {{$track->name}}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                                {{$track->artist}}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <style>
                                .checkbox:checked + .check-icon {
                                    display: flex;
                                }
                            </style>
                            </tbody>
                        </table>
                    </div>
                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Update Playlist
                        </button>
                        <a class="btn btn-sm btn-secondarys text-gray-50"
                           href="{{route('playlists.index')}}">
                            Back to Playlists
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
