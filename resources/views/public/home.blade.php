@extends('layouts.app')

@section('skeleton')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <div class="container">
        <form class="form-inline">
            <div class="form-group mb-2">
                <label for="staticEmail2" class="sr-only">Email</label>
                <input class="form-control" type="text" placeholder="Search" id="staticEmail2">
            </div>
        </form>
    </div>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="card-columns">
                    @foreach($campaigns as $campaign)
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('public.campaign.show', ['id' => $campaign->id]) }}">{{$campaign->name}}</a>
                                <br/>
                                <br/>
                                <img class="img-fluid" src="{{$campaign->featured_image_url}}">
                            </div>
                            <div class="card-body">
                                {{-- FIXME: This width function can break html comming from WYSIWYG --}}
                                <p>{!! mb_strimwidth($campaign->details, 0, 100, "...") !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-stack')

@endpush
