<?php


    namespace Support\Managers;

    use Support\Abstracts\TicketStatus;
    use Support\Exceptions\DatabaseException;
    use Support\Exceptions\InvalidEmailException;
    use Support\Exceptions\InvalidMessageException;
    use Support\Exceptions\InvalidSourceException;
    use Support\Exceptions\InvalidSubjectException;
    use Support\Objects\SupportTicket;
    use Support\Support;
    use Support\Utilities\Hashing;
    use Support\Utilities\Validation;

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

        /**
         * @param string $source
         * @param string $subject
         * @param string $message
         * @param string $email
         * @return SupportTicket
         * @throws InvalidMessageException
         * @throws InvalidSourceException
         * @throws InvalidSubjectException
         * @throws InvalidEmailException
         * @throws DatabaseException
         */
        public function submitTicket(string $source, string $subject, string $message, string $email): SupportTicket
        {
            if(Validation::source($source) == false)
            {
                throw new InvalidSourceException();
            }

            if(Validation::subject($subject) == false)
            {
                throw new InvalidSubjectException();
            }

            if(Validation::message($message) == false)
            {
                throw new InvalidMessageException();
            }

            if(Validation::email($email) == false)
            {
                throw new InvalidEmailException();
            }

            $CurrentTimestamp = time();
            $TicketNumber = Hashing::ticketNumber($source, $subject, $message, $CurrentTimestamp);
            $TicketNumber = $this->support->getDatabase()->real_escape_string($TicketNumber);
            $Source = $this->support->getDatabase()->real_escape_string($source);
            $Subject = $this->support->getDatabase()->real_escape_string($subject);
            $Message = $this->support->getDatabase()->real_escape_string($message);
            $ResponseEmail = $this->support->getDatabase()->real_escape_string($email);
            $TicketStatus = (int)TicketStatus::Opened;
            $TicketNotes = $this->support->getDatabase()->real_escape_string('None');

            $Query = "INSERT INTO `support_tickets` (ticket_number, source, subject, message, response_email, ticket_status, ticket_notes, submission_timestamp) VALUES ('$TicketNumber', '$Source', '$Subject', '$Message', '$ResponseEmail', $TicketStatus, '$TicketNotes', $CurrentTimestamp)";
            $QueryResults = $this->support->getDatabase()->query($Query);

            if($QueryResults == true)
            {

            }
            else
            {
                throw new DatabaseException($Query, $this->support->getDatabase()->error);
            }

        }

        public function getSupportTicket(string $search_method, string $value): SupportTicket
        {

        }
    }