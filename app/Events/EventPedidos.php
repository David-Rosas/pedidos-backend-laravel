<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use WebSocket\Client;

class EventPedidos
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        //TODO Tratar de  hacer que funcione sin esta libreria, con pusher funciona perfecto.
        try {
        $websocket = new Client('ws://'.env('PUSHER_HOST').':'.env('PUSHER_PORT'));

        $mensaje = json_encode(['evento' => 'eventPedidos', 'pedido' => $data]);

        $websocket->send($mensaje);

        $websocket->close();
    } catch (\Exception $e) {
        echo 'Error al enviar el mensaje al servidor WebSocket: ' . $e->getMessage() . "\n";
    }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('event-pedido'),
        ];
    }

    public function BroadcastWith()
    {   
        return $this->data;
    }
}
