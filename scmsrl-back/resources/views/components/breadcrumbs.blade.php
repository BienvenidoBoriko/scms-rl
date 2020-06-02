<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">{{ $title }}</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item {{ $i===count(Request::segments())?'active':'' }}">
                                <a
                                    href="{{ URL::to( implode( '', array_slice(Request::segments(), 0 ,$i, true))) }}">
                                    {{ strtolower(Request::segment($i)) }}
                                </a>
                            </li>
                        @endfor
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
