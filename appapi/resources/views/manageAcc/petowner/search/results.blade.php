@if ($owners->isEmpty())
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
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact #</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}
            @foreach ($owners as $item)
                <tr class="clickable-row"
                    onclick="window.location='{{ url('manageAccounts/petowners/' . $item->userID) }}'" title="View Owner">

                    <td>{{ $item->userID }}</td>
                    <td>{{ $item->firstname ?? 'null name' }}
                        {{ $item->lastname ?? 'null lastname' }}</td>


                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->contactnumber }}</td>
                    <td>
                        @if ($item->accountstatus == 'Active')
                            <h6 class="text-success">{{ $item->accountstatus }}</h6>
                        @elseif ($item->accountstatus == 'Deactivated')
                            <h6 class="text-danger">{{ $item->accountstatus }}</h6>
                        @endif
                        {{-- @if ($item->accountstatus == 'Active')
                                            <a href="javascript:void(0)" id="showDeactModal"
                                                data-url="{{ route('findOwnerId', $item->id) }}"
                                                class="btn btn-danger btn-sm" title="Deactivate User">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                                Deactivate
                                            </a>
                                            {{-- <a href="javascript:void(0)" id="showDeactModal"
                                            data-url="{{ route('findOwnerId', $item->id) }}"
                                            class="btn btn-danger btn-sm showDeactModal" title="Deactivate User">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Deactivate
                                        </a> --}}
                        {{-- @elseif ($item->accountstatus == 'Deactivated')
                                        <a href="javascript:void(0)" id="showActivateModal"
                                            data-url="{{ url('/manageAccounts/' . $item->accounttype . '/active/' . $item->id) }}"
                                            class="btn btn-success btn-sm" title="Edit Benefit">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                            Activate
                                        </a> --}}
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
            {{-- @empty
                                <tr>There is no data in table</tr>
                            @endforelse --}}
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $owners->links() !!}
    </div>
@endif
