<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>ADD PRODUCT</h2>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if(session('success_product'))
        <div class="alert alert-success">
            <strong>{{session('success_product')}}</strong>
        </div>
    @endif



    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Product title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter product title" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="price">Product price:</label>
            <input type="text" class="form-control" id="price" placeholder="Enter product price" name="price" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label for="image">Product image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="description">Product description:</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10">
                {{old('description')}}
            </textarea>
        </div>

        <div class="form-group">
            <label for="module_id">Website</label>
            <select class="form-control" name="web_id" id="web_id">
                <option value="">Select Website</option>
                @foreach($webs as $web)
                    <option value="{{$web->id}}" @if($web->id==old('web_id')) selected @endif>{{$web->title}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-default">CREATE PRODUCT</button>
    </form>
</div>

</body>
</html>
