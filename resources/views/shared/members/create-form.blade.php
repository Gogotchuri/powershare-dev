

<button type="submit" class="btn btn-secondary">
    Continue
</button>

@push('scripts-stack')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#featured-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image-input").change(function () {
            $("#featured-image").show();
            readURL(this);
        });
    </script>
@endpush
