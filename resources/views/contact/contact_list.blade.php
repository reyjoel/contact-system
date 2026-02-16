<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="120">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->company }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    <a href="/contacts/{{ $contact->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $contact->id }}">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No contacts found</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- PAGINATION --}}
@if ($contacts->hasPages())
    <ul class="pagination justify-content-center">

        {{-- Previous --}}
        @if ($contacts->onFirstPage())
            <li class="page-item disabled"><span class="page-link">‹</span></li>
        @else
            <li class="page-item">
                <a href="#" class="page-link pagination-link"
                   data-page="{{ $contacts->currentPage() - 1 }}">‹</a>
            </li>
        @endif

        {{-- Pages --}}
        @for ($i = 1; $i <= $contacts->lastPage(); $i++)
            <li class="page-item {{ $i == $contacts->currentPage() ? 'active' : '' }}">
                <a href="#" class="page-link pagination-link"
                   data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next --}}
        @if ($contacts->hasMorePages())
            <li class="page-item">
                <a href="#" class="page-link pagination-link"
                   data-page="{{ $contacts->currentPage() + 1 }}">›</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">›</span></li>
        @endif

    </ul>
@endif