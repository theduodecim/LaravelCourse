<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projects</title>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
</head>
<body>

<div class="container">


<h1 class="title">Edit Projects</h1>


<form method="POST" action="/project/{{ $project->id }}">

@csrf
@method('PATCH')

<div class="field">
<label class="label" for="title">Title</label>

    <div class="control">
        <input minlength="6"  name="title" type="text" class="input" value="{{ $project->title }}"  placeholder="Title" required>
    </div>

</div>


<div class="field">

<label class="label" for="title">Description</label>

    <div class="control">
        <textarea minlength="6" name="description"  class="textarea" required> {{ $project->description }} </textarea>
    </div>

</div>

<div class="field">

    <div class="control">
      <button type="submit" class="button is-link">Update Project</button>
    </div>

</div>
</form>

<div class="field">
   <form method="POST"  action="/project/{{ $project->id }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <div class="control">
      <button type="submit" class="button is-danger">Delete Project</button>
    </div>
    </form>
</div>
</div>
<br>
<br>
<br>

    <a class="button is-success is-outlined" href="/project/create"> Create </a> 
    <br>
    <a class="subtitle is-2" href="/project"> Projects </a>
</body>
</html>
