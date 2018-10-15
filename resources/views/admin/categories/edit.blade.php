@extends('admin.main')

@section('header')
    Edit <a href="#">{{$category->name}}</a> Category
    @endsection

@section('buttons')
    {{--TODO: ... --}}
@endsection

@section('body')
    <form method="post" action="{{route('admin.categories.update', ['id' => $category->id])}}" enctype="multipart/form-data">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @method('PUT')

        @csrf

        @include('components.form.input', [
            'name' => 'Name',
            'required' => true,
            'value' => $category->name
        ])

            <div class="row">
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            Category icon
                        </div>
                        <div class="card-body">
                            <img id="icon" src="data:image/png;base64,{{base64_encode($category->icon)}}" class="w-100 mb-3"/>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="icon" class="custom-file-input" id="icon-input" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <button type="submit" class="btn btn-secondary">
            Edit
        </button>
    </form>
@endsection

@push('scripts-stack')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#icon').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#icon-input").change(function() {
            $("#icon").show();
            readURL(this);
        });
    </script>
@endpush
