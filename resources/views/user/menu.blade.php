<ul class="nav nav-cz">
    <li class="nav-item {{ request()->is('user/campaigns*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.campaigns.index') }}">
            Campaigns
        </a>
    </li>
    <li class="nav-item {{ request()->is('user/settings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.settings.edit') }}">
            Settings
        </a>
    </li>
</ul>
