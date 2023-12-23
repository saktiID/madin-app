<div class="text-center">
    <div class="btn-group" role="group">
        <a href="{{ route('profile-asatidz', $user_id) }}" type="button" class="btn btn-success btn-sm py-1 px-3" title="Detail">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
        <a href="#" data-nama="{{ $nama }}" data-id="{{ $user_id }}" type="button" class="btn btn-danger btn-sm py-1 px-3 hapus-asatidz" title="Hapus">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
        </a>
    </div>
</div>
