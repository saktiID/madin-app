<div class="modal fade" id="{{ $modalId }}" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">

                {{ $slot }}

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Batalkan</button>
                <a href="{{ $modalUrl }}" type="submit" id="submitBtnModal" class="btn btn-{{ $classSubmit }}">{{ $modalSubmitText }}</a>
            </div>

        </div>
    </div>
</div>
