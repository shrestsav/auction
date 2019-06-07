@push('modals')
<div class="modal fade modal__custom @if(isset($modalCustomClass)) {{ $modalCustomClass }} @endif" id="{{ $modalId }}" role="dialog" aria-labelledby="{{ $modalId }}" aria-hidden="true" data-backdrop="true" data-keyboard="false" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered {{$modalSize}}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title">{{ $modalTitle }}</h2>
                   
                </div>
                @include('backend.modals.includes.' . $modalFile)
            </div>
        </div>
    </div>
@endpush
