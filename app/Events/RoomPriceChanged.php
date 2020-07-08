<?php

namespace App\Events;

use App\Rooms;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Auth;

class RoomPriceChanged implements ShouldBroadcastNow {
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $room;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Rooms $room) {
		$this->room = $room;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn() {
		return new Channel('price_updated');
	}
}
