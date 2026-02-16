<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Add Contact</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/contacts">
        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="Name">
        <input type="text" name="company" class="form-control mb-2" placeholder="Company">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
        <input type="text" name="phone" class="form-control mb-2" placeholder="Phone">

        <button class="btn btn-success">Save</button>
        <a href="/dashboard" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>