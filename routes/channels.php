<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated Customer can listen to the channel.
|
*/

Broadcast::channel('App.Models.Customer.{id}', function ($Customer, $id) {
    return (int) $Customer->id === (int) $id;
});
