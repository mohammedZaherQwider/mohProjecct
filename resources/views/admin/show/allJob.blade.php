@extends('admin.admin')
@section('con')
<h2>All Jobs</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Job Name</th>
        <th>Time</th>
        <th>Job Location</th>
    </tr>

    @php
        $index = ($jobs->currentPage() - 1) * $jobs->perPage() + 1;
    @endphp

    @forelse ($jobs as $job)
        <tr id="row_{{ $job->id }}">
            <td>{{ $index++ }}</td>
            <td>{{ $job->job_name }}</td>
            <td>{{ $job->job_location }}</td>
            <td>{{ $job->time }}</td>
            <td>
                <a
                    onclick="editProduct(event)"
                    data-bs-toggle="modal"
                    data-bs-target="#EditProduct"
                    data-name="{{ $job->name }}"
                    data-price="{{ $job->price }}"
                    data-image="{{ asset($job->image) }}"
                    data-content="{{ $job->content }}"
                    class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </a>

                <form class="d-inline" method="POST"
                action="{{ route('home.deletejod',$job->id) }}">
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
{{ $jobs->links() }}
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
                            <label class="form-label">Job Name:</label>
                            <input type="text" placeholder="Job Name" name="job_name"
                                class="form-control @error('job_name') is-invalid @enderror" value="{{ old('job_name') }}">
                            @error('job_name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Time</label>
                            <input type="texe" name="time" placeholder="Time" class="form-control  @error('time') is-invalid @enderror"
                                value="{{ old('time') }}">
                            @error('time')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <img width="80" id="oldimg" src="" alt="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Location</label>
                            <input type="text" placeholder="Job Location" name="job_location"
                                class="form-control @error('job_location') is-invalid @enderror" value="{{ old('job_location') }}">
                            @error('job_location')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" onclick="UpdateProduct(event)" class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
 function deleteItem(e) {
            let url = e.target.closest('form').action
            let row = e.target.closest('tr')
            console.log(url);
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
        console.log(e.target);
        let time = e.target.closest('a').dataset.time
        let job_name = e.target.closest('a').dataset.job_name
        let job_location = e.target.closest('a').dataset.job_location

        let url = e.target.closest('a').href

        console.log(time,job_name , job_location, url);
        // show old data in edit form
        document.querySelector('[name=time]').value = time
        document.querySelector('[name=job_name]').value = job_name
        document.querySelector('[name=job_location]').value = job_location

        document.querySelector('.modal form').action = url
    }

    function UpdateProduct(e) {
        e.preventDefault();
        let url = e.target.closest('form').action;
        let data = new FormData(e.target.closest('form'));
        axios.post(url, data)
            .then(res => {
                let id = res.data.id;
                console.log(document.querySelector("#row_" +id));
                // document.querySelector('#row_' + res.data.id + ' td:nth-child(2) img').src = res.data.image;

                // document.querySelector('#row_' + res.data.id + ' td:nth-child(3)').innerHTML = res.data.name;
                // document.querySelector('#row_' + res.data.id + ' td:nth-child(4)').innerHTML = res.data.job_name;
                // document.querySelector('#row_' + res.data.id + ' td:nth-child(5)').innerHTML = res.data.description;

                var row = document.querySelector('#row_' + res.data.id);
                if (row) {
                    row.querySelector('td:nth-child(2)').innerHTML = res.data.job_name;
                    row.querySelector('td:nth-child(3)').innerHTML = res.data.time;
                    row.querySelector('td:nth-child(4)').innerHTML = res.data.job_location;
                } else {
                    console.log("Row not found.");
                }
                const truck_modal = document.querySelector('#EditProduct');
                const modal = bootstrap.Modal.getInstance(truck_modal);
                modal.hide();
            })
    }
</script>
@endsection
