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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
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
                                <tr>
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
