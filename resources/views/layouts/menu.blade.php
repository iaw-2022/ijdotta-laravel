<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    
    {{-- Admin links --}}
    <a class="nav-link btn" href="#">
        <span>Admin links</span>
    </a>
    <a class="nav-link" href="{{route('admin.patients.index')}}">
        <i class="fas fa-user-injured"></i><span>Patients</span>
    </a>
    <a class="nav-link" href="{{route('admin.doctors.index')}}">
        <i class="fas fa-user-md"></i><span>Doctors</span>
    </a>
    <a class="nav-link" href="{{route('admin.appointments.index')}}">
        <i class="fas fa-calendar"></i><span>Appointments</span>
    </a>
    <a class="nav-link" href="{{route('admin.users.index')}}">
        <i class="fas fa-users"></i><span>Users</span>
    </a>

    {{-- Doctor links --}}
    <a class="nav-link btn" href="#">
        <span>Doctor links</span>
    </a>
    <a class="nav-link" href="{{route('patients.index')}}">
        <i class="fas fa-user-injured"></i><span>Patients</span>
    </a>
    <a class="nav-link" href="{{route('appointments.index')}}">
        <i class="fas fa-calendar"></i><span>Appointments</span>
    </a>
    <a class="nav-link" href="{{route('appointmentspatterns.index')}}">
        <i class="fas fa-tools"></i><span>Appointments Patterns</span>
    </a>
</li>
