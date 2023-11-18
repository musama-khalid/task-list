<?php
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect()->route('tasks.index');
});

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks', function() {
    return view('index', [
        'tasks' => Task::query()->latest()->get()
    ]);
}) -> name('tasks.index');

Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => Task::query()->findOrFail($id)
    ]);
}) -> name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task();

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id]);

})->name('tasks.store');

// Route::get('/welcome/{name}', function ($name) {
//     return "Welcome " . $name;
// });

/**
 *  Class:
 *
 *      In OOP, everything is organized into classes. In the Laravel application,
 *      the Route facade is a class that provides a convenient way to define routes.
 *
 *  Method:
 *
 *      In OOP, classes have methods (functions) that define their behavior.
 *      In this case, Route::get is a method call on the Route class. It's a static
 *      method because you're calling it on the class itself, rather than on an instance
 *      of the class. This method is used to define a route for handling HTTP GET requests.
 *
 *  Route Definition:
 *
 *      Inside the Route::get method, you define the behavior of the route using an anonymous
 *      function (closure). In OOP terms, this anonymous function can be thought of as a
 *      method or behavior associated with the route.
 *
 *  Method Chaining:
 *
 *      The ->name('start') part of the code demonstrates method chaining. After defining
 *      the route behavior, you are chaining another method, name('start'), onto the route definition.
 *      This method sets the name of the route to "start." Method chaining is a common OOP practice,
 *      allowing you to call multiple methods on the same object one after the other.
 *
 *  Route as an Object:
 *
 *      Conceptually, you can think of the entire route definition as an object.
 *      The Route facade creates an instance of a route, configures its properties,
 *      and then stores it for future reference. The name method is setting one of
 *      the properties of this route object, which is the route's name.
 */

// Route::get('/start', function(){
//     return 'Here we start !';
// }) -> name('start');    // Method Chaining

/**
 *  Method Chaining:
 *
 *      The ->name('start') part of the code demonstrates method chaining.
 *      After defining the route behavior, you are chaining another method, name('start'),
 *      onto the route definition. This method sets the name of the route to "start."
 *      Method chaining is a common OOP practice, allowing you to call multiple methods
 *      on the same object one after the other.
 */

// Route::get('/started', function (){
//     return redirect() -> route('start');    // Method Chaining
// });

/**
 *  redirect()
 *
 *      is a method call on an instance of a class responsible for performing redirects.
 *      It creates and returns a redirect response.
 *
 *  route('start')
 *
 *      is a method call on the redirect response object, setting the target route for the redirect.
 *      It specifies that you want to redirect to the route named "start."
 */




/**
 *  GET : to fetch the data
 *  POST : to store data to server, to send forms data to server
 *  PUT : to update / modify data on the server i.e modify existing data on the server
 *  DELETE : to delete the data from the server
 */



/**
 *  php artisan route:list
 *
 *      To show the list of routes in your application
 */

 Route::fallback(function() {
    return '404 Route not matched';
 });

/**
 *  Fallback Route
 *
 *      A generic route that catches all routes that are not defined in the application
 */



