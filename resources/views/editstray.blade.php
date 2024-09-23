<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit A Loving Stray Record
    </h2>
  </x-slot>

  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
      <br>
    @endif

      <form action="{{ route('editstray.update', $stray->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $stray->id }}">

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Stray Name"
            value="{{ old('name', $stray->name) }}" required>
        </div>
        <br>
        <div class="form-group">
          <label for="description">Description of Stray</label>
          <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description"
            value="{{ old('description', $stray->description) }}" required>
        </div>
        <br>

        <div class="form-group">
          <label for="photo_url">Url of Stray Photo</label>
          <input type="text" class="form-control" id="photo_url" name="photo_url" placeholder="Enter Url"
            value="{{ old('photo_url', $stray->photo_url) }}" required>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <br>



      @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
      </div>
    @endif


    </div>
  </div>
</x-app-layout>