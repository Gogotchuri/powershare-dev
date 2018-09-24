<h2>Campaign</h2>

<div>
    <img class="campaign-image" src="{{asset($campaign->featured_image->url)}}"/>
</div>
<p>{{$campaign->details}}</p>

<a class="btn btn-dark" href="{{route($edit_route_name, [$campaign->id])}}">Edit</a>

{{--<form method="post" action="{{action('CampaignController@store')}}">

    @csrf

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true
    ])

    @include('components.form.input', [
        'type' => 'image',
        'name' => 'Featured Image'
    ])

    @include('components.form.input', [
        'name' => 'Video'
    ])

    --}}{{-- TODO: make this multi selection 1 to 20 --}}{{--
    @include('components.form.select', [
        'name' => 'Image',
        //'required' => true,
        'options' => [],
        'title' => 'name',
    ])

    <button type="submit" class="btn btn-primary">
        Submit
    </button>--}}

{{-- TODO: Add remaining fields --}}

</form>
