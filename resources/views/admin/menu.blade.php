<ul class="nav nav-cz">
    <li class="nav-item {{ request()->is('admin/campaigns*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.campaigns.index') }}">
            Campaigns
        </a>
    </li>
    <li class="nav-item {{ request()->is('admin/comments*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.comments.index') }}">
            Comments
        </a>
    </li>
    <li class="nav-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.settings.edit') }}">
            Settings
        </a>
    </li>
</ul>
