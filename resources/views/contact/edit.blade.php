<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Edit Contact</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/contacts/{{ $contact->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" class="form-control mb-2" value="{{ $contact->name }}" placeholder="Name">
        <input type="text" name="company" class="form-control mb-2" value="{{ $contact->company }}" placeholder="Company">
        <input type="email" name="email" class="form-control mb-2" value="{{ $contact->email }}" placeholder="Email">
        <input type="text" name="phone" class="form-control mb-2" value="{{ $contact->phone }}" placeholder="Phone">

        <button class="btn btn-primary">Update</button>
        <a href="/dashboard" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>