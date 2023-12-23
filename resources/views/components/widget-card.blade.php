<div class="col-lg-{{ $col }} col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-one_hybrid {{ $theme }}">
        <div class="widget-heading">
            <div class="w-title d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <div class="w-icon">
                        <i data-feather="{{ $icon }}"></i>
                    </div>
                    <div class="">
                        <p class="w-value">{{ $title }}</p>
                        <h5 class="">{{ $subtitle }}</h5>
                    </div>
                </div>
                <div class="widget-content">
                    @if(Auth::user()->role == "Administrator")
                    <a href="{{ $url }}" class="btn btn-outline-primary">Lihat detail</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
