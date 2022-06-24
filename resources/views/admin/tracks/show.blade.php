<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Track Details')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <dl class="grid grid-cols-5 gap-2">
                        <dt class="col-span-1">ID</dt>
                        <dd class="col-span-5">{{$track->id}}</dd>
                        <dt class="col-span-1">Name</dt>
                        <dd class="col-span-5">{{$track->name}}</dd>
                        <dt class="col-span-1">Artist</dt>
                        <dd class="col-span-5">{{$track->artist}}</dd>
                        <dt class="col-span-1">Genre</dt>
                        <dd class="col-span-5">{{$track->genre}}</dd>
                        <dt class="col-span-1">Album</dt>
                        <dd class="col-span-5">{{$track->album}}</dd>
                        <dt class="col-span-1">Year</dt>
                        <dd class="col-span-5">{{$track->year}}</dd>
                        <dt class="col-span-1">Length</dt>
                        <dd class="col-span-5">{{$track->length}}</dd>
                        <dt class="col-span-1">Track Number</dt>
                        <dd class="col-span-5">{{$track->track_number}}</dd>
                        <?php $user = auth()->user(); ?>
                        @if($user->hasRole(['admin', 'manager']))
                            <dt class="col-span-1">Actions</dt>
                            <dd class="col-span-5">
                                <form
                                    method="post" )>
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('tracks.edit', ['track'=>$track->id])}}"
                                       class="btn btn-sm btn-primary text-gray-50">Update</a>
                                    <button onclick="return confirm('Are you sure you want to delete this track?')"
                                            class="btn btn-sm btn-secondary text-gray-50">Delete
                                    </button>
                                    </a>
                                </form>
                            </dd>
                        @endif
                    </dl>
                </div>
                <p class="pt-6">
                    <a href="{{url('admin/tracks')}}"
                       class="btn btn-sm btn-accent">Back to Tracks</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
