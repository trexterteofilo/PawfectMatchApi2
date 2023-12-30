 @if (session('type') == 'Cat Pets')
     <h3 style="color: white; font-weight: bold;">Cat Pets</h3>
 @elseif (session('type') == 'Dog Pets')
     <h3 style="color: white; font-weight: bold;">Dog Pets</h3>
 @elseif (session('type') == 'Rabbit Pets')
     <h3 style="color: white; font-weight: bold;">Rabbit Pets</h3>
 @elseif (session('type') == 'Hamster Pets')
     <h3 style="color: white; font-weight: bold;">Hamster Pets</h3>
 @elseif (session('type') == 'Bird Pets')
     <h3 style="color: white; font-weight: bold;">Bird Pets</h3>
 @endif


 @if ($pets->isEmpty())
     {{-- <div style="height: 100%;width: 100%">
            <h5 class="text-center" style="font-weight: bold;">
                NOTHING TO SHOW
            </h5>
        </div> --}}
     <div class="d-flex justify-content-center" style="padding-top: 100px">
         <tr>
             <h6 class="text-center">
                 Nothing to Show
             </h6>
         </tr>
     </div>
 @else
     <table class="table table-hover">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Name</th>
                 <th>Type</th>
                 <th>Breed</th>
                 <th>Gender</th>
                 {{-- <th>Status</th> --}}
             </tr>
         </thead>
         <tbody>
             {{-- @forelse ($pet->chunk(10) as $item) --}}
             @foreach ($pets as $item)
                 <tr class="clickable-row" onclick="window.location='{{ url('manageAccounts/pets/' . $item->petID) }}'"
                     title="View Pets">

                     <td>{{ $item->petID }}</td>
                     <td>{{ $item->petname ?? 'null name' }}</td>


                     <td>{{ $item->pettype }}</td>
                     <td>{{ $item->petbreed }}</td>
                     {{-- must change to  petstatus --}}
                     <td>{{ $item->petgender }}</td>
                     {{-- <td>
                         @if ($item->petstatus == 'Active')
                             <h6 class="text-success">{{ $item->petstatus }}</h6>
                         @elseif ($item->petstatus == 'Deactivated')
                             <h6 class="text-danger">{{ $item->petstatus }}</h6>
                         @endif
                     </td> --}}
                 </tr>
             @endforeach
             {{-- @empty
             <tr>There is no data in table</tr>
         @endforelse --}}
         </tbody>
     </table>
     <div class="d-flex justify-content-center">
         {!! $pets->links() !!}
     </div>
 @endif
