@if($label == 'edit')
    <span>
        <a href="javascript:" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-info edit-btn"
            data-get="{{ $get }}" data-patch="{{ $patch }}"
            data-target="{{ $target }}"
            onclick="{{ $click ?? '' }}">
            <i class="fas fa-edit"></i>
        </a>
    </span>
@elseif ($label == 'delete')
    <span>
        <a href="javascript:" data-toggle="tooltip" data-original-title="Delete" class="btn btn-icon btn-danger delete-confirm-btn"
        data-action="{{ $action }}" data-target="{{ $target }}">
        <i class="fas fa-trash"></i>
        </a>
    </span>
@endif
