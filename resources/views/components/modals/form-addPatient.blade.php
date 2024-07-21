            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog d-flex align-items-center justify-content-center h-60">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Patients</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <form action="{{route('addPatient')}}" method="post">
                            @csrf
                            <div class="modal-body d-grid gap-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text"  name="name"/>
                                </div>
                                <div class="d-flex gap-3">
                                    <div class="form-group w-25">
                                        <label for="age">Age</label>
                                        <input class="form-control" type="text"  name="age"/>
                                    </div>
                                    <div class="form-group w-40">
                                        <label for="gender">Gender</label>
                                            <select class="form-control" name="gender" id="">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                    </div>
                                    <div class="form-group w-50">
                                        <label for="department">Department</label>
                                        <select class="form-control" name="department" id="">
                                            <option value="1">Laboratory</option>
                                            <option value="2">Radiology</option>
                                            <option value="3">Pharmacy</option>
                                            <option value="4">Admission</option>
                                            <option value="5">Cashier</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Date of Birth</label>
                                    <input class="form-control" type="date" name="birthdate">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Add Patient" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
