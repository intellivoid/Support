<?php


    namespace Support;

    use mysqli;
    use Support\Exceptions\ConfigurationNotFoundException;

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'ExceptionCodes.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'SupportTicketSearchMethod.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'TicketStatus.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'ConfigurationNotFoundException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'DatabaseException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidEmailException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidMessageException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidSourceException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidSubjectException.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Managers' . DIRECTORY_SEPARATOR . 'TicketManager.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Objects' . DIRECTORY_SEPARATOR . 'SupportTicket.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Utilities' . DIRECTORY_SEPARATOR . 'Hashing.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Utilities' . DIRECTORY_SEPARATOR . 'Validation.php');

    /**
     * Class Support
     * @package Support
     */
    class Support
    {
        /**
         * @var mysqli
         */
        private $database;

        /**
         * @var array|bool
         */
        private $configuration;

        /**
         * Support constructor.
         * @throws ConfigurationNotFoundException
         */
        public function __construct()
        {
            if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini') == false)
            {
                throw new ConfigurationNotFoundException();
            }

            $this->configuration = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini');

            $this->database = new mysqli(
                $this->configuration['DatabaseHost'],
                $this->configuration['DatabaseUsername'],
                $this->configuration['DatabasePassword'],
                $this->configuration['DatabaseName'],
                $this->configuration['DatabasePort']
            );
        }

        /**
         * @return mysqli
         */
        public function getDatabase()
        {
            return $this->database;
        }
    }