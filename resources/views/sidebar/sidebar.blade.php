<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu
                {{set_active(['list/admin'])}}
                ">
                    <a href="#"><i class="feather-grid"></i>
                        <span> Quản lý tài khoản</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="
                        {{ route('list/admin') }}" class="{{set_active(['list/admin'])}} ">Tài khoản Admin</a></li>
                        <li><a href="#
{{--                        {{ route('teacher/dashboard') }}" class="{{set_active(['teacher/dashboard'])}}--}}
                        ">Tài khoản Gia sư</a></li>
                        <li><a href="#
{{--                        {{ route('student/dashboard') }}" class="{{set_active(['student/dashboard'])}}--}}
                        ">Tài khoản Phụ huynh</a></li>
                    </ul>
                </li>
{{--                @if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')--}}
{{--                    <li class="submenu {{set_active(['list/users'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">--}}
{{--                        <a href="#"><i class="fas fa-shield-alt"></i>--}}
{{--                            <span>User Management</span>--}}
{{--                            <span class="menu-arrow"></span>--}}
{{--                        </a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="{{ route('list/users') }}" class="{{set_active(['list/users'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">List Users</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}

{{--                <li class="submenu {{set_active(['student/list','student/grid','student/add/page'])}} {{ (request()->is('student/edit/*')) ? 'active' : '' }} {{ (request()->is('student/profile/*')) ? 'active' : '' }}">--}}
{{--                    <a href="#"><i class="fas fa-graduation-cap"></i>--}}
{{--                        <span> Students</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{ route('student/list') }}"  class="{{set_active(['student/list','student/grid'])}}">Student List</a></li>--}}
{{--                        <li><a href="{{ route('student/add/page') }}" class="{{set_active(['student/add/page'])}}">Student Add</a></li>--}}
{{--                        <li><a class="{{ (request()->is('student/edit/*')) ? 'active' : '' }}">Student Edit</a></li>--}}
{{--                        <li><a href=""  class="{{ (request()->is('student/profile/*')) ? 'active' : '' }}">Student View</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="submenu  {{set_active(['teacher/add/page','teacher/list/page','teacher/grid/page','teacher/edit'])}} {{ (request()->is('teacher/edit/*')) ? 'active' : '' }}">--}}
{{--                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>--}}
{{--                        <span> Teachers</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{ route('teacher/list/page') }}" class="{{set_active(['teacher/list/page','teacher/grid/page'])}}">Teacher List</a></li>--}}
{{--                        <li><a href="teacher-details.html">Teacher View</a></li>--}}
{{--                        <li><a href="{{ route('teacher/add/page') }}" class="{{set_active(['teacher/add/page'])}}">Teacher Add</a></li>--}}
{{--                        <li><a class="{{ (request()->is('teacher/edit/*')) ? 'active' : '' }}">Teacher Edit</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="submenu {{set_active(['department/add/page','department/edit/page'])}}">--}}
{{--                    <a href="#"><i class="fas fa-building"></i>--}}
{{--                        <span> Departments</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{ route('department/list/page') }}" class="{{set_active(['department/list/page'])}}">Department List</a></li>--}}
{{--                        <li><a href="{{ route('department/add/page') }}" class="{{set_active(['department/add/page'])}}">Department Add</a></li>--}}
{{--                        <li><a href="{{ route('department/edit/page') }}" class="{{set_active(['department/edit/page'])}}">Department Edit</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="submenu">--}}
{{--                    <a href="#"><i class="fas fa-book-reader"></i>--}}
{{--                        <span> Subjects</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="subjects.html">Subject List</a></li>--}}
{{--                        <li><a href="add-subject.html">Subject Add</a></li>--}}
{{--                        <li><a href="edit-subject.html">Subject Edit</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="submenu">--}}
{{--                    <a href="#"><i class="fas fa-clipboard"></i>--}}
{{--                        <span> Invoices</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="invoices.html">Invoices List</a></li>--}}
{{--                        <li><a href="invoice-grid.html">Invoices Grid</a></li>--}}
{{--                        <li><a href="add-invoice.html">Add Invoices</a></li>--}}
{{--                        <li><a href="edit-invoice.html">Edit Invoices</a></li>--}}
{{--                        <li><a href="view-invoice.html">Invoices Details</a></li>--}}
{{--                        <li><a href="invoices-settings.html">Invoices Settings</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="menu-title">--}}
{{--                    <span>Management</span>--}}
{{--                </li>--}}
{{--                <li class="submenu">--}}
{{--                    <a href="#"><i class="fas fa-file-invoice-dollar"></i>--}}
{{--                        <span> Accounts</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="fees-collections.html">Fees Collection</a></li>--}}
{{--                        <li><a href="expenses.html">Expenses</a></li>--}}
{{--                        <li><a href="salary.html">Salary</a></li>--}}
{{--                        <li><a href="add-fees-collection.html">Add Fees</a></li>--}}
{{--                        <li><a href="add-expenses.html">Add Expenses</a></li>--}}
{{--                        <li><a href="add-salary.html">Add Salary</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</div>
