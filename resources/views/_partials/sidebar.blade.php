<div class="sidebar position-relative">
    <div class="brand-container text-center">
    <a class="brand text-white align-items-center text-decoration-none" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    </div>
    <div class="sidebar-user-container border-bottom">
    <div class="sidebar-logo-container float-left">
        @if(Auth::user()->logo != null)
            <img src="{{asset('/images/'.Auth::user()->id.Auth::user()->logo.'')}}" class="sidebar-logo d-block ui-w-30 bg-white rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
        @else
            <img src="{{asset('/images/blank_profile_picture.png')}}" class="sidebar-logo d-block ui-w-30 bg-white rounded-circle" alt="">
        @endif
    </div>
    <div class="user-info">
        <span class="text-secondary">
            Welcome,<br>
        </span>
        <h5 class="text-white">
            {{Auth::user()->name}}
        </h5>
    </div>
    </div>
    <div class="row m-0 px-3 py-2 sidebar-link">
        <a href="/dashboard" class="sidebar-link-item text-white text-decoration-none">
            Dashboard
        </a>
    </div>
    <div class="row m-0 px-3 py-2 sidebar-link">
        <a href="/clients" class="sidebar-link-item text-white text-decoration-none">
            Clients
        </a>
    </div>
    <div class="row m-0 px-3 py-2 sidebar-link">
        <a href="company/estimates" class="sidebar-link-item text-white text-decoration-none">
            Estimates
        </a>
    </div>
    <div class="row m-0 px-3 py-2 sidebar-link">
        <a href="/Invoices" class="sidebar-link-item text-white text-decoration-none">
            Invoices
        </a>
    </div>
</div>
