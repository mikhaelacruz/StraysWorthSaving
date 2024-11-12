<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adopt a Loving Stray
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($userIsAdmin == 1)
                <a href="{{ route(name: 'addstray')  }}" class="btn btn-primary btn-lg active" role="button"
                    aria-pressed="true">Add a Stray</a>
                <br>
                <br>
            @endif

            <div class="card-group gap-3 flex-wrap">
                @foreach ($strays as $stray)

                    <div class="card" style="min-width: 21rem; max-width: 24rem; padding: 1rem;">
                        <img class="card-img-top" src='{{$stray->photo_url}}' alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $stray->name }}</h5>
                            <p class="card-text">{{ $stray->description }}</p>
                        </div>

                        @if ($userIsAdmin == 1)
                            <a href="{{ route('editstray', ['strayId' => $stray->id]) }}" class="btn btn-primary btn-lg active"
                                role="button" aria-pressed="true">Edit</a>
                            <br>
                            <form id="delete-form" action="{{ route('adopt.destroy', $stray->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button type="button"
                                onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                class="btn btn-danger btn-lg active">
                                DELETE
                            </button>
                            <br>
                        @endif

                        @if ($userIsAdmin == 0)
                            <a href="{{ route('adoptionrequest', ['strayId' => $stray->id]) }}"
                                class="btn btn-success btn-lg active" role="button" aria-pressed="true">Adopt</a>
                        @endif
                    </div>

                @endforeach
            </div>
            <br>

            {{$strays->links()}}
        </div>
</x-app-layout>