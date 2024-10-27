<?php

namespace App\Observers;

use App\Models\Auction;

class AuctionObserver
{
    /**
     * Handle the Auction "created" event.
     */
    public function created(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "updated" event.
     */
    public function updated(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "deleted" event.
     */
    public function deleted(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "restored" event.
     */
    public function restored(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "force deleted" event.
     */
    public function forceDeleted(Auction $auction): void
    {
        //
    }

    //to solve ends_at time of auction updating
    public function updating(Auction $auction)
    {
        if ($auction->isDirty('ends_at')) {
            $auction->ends_at = $auction->getOriginal('ends_at');
        }
    }

}
