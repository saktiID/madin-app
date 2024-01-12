<div class="text-center">
    <div class="btn-group" role="group">
        <a href="{{ route($route, $id) }}" type="button" class="btn btn-success btn-sm py-1 px-3" title="Detail">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
        <a href="{{ route($route_emis, $id) }}" type="button" class="btn btn-info btn-sm py-1 px-3" title="Emis">
            <svg viewBox="0 0 24 24" style="width: 15px" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
        </a>
        <a href="#" data-nama="{{ $nama }}" data-id="{{ $id }}" type="button" class="btn btn-danger btn-sm py-1 px-3 hapus-data" title="Hapus">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
        </a>
    </div>
</div>
