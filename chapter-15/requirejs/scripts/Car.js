define(['Person'], function(Person) {
   function Car() {
      this.getOwner = function() {
         return 'The owner is ' + Person.name;
      };
   }

   return Car;
});