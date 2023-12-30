    @if ($petshooter->isEmpty())
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

                @foreach ($petshooter as $item)
                    <tr class="clickable-row"
                        onclick="window.location='{{ url('manageAccounts/petshooters/' . $item->userID) }}'"
                        title="View Petshooter">

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

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $petshooter->links() !!}
        </div>

    @endif
