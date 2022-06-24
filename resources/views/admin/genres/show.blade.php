<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Genre Details')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <dl class="grid grid-cols-5 gap-2">
                        <dt class="col-span-1">ID</dt>
                        <dd class="col-span-5">{{$genre->id}}</dd>
                        <dt class="col-span-1">Name</dt>
                        <dd class="col-span-5">{{$genre->name}}</dd>
                        <dt class="col-span-1">Genre Icon</dt>
                        <dd class="col-span-5">{{$genre->picture}}</dd>
                        <dt class="col-span-1">Parent Genre ID</dt>
                        <dd class="col-span-5">{{$genre->parent_id}}</dd>
                        <?php $user = Auth()->user(); ?>
                        @if($user->hasRole(['admin', 'manager']))
                            <dt class="col-span-1">Actions</dt>
                            <dd class="col-span-5">


                                <form
                                    action="{{route('genres.destroy', ['genre'=>$genre])}}"
                                    method="post" )>
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('genres.edit', ['genre'=>$genre->id])}}"
                                       class="btn btn-sm btn-primary text-gray-50">Update</a>
                                    <button onclick="return confirm('Are you sure you want to delete this genre?')"
                                            class="btn btn-sm btn-secondary text-gray-50">Delete
                                    </button>
                                    </a>
                                </form>

                                @endif

                            </dd>
                    </dl>
                </div>
                <p class="pt-6">
                    <a href="{{url('admin/genres')}}"
                       class="btn btn-sm btn-accent">Back to Genres</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
