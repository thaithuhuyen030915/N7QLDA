<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu" {{ set_active(['list/admin']) }}>
                    <a href="#"><i class="fas fa-user"></i>
                        <span> Quản lý tài khoản</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('list/admin') }}" class="{{ set_active(['list/admin', 'list/roles', 'admin/create']) }}">Tài khoản Admin</a></li>
                        <li><a href="#
{{--                        {{ route('teacher/dashboard') }}" class="{{set_active(['teacher/dashboard'])}}--}}
                        ">Tài khoản Gia sư</a></li>
                        <li><a href="#
{{--                        {{ route('student/dashboard') }}" class="{{set_active(['student/dashboard'])}}--}}
                        ">Tài khoản Phụ huynh</a></li>
                    </ul>
                </li>
                <li class="submenu" {{ set_active(['list/giasu']) }}>
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span>Quản lý gia sư</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('list.dsgiasu') }}" class="{{ set_active(['list/giasu']) }}">Danh sách gia sư</a></li>
                        <li><a href="
{{--                        {{ route('list.dsgiasu') }}" class="{{ set_active(['list/giasu']) }}--}}
                        ">Xác thực gia sư</a></li>
                    </ul>
                </li>

                <li class="submenu ">
                    <a href="#"><i class="fas fa-user-friends"></i>
                        <span>Quản lý phụ huynh</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="#
{{--                        {{ route('list.dsgiasu') }}" class="{{ set_active(['list/giasu']) }}--}}
                        ">Danh sách phụ huynh</a></li>
                    </ul>
                </li>


                <li class="submenu">
                    <a href="#"><i class="fas fa-check-square"></i>
                        <span> Quản lý phê duyệt</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="subjects.html">Subject List</a></li>
                        <li><a href="add-subject.html">Subject Add</a></li>
                        <li><a href="edit-subject.html">Subject Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-lightbulb"></i>
                        <span> Quản lý đề nghị</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="#">Danh sách đề nghị dạy học</a></li>
                        <li><a href="add-subject.html">Subject Add</a></li>
                        <li><a href="edit-subject.html">Subject Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard"></i>
                        <span> Quản lý lớp học</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                        <span> Quản lý thanh toán</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="fees-collections.html">Fees Collection</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="salary.html">Salary</a></li>
                        <li><a href="add-fees-collection.html">Add Fees</a></li>
                        <li><a href="add-expenses.html">Add Expenses</a></li>
                        <li><a href="add-salary.html">Add Salary</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
