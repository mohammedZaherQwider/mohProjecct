@extends('admin.admin')
@section('con')
    <h2>All Exprts</h2>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Job Name</th>
            <th>Description</th>
            <th>Created At</th>

        </tr>

        @php
            $index = ($experts->currentPage() - 1) * $experts->perPage() + 1;
        @endphp

        @forelse ($experts as $expert)
            <tr id="row_{{ $expert->id }}">
                {{-- <td>{{ $product->id }}</td>  --}}
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $index++ }}</td>
                <td><img width="60" src="{{ asset($expert->image) }}" alt=""></td>
                <td>{{ $expert->name }}</td>
                <td>{{ $expert->job_name }}</td>
                <td>{{ $expert->description }}</td>
                {{-- <td>{{ $product->created_at->format('F d, Y') }}</td> --}}
                <td>{{ $expert->created_at ? $expert->created_at->diffForHumans() : '' }}</td>
                <td>
                    <a onclick="editProduct(event)" data-bs-toggle="modal" data-bs-target="#EditProduct"
                        data-name="{{ $expert->name }}" data-job_name="{{ $expert->job_name }}"
                        data-image="{{ asset($expert->image) }}" data-description="{{ $expert->description }}"
                        href="{{ route('home.create', 'experts') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form class="d-inline" method="POST" action="{{ route('home.deleteexprt', $expert->id) }}">
                        @csrf
                        @method('delete')
                        <button type="button" onclick="deleteItem(event)" class="btn btn-danger btn-sm"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        @endforelse
    </table>
    {{ $experts->links() }}
    <!-- Modal -->
    <div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Expert</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="text" placeholder="Name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image') }}">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <img width="80" id="oldimg" src="" alt="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Name</label>
                            <input type="text" placeholder="Job Name" name="job_name"
                                class="form-control @error('job_name') is-invalid @enderror" value="{{ old('job_name') }}">
                            @error('job_name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea placeholder="Description" name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="button" id="yu" onclick="UpdateProduct(event)"
                            class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteItem(e) {
            let url = e.target.closest('form').action
            let row = e.target.closest('tr')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, deleted it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(url, {
                            _method: 'delete'
                        })
                        .then(res => {
                            row.remove()
                        })
                }
            })
        }
    </script>
    <script>
        function editProduct(e) {

            // get old data from tr
            let name = e.target.closest('a').dataset.name
            let job_name = e.target.closest('a').dataset.job_name
            let image = e.target.closest('a').dataset.image
            let description = e.target.closest('a').dataset.description

            let url = e.target.closest('a').href

            // console.log(name,description , image, url);
            // show old data in edit form
            document.querySelector('[name=name]').value = name
            document.querySelector('#oldimg').src = image
            document.querySelector('[name=job_name]').value = job_name
            document.querySelector('[name=description]').value = description

            document.querySelector('.modal form').action = url
        }

        function UpdateProduct(e) {
            e.preventDefault();
            let url = e.target.closest('form').action;
            let data = new FormData(e.target.closest('form'));
            axios.post(url, data)
                .then(res => {
                    document.querySelector('#row_' + res.data.id + ' td:nth-child(2) img').src = res.data.image;
                    // document.querySelector('#row_' + res.data.id + ' td:nth-child(3) ').innerHTML =res.data.name
                    document.querySelector('#row_' + res.data.id + ' td:nth-child(4) ').innerHTML = res.data.job_name;
                    document.querySelector('#row_' + res.data.id + ' td:nth-child(5) ').innerHTML = res.data
                        .description;

                    const truck_modal = document.querySelector('#EditProduct');
                    const modal = bootstrap.Modal.getInstance(truck_modal);
                    modal.hide();
                })
        }
    </script>
@endsection
