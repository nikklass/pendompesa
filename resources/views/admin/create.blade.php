<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Talkpoint Form</title>

        
    </head>
    <body>
        <div id="app" class="container">

            <form @submit.prevent="onSubmit">

                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" class="form-control" name="name" v-model="form.name">

                    <span class="text-danger">@{{ form.errors.get('name') }}</span>

                </div>

                <div class="form-group">
                    <label>Project Description</label>
                    <input type="text" class="form-control" name="description" v-model="form.description">

                    <span class="text-danger">@{{ form.errors.get('description') }}</span>

                </div>

                <button :disabled="form.errors.any()" class="btn btn-primary btn-block">Submit</button>

            </form>
           

        </div>

        <script type="text/javascript" src="/js/app.js"></script>


    </body>
</html>
