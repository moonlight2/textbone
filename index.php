
<script src="jquery-1.7.1.min.js"></script>

<script src="underscore-min.js"></script>
<script src="backbone-min.js"></script>

<p>
<ul>
    <li><a href="#!/">Start</a></li>
    <li><a href="#!/success">Success</a></li>
    <li><a href="#!/error">Error</a></li>
</ul>
</p>

<script type="text/template" id="city"> 
    <%= name %><br> 
    <%= email %> 
    <button class='click'>Event</button>
</script>

<div id="city-list"></div>

<script>


    var CityModel = Backbone.Model.extend({
        defaults: {
            "name": "",
            "email": "",
        },
        parse: function(response) {
            return response;
        }
    });


    var CityCollection = Backbone.Collection.extend({
        model: CityModel,
        url: 'api',
        parse: function(users) {
            var resp = Array();
            for (var i = 0; i < users.length; i ++) {
                var model = {name: users[i][0], email: users[i][1]};
                resp[i] = model;
            }
            return resp;
        }
    });


    window.CityListView = Backbone.View.extend({
        tagName: 'ul',
        initialize: function() {
            this.model.bind('reset', this.render, this);
//            this.model.bind('add', this.render, this);
        },
        render: function() {
            _.each(this.model.models, function(city) {
                $(this.el).append(new CityListItemView({model: city}).render().el);
            }, this);
            return this;
        }
    });

    window.CityListItemView = Backbone.View.extend({
        tagName: 'li',
        template: _.template($('#city').html()),
        render: function() {
            $(this.el).html(this.template(this.model.toJSON()));
            return this;
        },
        initialize: function() {
            this.model.bind('change', this.render, this);
        },
    });



    var Controller = Backbone.Router.extend({
        routes: {
            "": "start", // Пустой hash-тэг
            "!/": "start", // Начальная страница
            "!/success": "success", // Блок удачи
            "!/error": "error" // Блок ошибки
        },
        start: function() {
        },
        success: function() {
            this.cities = new CityCollection({url: '/some/other/url'});
            this.cities.url = 'api/4';

//            this.cities.fetch({ data:{ url: 'api/2'}, processData: true });

            this.cities.fetch({success: function() {
                    $('#city-list').html(new CityListView({model: app.cities}).render().el);
                    console.log(new CityListView({model: app.cities}).render().el);
                }});
        },
        error: function() {
            alert('error');
        }
    });

    app = new Controller(); // Создаём контроллер

    Backbone.history.start();  // Запускаем HTML5 History push    

</script>