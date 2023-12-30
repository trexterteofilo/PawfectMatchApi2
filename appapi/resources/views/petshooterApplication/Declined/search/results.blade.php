    @if ($petshooterapp->isEmpty())
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
                    <th>Age</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}

                @foreach ($petshooterapp as $item)
                    <tr class="clickable-row"
                        onclick="window.location='{{ url('manageAccounts/petshooters/' . $item->petshooter->userID) }}'"
                        title="View Petshooter">

                        <td>{{ $item->petshooterAppID }}</td>
                        <td>{{ $item->petshooter->firstname ?? 'null name' }}
                            {{ $item->petshooter->lastname ?? 'null lastname' }}</td>


                        <td>{{ $item->petshooter->email }}</td>
                        <td>{{ $item->petshooter->address }}</td>
                        <td>{{ $item->petshooter->age }}</td>
                        <td>
                            @if ($item->verification_status == 'Pending')
                                <h6 style="color: #fd7e14;">{{ $item->verification_status }}</h6>
                            @elseif ($item->verification_status == 'Declined')
                                <h6 class="text-danger">{{ $item->verification_status }}</h6>
                            @endif

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $petshooterapp->links() !!}
        </div>

    @endif
