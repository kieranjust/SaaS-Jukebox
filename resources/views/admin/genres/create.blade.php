<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Add Genre')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('genres.store')}}" method="post">
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
                            <span class="label-text">Genre Name</span>
                        </label>
                        <input type="text"
                               name="name" id="name"
                               placeholder="name" class="input input-bordered"
                               value="{{old('name')}}">
                    </div>
                    <div class="form-control">
                        <label class="label" for="picture">
                            <span class="label-text">Genre Icon</span>
                        </label>
                        <input type="text"
                               name="picture" id="picture"
                               placeholder="Genre Icon" class="input input-bordered"
                               value="{{old('picture')}}">
                    </div>
                    <select name="parent_id" id="parent_id"
                            class="select select-bordered w-full max-w-xs">
                        <option value="0">No Parent</option>
                        @foreach($genres as $key=>$value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    <div class="py-6">
                        <button class="btn btn-sm btn-primary text-gray-50"
                                type="submit">Save New Genre
                        </button>
                        <a class="btn btn-sm btn-secondarys text-gray-50"
                           href="{{route('genres.index')}}">
                            Back to Genres
                        </a>
                        <button class="btn btn-sm btn-accent" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
