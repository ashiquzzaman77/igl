<x-admin-app-layout :title="'Team'">

    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">Team</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Team</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.teamsapi.create') }}" class="btn btn-dark rounded-0 px-3">Create Team
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">All Team In Site</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:3%">Sl</th>
                                <th style="width:6%">Image</th>
                                <th style="width:15%">Name</th>
                                {{-- <th style="width:10%">Designation</th> --}}
                                <th style="width:10%">Email</th>
                                <th style="width:10%">Phone</th>
                                {{-- <th style="width:2%">Order</th> --}}
                                <th style="width:6%">Status</th>
                                <th style="width:5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--begin::Table row-->
                            @foreach ($teamsdata as $key => $item)
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ !empty($item['image']) ? url('https://azshipping.net/storage/team/' . $item['image']) : 'https://ui-avatars.com/api/?name=' . urlencode($item['name']) }}"
                                            style="width: 50px;height: 50px;" alt="">
                                    </td>
                                    <td>{{ $item['name'] }}</td>
                                    {{-- <td>{{ $item['designation'] }}</td> --}}
                                    <td>{{ $item['email'] }}</td>
                                    <td>{{ $item['phone'] }}</td>
                                    {{-- <td>{{ $item['order'] }}</td> --}}

                                    <td>
                                        @if ($item['status'] == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- @if (Auth::guard('admin')->user()->can('edit.team')) --}}
                                        <a href="{{ route('admin.team.edit', $item['id']) }}" class="text-primary">
                                            <i class="fa-solid fa-pencil text-primary"></i>
                                        </a>
                                        {{-- @endif
        
                                        @if (Auth::guard('admin')->user()->can('delete.team')) --}}
                                        <a href="{{ url('https://azshipping.net/admin/teams/api/delete/' . $item['id']) }}"
                                            class="">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>


                                        {{-- @endif --}}

                                    </td>


                                </tr>
                            @endforeach
                            <!--end::Table row-->
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->


</x-admin-app-layout>
