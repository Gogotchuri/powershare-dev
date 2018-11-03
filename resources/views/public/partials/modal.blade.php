<div @if(isset($id)) id="{{$id}}" @endif class="modal fade powershare-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body">
                @yield('modal-body')
            </div>
        </div>
    </div>
</div>
