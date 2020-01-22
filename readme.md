# Menu manager


## Table of Contents
- [Task description](#task-description)
- [Routes](#routes)
- [Bonus points](#bonus-points)


## Task Description

Fork or Download this repository and implement the logic to manage a menu.

A Menu has a depth of **N** and maximum number of items per layer **M**. Consider **N** and **M** to be dynamic for bonus points.

It should be possible to manage the menu by sending API requests. Do not implement a frontend for this task.

Feel free to add comments or considerations when submitting the response at the end of the `README`.

## Considerations

Fork this repository and return a public git link, to present the task.

Git history will be reviewed aswell as part of this task.

If you don't have time to implement a part of the system but you know how, try create the placeholder and write comments with the intended behaviour.


### Example menu

* Home
    * Home sub1
        * Home sub sub
            * [N] 
    * Home sub2
    * [M]
* About
* [M]


## Routes


### `POST /menus`

Create a menu.


#### Input

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `GET /menus/{menu}`

Get the menu.


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `PUT|PATCH /menus/{menu}`

Update the menu.


#### Input

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


#### Output

```json
{
    "field": "value"
}
```


##### Bonus

```json
{
    "field": "value",
    "max_depth": 5,
    "max_children": 5
}
```


### `DELETE /menus/{menu}`

Delete the menu.


### `POST /menus/{menu}/items`

Create menu items.


#### Input

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `GET /menus/{menu}/items`

Get all menu items.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `DELETE /menus/{menu}/items`

Remove all menu items.


### `POST /items`

Create an item.


#### Input

```json
{
    "field": "value"
}
```


#### Output

```json
{
    "field": "value"
}
```


### `GET /items/{item}`

Get the item.


#### Output

```json
{
    "field": "value"
}
```


### `PUT|PATCH /items/{item}`

Update the item.


#### Input

```json
{
    "field": "value"
}
```


#### Output

```json
{
    "field": "value"
}
```


### `DELETE /items/{item}`

Delete the item.


### `POST /items/{item}/children`

Create item's children.


#### Input

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `GET /items/{item}/children`

Get all item's children.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


##### Bonus

```json
[
    {
        "field": "value",
        "children": [
            {
                "field": "value",
                "children": []
            },
            {
                "field": "value"
            }
        ]
    },
    {
        "field": "value"
    }
]
```


### `DELETE /items/{item}/children`

Remove all children.


### `GET /menus/{menu}/layers/{layer}`

Get all menu items in a layer.


#### Output

```json
[
    {
        "field": "value"
    },
    {
        "field": "value"
    }
]
```


### `DELETE /menus/{menu}/layers/{layer}`

Remove a layer and relink `layer + 1` with `layer - 1`, to avoid dangling data.


### `GET /menus/{menu}/depth`


#### Output

Get depth of menu.

```json
{
    "depth": 5
}
```


## Bonus points

* 10 vs 1.000.000 menu items - what would you do differently?
* Write documentation
* Use PhpCS | PhpCsFixer | PhpStan
* Use cache
* Use data structures
* Use docker
* Implement tests

## Documentation
* Clone directory from git
###### If using Docker
* Create a .env file and copy database credentials from docker-compose.yml
* Run ``` docker-compose up ```
* After creating containers run ``` docker-compose exec app composer install ```
* Run ``` docker-compose exec app composer require predis/predis ```
* After installing composer run  ``` docker-compose exec app php artisan migrate ```
* Go to ``` localhost:8080``` in your browser
###### If not using Docker
* Install composer
* Create a .env file from .envexample
* Run ``` composer install ```
* Run ``` composer require predis/predis ```
* Run ``` php artisan key:generate```
* Put database credentials
* Run ``` php artisan migrate``` 
* Run ``` php artisan serve ```
* Go to ``` localhost:8000``` in your browser
### Testing the API

``` POST /api/menus ```
```json
{
    "name": "Home",
    "max_depth": 5,
    "max_children": 3
}
```

``` GET /menus/{menu} ```
```
api/menus/1
```
```PUT|PATCH /menus/{menu} ``` |
``` api/menus/1```
```
{
    "name": "Home 2",
    "max_depth": 6,
    "max_children": 7
}
```
```DELETE /menus/{menu}``` 
```
api/menus/1
```
``` POST /menus/{menu}/items ``` |
``` api/menus/1/items```
```
{
    "name": "Menu Item"
}
```

``` GET /menus/{menu}/items``` | ``` api/menus/1/items```

```DELETE /menus/{menu}/items ``` | ``` api/menus/1/items```


``` POST api/items ```
```
{
    "name": "Item 1",
    "menu_id": 1,
    "item_id": 1
}
```
``` GET /items/{item}``` | ``` api/items/1```

``` PUT|PATCH /items/{item} ``` | ``` api/items/1 ```

``` DELETE /items/{item}``` | ``` api/items/1```

```POST /items/{item}/children``` | ``` /api/1/children```
```
{
    "name": "Item Sub"
    "item_id": 2
}
```
```GET /items/{item}/children``` | ``` api/items/2/children```
```
{
    "name": "Item Sub"
    "item_id": 2
}
```

``` DELETE /items/{item}/children ``` | ``` api/items/2/children```


``` GET /menus/{menu}/layers/{layer} ``` | ``` /menus/1/layers/1 ```

``` GET /menus/{menu}/depth ``` | ``` api/1/depth ``` 

### Note: If testing the api via Postman please add this script that generates CSRF Token , to Pre-Request Script
```
console.log('Pre-request Script from Request start');

// We don't need to do anything if it's GET or x-csrf-token header is explicitly presented
if (pm.request.method !== 'GET' && !(pm.request.headers.has('x-csrf-token'))) {

  var csrfRequest = pm.request.clone();
  csrfRequest.method = 'GET';
  if (pm.request.method === 'POST') {
    // for POST method usually it is ....<something>Collection in the URL
    // so we add $top=1 just to quickly get csrf token; 
    // for PUT, PATCH or DELETE the same URL would be enough,
    // because it points to the actual entity
    csrfRequest.url = pm.request.url + '?$top=1';
  }

  csrfRequest.upsertHeader({
    key: 'x-csrf-token',
    value: 'fetch'
  });

  pm.sendRequest(csrfRequest, function(err, res) {
    console.log('pm.sendRequest start');
    if (err) {
      console.log(err);
    } else {
      var csrfToken = res.headers.get('x-csrf-token');
      if (csrfToken) {
        console.log('csrfToken fetched:' + csrfToken);
        pm.request.headers.upsert({
          key: 'x-csrf-token',
          value: csrfToken
        });
      } else {
        console.log('No csrf token fetched');
      }
    }
    console.log('pm.sendRequest end');
  });
}

console.log('Pre-request Script from Request end');
```
### Cache ###
###### Redis is used for caching ######

### 10 vs 1.000.000 menu items Answer
##### - I would index the database , and test the performance . If still facing issues I would consider maybe no sql , or mongodb for this part.

### Run Tests
tests/Feature/ExampleTest.php