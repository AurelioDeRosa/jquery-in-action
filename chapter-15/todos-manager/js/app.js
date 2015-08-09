// Create a global variable to add Models, Collections and Views
window.app = {};

// Create the Todo Model
app.Todo = Backbone.Model.extend({
   // Set the default values for a new instance of the Todo Model
   defaults: {
      position: 1,
      title: '',
      done: false
   },

   // Initialize the Model with some functions to log operations
   initialize: function() {
      this
         .on('invalid', function(model, error) {
            console.log(error);
         })
         .on('add', function(model, error) {
            console.log('Todo with title "' + model.get('title') + '" added.');
         })
         .on('remove', function(model, error) {
            console.log('Todo with title "' + model.get('title') + '" deleted.');
         })
         .on('change', function(model, error) {
            console.log('Todo with title "' + model.get('title') + '" updated.');
         });
   },

   // Function to validate the properties of the model
   validate: function(attributes) {
      if(!attributes.title) {
         return 'Title is required and cannot be empty';
      }

      if(attributes.position === undefined || parseInt(attributes.position, 10) < 1) {
         return 'Position must be positive';
      }
   }
});

// Create the Todos Collection
app.todoList = new (Backbone.Collection.extend({
   // Specify this is a Collection of Todo Models
   model: app.Todo,

   // The (local) storage where the Todos are stored
   localStorage: new Backbone.LocalStorage('todo-list'),

   comparator: 'position',

   initialize: function() {
      this.on('add remove', this.collectionChanged);
   },

   collectionChanged: function(todo) {
      // Elements are updated only if the new element is valid
      if (todo.isValid()) {
         this.each(function(element, index) {
            element.save({
               position: index + 1
            });
         });
         this.sort();
      }
   }
}));

// Create the Todo View
app.TodoView = Backbone.View.extend({
   tagName: 'li',
   className: 'todo',

   template: _.template($('#todo-template').html()),

   events: {
      'blur .todo-position': 'updateTodo',
      'change .todo-done': 'updateTodo',
      'keypress .todo-title': 'updateOnEnter',
      'click .todo-delete': 'deleteTodo'
   },

   initialize: function() {
      this.listenTo(this.model, 'change', this.render);
      this.listenTo(this.model, 'destroy', this.remove);
   },

   deleteTodo: function() {
      // Delete the model from the storage
      this.model.destroy();
   },

   updateTodo: function() {
      this.model.save({
         title: $.trim(this.$title.text()),
         position: parseInt(this.$position.text(), 10),
         done: this.$done.is(':checked')
      });
   },

   updateOnEnter: function(event) {
      if (event.which === 13) {
         this.updateTodo();
      }
   },

   render: function() {
      this.$el.html(this.template(this.model.toJSON()));
      this.$title = this.$('.todo-title');
      this.$position = this.$('.todo-position');
      this.$done = this.$('.todo-done');

      return this;
   }
});

// Create the App View
app.appView = Backbone.View.extend({
   el: '#todo-sheet',

   events: {
      'click #new-todo-save': 'createTodo'
   },

   initialize: function() {
      this.$input = this.$('#new-todo');
      this.$list = this.$('ul.todos');

      this.listenTo(app.todoList, 'reset sort destroy', this.showTodos);
      this.listenTo(app.todoList, 'invalid', this.showError);

      // Fetch the set of models from the storage and set them in the collection
      app.todoList.fetch();
   },

   createTodo: function() {
      // Create the new Todo, validate it and save it in the head of the list if valid
      app.todoList.create(
         {
            title: this.$input.val().trim()
         },
         {
            at: 0,
            validate: true
         }
      );

      // Reset the input box
      this.$input.val('');
   },

   showError: function(collection, error, model) {
      // Display the error to the user
      this
         .$('.error-message')
         .finish()
         .html(error)
         .fadeIn('slow')
         .delay(2000)
         .fadeOut('slow');
   },

   showTodo: function(todo) {
      // Add the item only if the model is valid
      if (todo.isValid()) {
         var view = new app.TodoView({ model: todo });
         this.$list.prepend(view.render().el);
      }
   },

   showTodos: function() {
      this.$list.empty();
      var todos = app.todoList.sortBy(function(element) {
         return -1 * parseInt(element.get('position'), 10);
      });
      for(var i = 0; i < todos.length; i++) {
         this.showTodo(todos[i]);
      }
   }
});

new app.appView();