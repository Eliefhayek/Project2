### Project 2
in this project we sync the data that is sent from the first project with the online database we check wether the data exists and if it does not exist we will add it to the online database so both online and local databases are in sync

## Requirements
Laravel 9 <br>
Firestore

## Execution
to execute the code we write a syncing function as a route  in the web.php it checks the records in the online database and compares them with the data of the api and it adds the new records depending on the sent ID <br>
```php
Route::get('/',function(){
    // here we acquire the JSON folder from the api that is sent from the first project
    $res=Http::get('http://127.0.0.1:8000/api/blog');

        foreach($res->json()['order'] as $x){

            $doc=app('firebase.firestore')->database()->collection('Order');
            $doc1=$doc->where('id', '=', $x['id']);
            $res=$doc1->documents();
            $q=0;
            foreach($res as $w){
                //here we chekc if the sent element exists so we do not add existing elements q is a flag
                $q=1;
            }


           if($q==0){
            // if the element does not exist we add it to the online database ie the second firestore database
            $stuRef=app('firebase.firestore')->database()->collection('Order')->newDocument();
            $stuRef->set([
                'Fruit'=> $x['fruit'],
                'id'=>$x['id'],

            ]);
           }


        }

});
```

### Conclusion
this projects connects between to laravel application and communicates between them to store data from a local database to an online database
