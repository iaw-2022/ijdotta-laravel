<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="{{route('patients.index')}}">
        <i class="fas fa-user-injured"></i><span>Patients</span>
    </a>
    <a class="nav-link" href="{{route('doctors.index')}}">
        <i class="fas fa-user-md"></i><span>Doctors</span>
    </a>
    <a class="nav-link" href="{{route('appointments.index')}}">
        <i class="fas fa-calendar"></i><span>Appointments</span>
    </a>
</li>
