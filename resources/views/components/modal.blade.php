<div class="modal fade" tabindex="-1" role="dialog" id="{{ $id }}" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $action }}" method="POST" class="ajax-form">
                @csrf
                @isset($method)
                    {{ $method }}
                @endisset
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $body }}
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{ $footer }}
                </div>
            </form>
        </div>
    </div>
</div>
