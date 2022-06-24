<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Add Track')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('tracks.store')}}" method="post">
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
                        <label class="label" for="name">
                            <span class="label-text">Track Name</span>
                        </label>
                        <input type="text"
                               name="name" id="name"
                               placeholder="Track Name" class="input input-bordered"
                               value="{{old('name')}}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="artist">
                            <span class="label-text">Artist Name</span>
                        </label>
                        <input type="text"
                               name="artist" id="artist"
                               placeholder="Artist Name" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label" for="genre">
                            <span class="label-text">Genre</span>
                        </label>
                        <select name="genre" id="genre"
                                class="select select-bordered w-full max-w-xs">
                            <option value="0">No Genre</option>
                            @foreach($genres as $key=>$genre)
                                <option value="{{$genre->name}}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label" for="album">
                            <span class="label-text">Album Name</span>
                        </label>
                        <input type="text"
                               name="album" id="album"
                               placeholder="Album Name" class="input input-bordered"
                               value="{{old('album')}}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="track_number">
                            <span class="label-text">Track Number</span>
                        </label>
                        <input type="number"
                               name="track_number" id="track_number"
                               placeholder="Album Name" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label" for="length">
                            <span class="label-text">Track Length</span>
                        </label>
                        <input type="text"
                               name="length" id="length"
                               placeholder="Track Length" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label" for="year">
                            <span class="label-text">Track Year</span>
                        </label>
                        <input type="number"
                               name="year" id="year"
                               placeholder="Track Year" class="input input-bordered">
                    </div>
                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Save New Track
                        </button>
                        <a class="btn btn-sm btn-secondarys text-gray-50"
                           href="{{route('tracks.index')}}">
                            Back to Tracks
                        </a>
                        <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
