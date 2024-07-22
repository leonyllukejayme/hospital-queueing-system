<div class="d-flex justify-content-center gap-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Add Patient
                    </button>
                    <a href="{{route('logout')}}" class="btn btn-secondary"> Logout </a>

                    <x-modals.form-addPatient />
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/0">Laboratory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/1">Radiology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/2">Pharmacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/3">Admission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/4">Cashier</a>
                    </li>
                </ul>
