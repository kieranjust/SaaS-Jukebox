<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Edit Genre')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('genres.update', ['genre'=>$genre])}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-control">
                        <label class="label" for="name">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text"
                               name="name" id="name"
                               placeholder="name" class="input input-bordered"
                               value="{{old('name') ?? $genre->name }}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="picture">
                            <span class="label-text">Genre Icon</span>
                        </label>
                        <input type="text"
                               name="picture" id="picture"
                               placeholder="Genre Icon" class="input input-bordered"
                               value="{{old('picture') ?? $genre->picture}}">
                    </div>
                    <div class="form-control">
                        <span class="label-text">Parent Genre ID</span>
                        </label>
                        <select name="parent_id" id="parent_id"
                                class="select select-bordered w-full max-w-xs">
                            <option value="0">No Parent</option>
                            @foreach($all_genres as $key=>$value)
                                @if($value->id == $genre->parent_id && !is_null($genre->parent_id))
                                    <option selected value="{{$value->name}}"
                                @endif
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Update Genre
                        </button>
                        <a class="btn btn-sm btn-secondary text-gray-50"
                           href="{{route('genres.index')}}">
                            Back to Genres
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
