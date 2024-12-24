<x-admin-app-layout :title="'Std Management'">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Std Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Std Management</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.import.excel') }}" class="btn btn-primary rounded-0 px-3 me-3">Import Excel</a>

                    <a href="{{ route('admin.std-mgt.create') }}" class="btn btn-dark rounded-0 px-3">Create Std
                        Management</a>
                </div>
            </div>
        </div>

        <h6 class="mb-0 text-uppercase">All Std Management In Site</h6>
        <hr />

        <!-- Filter Toggle Buttons -->
        <div class="mb-3">
            <button class="btn btn-outline-danger rounded-0" id="filter-upcoming">Upcoming</button>
            <button class="btn btn-outline-success rounded-0" id="filter-completed">Completed</button>
            <button class="btn btn-outline-secondary rounded-0" id="filter-clear">Clear Filter</button>
        </div>

        <!-- Edit All Button (Initially Hidden) -->
        <div class="mb-3" id="edit-all-section" style="display: none;">
            <button class="btn btn-outline-dark rounded-0" id="edit-all" data-bs-toggle="modal"
                data-bs-target="#edit-all-modal">Edit All</button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:1%">All</th>
                                <th style="width:3%">No</th>
                                <th style="width:15%">Name</th>
                                <th style="width:10%">Email</th>
                                <th style="width:10%">Phone</th>
                                <th style="width:10%">Experience</th>
                                <th style="width:10%">Date</th>
                                <th style="width:10%">Status</th>
                                <th style="width:5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr data-status="{{ $item->status }}" data-id="{{ $item->id }}">
                                    <td>
                                        <input type="checkbox" class="open-modal-checkbox">
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->experience }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        @if ($item->status == 'upcoming')
                                            <span class="badge bg-danger">Upcoming</span>
                                        @elseif ($item->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square fs-6 text-primary"></i>
                                        </a>

                                        <!-- Modal for each item -->
                                        <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Employee
                                                            Name: {{ $item->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.std-mgt.update', $item->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-6 col-lg-12 mb-3">
                                                                            <label for="" class="mb-2">Choose
                                                                                Date</label>
                                                                            <input type="date" class="form-control"
                                                                                placeholder="Date" name="date"
                                                                                value="{{ old('date', $item->date) }}">
                                                                        </div>
                                                                        <div class="col-6 col-lg-12 mb-3">
                                                                            <label for=""
                                                                                class="mb-2">Status</label>
                                                                            <select name="status" class="form-select"
                                                                                id="">
                                                                                <option selected disabled>Choose Status
                                                                                </option>
                                                                                <option value="upcoming"
                                                                                    {{ $item->status == 'upcoming' ? 'selected' : '' }}>
                                                                                    Upcoming
                                                                                </option>
                                                                                <option value="completed"
                                                                                    {{ $item->status == 'completed' ? 'selected' : '' }}>
                                                                                    Completed
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-lg-12 mb-3">
                                                                            <button type="submit"
                                                                                class="btn btn-outline-primary rounded-0 px-3 float-end">Update
                                                                                Data</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.std-mgt.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-0" id="delete" title="Delete"
                                                style="border: none; background: none;">
                                                <i class="fa-solid fa-trash fs-6 text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>

<!-- Batch Edit Modal -->
<div class="modal fade" id="edit-all-modal" tabindex="-1" aria-labelledby="editAllModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAllModalLabel">Batch Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to update the following items?</p>
                <ul id="selected-items-list"></ul>

                <div class="mt-3">
                    <label for="batch-status">Status</label>
                    <select name="status" id="batch-status" class="form-select">
                        <option value="upcoming">Upcoming</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label for="batch-date">Choose Date</label>
                    <input type="date" class="form-control" id="batch-date">
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.std-mgt.update.batch') }}" method="POST" id="batch-update-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ids" id="batch-update-ids">
                    <input type="hidden" name="status" id="batch-update-status">
                    <input type="hidden" name="date" id="batch-update-date">
                    <button type="submit" class="btn btn-primary">Update Selected</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                window.location.href = "{{ route('admin.std-mgt.index') }}";
            });
        });

        const filterUpcomingButton = document.getElementById('filter-upcoming');
        const filterCompletedButton = document.getElementById('filter-completed');
        const filterClearButton = document.getElementById('filter-clear');
        const editAllSection = document.getElementById('edit-all-section');
        const editAllModal = document.getElementById('edit-all-modal');
        let selectedIds = [];

        // Filter buttons
        filterUpcomingButton.addEventListener('click', function() {
            filterRowsByStatus('upcoming');
        });

        filterCompletedButton.addEventListener('click', function() {
            filterRowsByStatus('completed');
        });

        filterClearButton.addEventListener('click', function() {
            showAllRows();
        });

        // Track selected checkboxes
        document.querySelectorAll('.open-modal-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    selectedIds.push(checkbox.closest('tr').getAttribute('data-id'));
                } else {
                    selectedIds = selectedIds.filter(id => id !== checkbox.closest('tr')
                        .getAttribute('data-id'));
                }

                if (selectedIds.length > 0) {
                    editAllSection.style.display = 'block';
                } else {
                    editAllSection.style.display = 'none';
                }
            });
        });

        // Open Edit All Modal
        document.getElementById('edit-all').addEventListener('click', function() {
            document.getElementById('batch-update-ids').value = selectedIds.join(',');
            const selectedItemsList = document.getElementById('selected-items-list');
            selectedItemsList.innerHTML = selectedIds.map(id => `<li>Item ID: ${id}</li>`).join('');
        });

        // Update the status and date for the selected items
        document.getElementById('batch-update-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const status = document.getElementById('batch-status').value;
            const date = document.getElementById('batch-date').value;
            document.getElementById('batch-update-status').value = status;
            document.getElementById('batch-update-date').value = date;

            this.submit(); // Now submit the form after setting the necessary values
        });

        function filterRowsByStatus(status) {
            document.querySelectorAll('tr[data-status]').forEach(row => {
                if (row.getAttribute('data-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function showAllRows() {
            document.querySelectorAll('tr').forEach(row => {
                row.style.display = '';
            });
        }
    });
</script>
