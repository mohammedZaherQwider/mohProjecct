@extends('admin.admin')
@section('con')

<h2>All Testimonials</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Job</th>
        <th>Created At</th>
        <th>Comment</th>
    </tr>

    @php
        $index = ($testimonials->currentPage() - 1) * $testimonials->perPage() + 1;
    @endphp

    @forelse ($testimonials as $testimonial)
        <tr id="row_{{ $testimonial->id }}">
            <td>{{ $index++ }}</td>
            <td><img width="60" src="{{ asset($testimonial->image) }}" alt=""></td>
            <td>{{ $testimonial->name }}</td>
            <td>{{ $testimonial->job }}</td>
            <td>{{ $testimonial->created_at ? $testimonial->created_at->diffForHumans() : '' }}</td>
            <td>{{ $testimonial->comment }}</td>
            <td>
                <a
                    onclick="editProduct(event)"
                    data-bs-toggle="modal"
                    data-bs-target="#EditProduct"
                    data-name="{{ $testimonial->name }}"
                    data-price="{{ $testimonial->price }}"
                    data-image="{{ asset($testimonial->image) }}"
                    data-content="{{ $testimonial->content }}"
                    {{-- href="{{ route('products.update', $expert->id) }}" --}}
                    class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </a>

                <form class="d-inline" method="POST"
                action="{{ route('home.deletetestimonials',$testimonial->id )}}">
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
<br>
{{ $testimonials->links() }}
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
@endsection
