<table class="table datatables" style="width: 100%;">
    <thead>
    <tr>
        <th scope="col">#s</th>
        <th scope="col">Name</th>
        <th scope="col">Details</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($campaigns as $campaign)
        <tr class="clickable" onclick="location.href = '{{ route($row_route_name, ['id' => $campaign->id]) }}'">
            <td scope="row"> {{$campaign->id}}</td>
            <td>{{'Sample Name'}}</td>
            <td>{{mb_strimwidth($campaign->details, 0, 10, "...")}}</td>
            <td>
                <span class="badge badge-pill badge-{{$campaign->is_approved ? 'success' : 'secondary'}}">{{$campaign->status_name}}</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
