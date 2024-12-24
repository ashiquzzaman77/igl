<x-admin-app-layout :title="'Std Management Edit'">


    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Std Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Std Management</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.std-mgt.index') }}" class="btn btn-dark rounded-0 px-3">Back To List
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Edit Std Management In Site</h6>
        <hr />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.std-mgt.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                value="{{ old('name', $item->name) }}">
                        </div>

                        <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                value="{{ old('email', $item->email) }}">
                        </div>

                        <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Phone</label>
                            <input type="tel" class="form-control" placeholder="Phone" name="phone"
                                value="{{ old('phone', $item->phone) }}">
                        </div>

                        <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Experience</label>
                            <input type="text" class="form-control" placeholder="Experience" name="experience"
                                value="{{ old('experience', $item->experience) }}">
                        </div>

                        <div class="col-6 col-lg-2 mb-3">
                            <label for="" class="mb-2">Choose Date</label>
                            <input type="date" class="form-control" placeholder="Date" name="date"
                                value="{{ old('date', $item->date) }}">
                        </div>

                        {{-- <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Image</label>
                            <input type="file" class="form-control" name="image" id="imageInput">

                            <div class="mt-2">
                                <!-- Image Preview -->
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="display: none; width: 30%; height: auto;" />
                            </div>

                        </div>

                        <div class="col-6 col-lg-3 mb-3">
                            <label for="" class="mb-2">Current Image</label>
                            <div>
                                <img src="{{ !empty($item->image) ? url('storage/' . $item->image) : 'https://ui-avatars.com/api/?name=' . urlencode($item->name) }}"
                                    style="width: 100px;height: 100px;" alt="">
                            </div>

                        </div> --}}

                        <div class="col-12 col-lg-12 mb-3">
                            <button type="submit" class="btn btn-outline-primary rounded-0 px-3 float-end">Update
                                Data</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>

    <script>
        // JavaScript for image preview
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            // If there's a file, show the image preview
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result; // Set the preview image source to the file's data URL
                    preview.style.display = 'block'; // Show the preview image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                preview.style.display = 'none'; // Hide the preview if no file is selected
            }
        });
    </script>


</x-admin-app-layout>
