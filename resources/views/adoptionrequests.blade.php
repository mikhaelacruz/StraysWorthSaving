<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Adopt Requests
    </h2>
  </x-slot>

  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Pet To Adopt</th>
            <th scope="col">Adopter</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Email</th>
            <th scope="col">Location</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($requests as $request)



        <tr>
        <th scope="row">{{ $request->id }}</th>
        <td>{{ $request->strayname }}</td>
        <td>{{ $request->adoptername }}</td>
        <td>{{ $request->contact_number }}</td>
        <td>{{ $request->email}}</td>
        <td>{{ $request->location }}</td>
        </tr>

      @endforeach


        </tbody>

        {{$requests->links()}}
      </table>


      <br>



    </div>
  </div>
</x-app-layout>