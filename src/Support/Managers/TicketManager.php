<?php


    namespace Support\Managers;

    use Support\Support;

    /**
     * Class TicketManager
     * @package Support\Managers
     */
    class TicketManager
    {
        /**
         * @var Support
         */
        private $support;

        /**
         * TicketManager constructor.
         * @param Support $support
         */
        public function __construct(Support $support)
        {
            $this->support = $support;
        }
    }