 @if ($adoptions->isEmpty())
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
                 <th>Pet</th>
                 <th>Current Owner</th>
                 <th>Previous Owner</th>
                 <th>Date Created</th>
                 <th>Date Completed</th>
                 <th>Payment</th>
                 <th>Status</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($adoptions as $item)
                 <tr class="clickable-row" onclick="window.location='{{ url('reports/adoptions/' . $item->adoptID) }}'"
                     title="View Adoption">

                     <td>{{ $item->adoptID }}</td>
                     <td>{{ $item->pet->petname }}</td>
                     <td>{{ $item->currentOwner->firstname }} {{ $item->currentOwner->lastname }}</td>
                     <td>{{ $item->previousOwner->firstname ?? 'No previous owner' }}
                         {{ $item->previousOwner->lastname ?? '' }}</td>
                     <td> {{ $item->created_at->format('Y-m-d') }}</td>
                     <td>{{ $item->adopt_date ?? 'pending' }}</td>
                     <td>{{ $item->adopt_payment }}</td>
                     <td>
                         @if ($item->adopt_status == 'Pending')
                             <h6 style="color: #fd7e14;">{{ $item->adopt_status }}</h6>
                         @elseif ($item->adopt_status == 'Completed')
                             <h6 class="text-success">{{ $item->adopt_status }}</h6>
                         @elseif ($item->adopt_status == 'Cancelled')
                             <h6 class="text-danger">{{ $item->adopt_status }}</h6>
                         @endif
                     </td>


                 </tr>
             @endforeach

         </tbody>
     </table>
     <div class="d-flex justify-content-center">
         {!! $adoptions->links() !!}
     </div>
 @endif
