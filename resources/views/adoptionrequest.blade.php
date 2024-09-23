<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Adopt a Loving Stray
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
      <form action="{{ route('adoptionrequest.store') }}" method="POST">
        @csrf
        <input type="hidden" name="stray_id" value="{{ $strayId }}">

        <h3>

          <small class="text-muted"> You are adopting</small>
          {{$name}}
        </h3>

        <br>

        <div class="form-group">
          <label for="user_id">User</label>
          <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter User Id" required>
        </div>
        <br>


        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
        </div>
        <br>

        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
            placeholder="Enter email" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <br>

        <div class="form-group">
          <label for="contact_number">Contact Number</label>
          <input type="text" class="form-control" id="contact_number" name="contact_number"
            placeholder="Enter Contact Number" required>
        </div>
        <br>

        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
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