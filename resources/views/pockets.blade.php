
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Album example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">

  </head>

  <body>
    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Read It Later</strong>
          </a>

        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Pockets</h1>
          <p class="lead text-muted">Checkout all saved pockets</p>

        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
        @foreach($pockets as $pocket)
            @if (count($pocket->contents) == 0)
                @continue
            @endif
            <h3> {{ $pocket->title }} </h3>
            <div class="row">
            @foreach($pocket->contents as $content)
                <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    @if($content->image)
                    <img src="{{ $content->image }}" alt="">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title"> {{ $content->title }}</h5>
                    <p class="card-text">
                        @if(! $content->image)
                        <iframe src="{{ $content->url }}" ></iframe>
                        {{ $content->description }}
                        @endif
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ $content->url }}" target="__blank"> <button type="button" class="btn btn-sm btn-outline-secondary">View</button> </a>
                        </div>
                        <small class="text-muted">{{$content->getCreatedAt()}} </small>
                    </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
        @endforeach
    </main>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
  </body>
</html>
