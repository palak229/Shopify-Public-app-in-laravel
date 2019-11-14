<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shopify Chop App</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
        <br class="xs-80">
        <br class="xs-80">
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Welcome to the Chop App</h2>
                <p>Please just add the storename in the input box below. e.g <b>"mystore"</b> if your complete <b>Store Url</b> is <b>"https://mystore.myshopify.com"</b> </p>
                <form class="form account-form" method="POST" action="{{ url('install') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="storeName" class="placeholder-hidden">Add Store Name Here</label>
                        <input type="text" class="form-control" id="storeName" name="shop" placeholder="Add Store Name Here" tabindex="1" required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="shopInstallation" class="btn btn-primary btn-block btn-lg" tabindex="4">
                            Install App Now <i class="fa fa-play-circle"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    </body>
</html>
