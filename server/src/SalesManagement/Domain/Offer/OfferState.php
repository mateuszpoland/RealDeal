<?php

namespace RealDeal\SalesManagement\Domain\Offer;

/** helper consts for workflow */
interface OfferState 
{
    //states
    public const STATE_NEW = 'new';
    public const STATE_CLOSED = 'closed'; 

    //transitions
    public const TRANSITION_UPDATE_OFFER = 'updateOffer';
    public const TRANSITION_CLOSE_OFFER = 'closeOffer';

    public const STATES = [
        self::STATE_NEW,
        self::STATE_CLOSED
    ];
}