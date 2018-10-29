@if(count($campaigns) > 0)
    <table class="table datatables" style="width: 100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Details</th>
            <th scope="col">Author</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campaigns as $campaign)
            <tr class="clickable" onclick="location.href = '{{ route($row_route_name, ['id' => $campaign->id]) }}'">
                <td scope="row"> {{$campaign->id}}</td>
                <td>{{$campaign->name}}</td>
                <td>{{mb_strimwidth($campaign->details, 0, 150, "...")}}</td>
                <td>{{$campaign->author_name}}</td>
                <td>
                    <span
                        class="badge badge-pill badge-{{$campaign->is_approved ? 'success' : 'secondary'}}">{{$campaign->status_name}}</span>
                </td>
                <td>
                    @if($campaign->is_draft && $row_route_name != $continue_route_name)
                        <a href="{{ route($continue_route_name, ['id' => $campaign->id]) }}"
                           class="btn btn-primary btn-sm">
                            Continue
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-info" role="alert">
        There are no campaigns yet <a href="{{$create_route}}"><strong>click here to create new</strong></a>
    </div>
@endif
