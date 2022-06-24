<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Edit Tracks')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if ($errors->any())
                    <div class="bg-red-300 border border-red-800 text-black rounded p-2 ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('tracks.update', ['track'=>$track])}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-control">
                        <label class="label" for="name">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text"
                               name="name" id="name"
                               placeholder="name" class="input input-bordered"
                               value="{{old('name') ?? $track->name }}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="artist">
                            <span class="label-text">Artist Name</span>
                        </label>
                        <input type="text"
                               name="artist" id="artist"
                               placeholder="Track Artist" class="input input-bordered"
                               value="{{old('artist') ?? $track->artist}}">
                    </div>
                    <div class="form-control">
                        <span class="label-text">Genre</span>
                        </label>
                        <select name="genre" id="genre"
                                class="select select-bordered w-full max-w-xs">
                            <option value="0">No Genre</option>
                            @foreach($genres as $key=>$value)
                                <option value="{{$value->name}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label" for="track_number">
                            <span class="label-text">Track Number</span>
                        </label>
                        <input type="text"
                               name="track_number" id="track_number"
                               placeholder="track number" class="input input-bordered"
                               value="{{old('track_number') ?? $track->track_number}}">
                    </div>

                    <div class="form-control">
                        <label class="label" for="album">
                            <span class="label-text">Album Name</span>
                        </label>
                        <input type="text"
                               name="album" id="album"
                               placeholder="album" class="input input-bordered"
                               value="{{old('album') ?? $track->album}}">
                    </div>

                    <div class="form-control">
                        <label class="label" for="year">
                            <span class="label-text">Year</span>
                        </label>
                        <input type="text"
                               name="year" id="year"
                               placeholder="year" class="input input-bordered"
                               value="{{old('year') ?? $track->year}}">
                    </div>

                    <div class="form-control">
                        <label class="length" for="length">
                            <span class="label-text">Length</span>
                        </label>
                        <input type="text"
                               name="length" id="length"
                               placeholder="length" class="input input-bordered"
                               value="{{old('length') ?? $track->length}}">
                    </div>

                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Update Track
                        </button>
                        <a class="btn btn-sm btn-secondary text-gray-50"
                           href="{{route('tracks.index')}}">
                            Back to Tracks
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
