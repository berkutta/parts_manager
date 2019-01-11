<div class="col-md-3">
    <div class="card sidebar">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav nav-pills flex-column" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{{ (Request::is('components') ? 'active' : '') }}}" href="{{ url('/components') }}">
                        Components
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{{ (Request::is('storages') ? 'active' : '') }}}" href="{{ url('/storages') }}">
                        Storages
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>