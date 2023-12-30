 @if ($agreements->isEmpty())
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
                 <th>Recipient</th>
                 <th>Requester</th>
                 <th>Date</th>
                 <th>Payment</th>
                 <th>Status</th>
             </tr>
         </thead>
         <tbody>
             {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}
             @foreach ($agreements as $item)
                 <tr class="clickable-row"
                     onclick="window.location='{{ url('reports/agreements/' . $item->agreementID) }}'"
                     title="View Agreement">

                     <td>{{ $item->agreementID }}</td>
                     <td>{{ $item->recipient->firstname }} {{ $item->recipient->lastname }}</td>
                     <td>{{ $item->requester->firstname }} {{ $item->requester->lastname }}</td>
                     <td>{{ $item->agreement_date }}</td>
                     <td>{{ $item->agreement_payment }}</td>
                     <td>
                         @if ($item->agreement_status == 'Pending')
                             <h6 style="color: #fd7e14;">{{ $item->agreement_status }}</h6>
                         @elseif ($item->agreement_status == 'Completed')
                             <h6 class="text-success">{{ $item->agreement_status }}</h6>
                         @elseif ($item->agreement_status == 'Cancelled')
                             <h6 class="text-danger">{{ $item->agreement_status }}</h6>
                         @endif
                     </td>
                     {{-- <td>
                       //<a href="{{ url('/adoption/'.$item->id) }}"></a>
                        <a href="{{ url('/adoptions/' . $item->id) }}" title="View Adoptions"><button
                                class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/adoptions/' . $item->id . '/edit') }}" title="Edit Student"><button
                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</button></a>

                        <form method="POST" action="{{ url('/adoptions' . '/' . $item->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Student"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        </td> --}}

                 </tr>
             @endforeach
             {{-- @empty
                                <tr>There is no data in table</tr>
                            @endforelse --}}
         </tbody>
     </table>
     <div class="d-flex justify-content-center">
         {!! $agreements->links() !!}
     </div>
 @endif
