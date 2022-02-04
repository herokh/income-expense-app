<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('create-income') }}" class="nav-link {{ (request()->segment(1) == 'income') ? 'active' : '' }}">
        <i class="nav-icon fas fa-coins"></i>
        <p>Income</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('create-expense') }}" class="nav-link {{ (request()->segment(1) == 'expense') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>Expense</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('settings') }}" class="nav-link {{ (request()->segment(1) == 'settings') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>Settings</p>
    </a>
</li>

