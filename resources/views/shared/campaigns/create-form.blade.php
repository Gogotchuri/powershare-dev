@include('components.form.image-upload')

@push('scripts-stack')
    <script>
        var campaignId = {!! $campaign->id !!};
    </script>
@endpush
