 @if ($bookings->isEmpty())
     {{-- <div style="height: 100%;width: 100%">
            <h5 class="text-center" style="font-weight: bold;">
                NOTHING TO SHOW
            </h5>
        </div> --}}
     <div class="d-flex justify-content-center">
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
                 <th>Pet Shooter</th>
                 <th>Booking Date</th>
                 <th>Payment</th>
                 <th>Status</th>
             </tr>
         </thead>
         <tbody>
             {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}
             @foreach ($bookings as $item)
                 <tr class="clickable-row" onclick="window.location='{{ url('reports/bookings/' . $item->bookID) }}'"
                     title="View Booking">

                     <td>{{ $item->bookID }}</td>
                     <td>{{ $item->petshooter->firstname ?? 'null name' }}
                         {{ $item->petshooter->lastname ?? 'null lastname' }}</td>


                     <td>{{ $item->booking_date }} {{ $item->booking_time }}</td>
                     <td>{{ $item->booking_payment }}</td>
                     <td>
                         @if ($item->booking_status == 'Pending')
                             <h6 style="color: #fd7e14;">{{ $item->booking_status }}</h6>
                         @elseif ($item->booking_status == 'Completed')
                             <h6 class="text-success">{{ $item->booking_status }}</h6>
                         @elseif ($item->booking_status == 'Cancelled')
                             <h6 class="text-danger">{{ $item->booking_status }}</h6>
                         @endif
                     </td>

                 </tr>
             @endforeach
             {{-- @empty
                                <tr>There is no data in table</tr>
                            @endforelse --}}
         </tbody>
     </table>
     <div class="d-flex justify-content-center">
         {!! $bookings->links() !!}
     </div>
 @endif
