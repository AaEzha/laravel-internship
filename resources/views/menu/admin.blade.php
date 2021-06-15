<li class="nav-item {{ Nav::isRoute('member.index') }}">
    <a class="nav-link" href="{{ route('member.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Nav::isRoute('admin.perusahaan') }}">
    <a class="nav-link" href="{{ route('admin.perusahaan') }}">
        <i class="fas fa-fw fa-building"></i>
        <span>Perusahaan</span>
    </a>
</li>
